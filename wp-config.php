<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'advertsignment');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'S)f9.-?suXA:z#cu n:YIP|4SV1|fd`]?,T2tQTlhv}~R{yFb@^{u1S]hLG&Tbem');
define('SECURE_AUTH_KEY',  'yM8c39ypHe]]Vzs$+9^)?m_k=cV]DXM54u+El9VWUMDnFh%5)xzz>p*_}s!utxee');
define('LOGGED_IN_KEY',    '5)?[K`s=GCZ$)dh}l7(gsRD.GeU6gQ5rxq&Jus9)kN#`n<DVM[Y-Zzo^FhQngNP8');
define('NONCE_KEY',        '_O#{epB!HFr 4oW6hEJz>G3r#ksiGGYylmNAI$/G~AU}ct?jW~z XZB_Xo%_-OQ0');
define('AUTH_SALT',        ']S[ZA=sUry,#NL*E;p3q;_BSD]na|xEa:OkqF|d}~)1{cG}([)Zb<E=A7T3~C$K{');
define('SECURE_AUTH_SALT', '!jdA*Pe61_`8EaBN!kYTK*]r`~;DN@jPlXA}_qg]$luQK:AGAuR(?@1MzGUBtEQ;');
define('LOGGED_IN_SALT',   'p`3%=OVrBH.9rrgdh[fNauijTT1eSn]`M#]qh1>TSm`Ar?DW2KfQ?}ReladQ-ukt');
define('NONCE_SALT',       'ROI@!nk#i%Y%0 dP]BhGW56!/4@oN(IY~A?Y$`/iDhAL%vJGdEYyjP,5jL~~SB[`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
