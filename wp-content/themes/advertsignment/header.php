<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<html>
<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/style.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/responsive.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/custom.css">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body>
<header class="nav-fix">
   <div class="top-bar">
      <div class="container">
         <?php dynamic_sidebar( 'header-contact' ); ?>
      </div>
   </div>
   <!-- Fixed navbar -->
   <div class="w-100">
      <nav class="navbar navbar-bg">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <i class="fa fa-bars" aria-hidden="true"></i> </button>
               <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if ( function_exists( 'ot_get_option' ) ) {
						$headerlogo = ot_get_option( 'header_logo' );
					}?>
               <div class="logo-con"><img src="<?php echo $headerlogo;?>" alt="Logo Image" /></div>
               </a> </div>
            <div id="navbar" class="navbar-collapse collapse">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu' 			  => 'main-menu',
							'menu_class'     => 'nav navbar-nav menu-bar',
						));
					?>
            </div>
            <!--/.nav-collapse -->
         </div>
      </nav>
   </div>
   <!--w-100 end-->
</header>

