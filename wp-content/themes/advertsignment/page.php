<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); 

while ( have_posts() ) : the_post();?>
<section>
<?php
	$title = get_the_title();
	/*if($title == 'About'){echo do_shortcode('[smartslider3 slider=2]');}*/
	if($title == 'Shop Signs and Displays'){echo do_shortcode('[smartslider3 slider=3]');}
	if($title == 'Vehicle Graphics'){echo do_shortcode('[smartslider3 slider=4]');}
	if($title == 'Digital Screens and Digital Menu'){echo do_shortcode('[smartslider3 slider=5]');}
	if($title == 'Web Design'){echo do_shortcode('[smartslider3 slider=6]');}
	if($title == 'Quote Now'){echo do_shortcode('[smartslider3 slider=7]');}
	if($title == 'Products'){echo do_shortcode('[smartslider3 slider=9]');}

	if($title == 'Services'){echo do_shortcode('[smartslider3 slider=11]');}
?>
</section>
<section>
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <h1><?php the_title();?></h1>
         </div>
         <div class="col-lg-12 col-md-12 col-sm-12"><br />
            <?php the_content();?>
         </div>
      </div>
   </div>
</section>
<?php endwhile;?>

<?php get_footer(); ?>
