<?php 
/*
Template Name: Home page template
*/

get_header();?>

<section>
	<div class="container">
		<div class="row">
			<?php
				echo do_shortcode('[smartslider3 slider=13]');
			?>
		</div>
	</div>
	
   <!--<div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
         <?php
			  	/*$counter = 0;
				query_posts('post_type=carousel&order=ASC');
		   	while (have_posts()) : the_post();?>
         <li data-target="#myCarousel" data-slide-to="<?php echo $counter;?>" <?php if($counter == 0){echo 'class="active"';}?>>&nbsp;</li>
         <?php $counter++; endwhile;?>
         <?php wp_reset_query(); ?>
      </ol>
      <div class="carousel-inner" role="listbox">
         <?php
			  	$counter = 1;
				query_posts('post_type=carousel&order=ASC');
		   	while (have_posts()) : the_post();
				$imgurl = get_the_post_thumbnail_url(get_the_ID(),'full'); 
				?>
         <div class="item <?php if($counter == 1){echo 'active';}?>"><img src="<?php echo $imgurl;?>" alt="<?php the_title();?>" /></div>
         <?php $counter++; endwhile;?>
         <?php wp_reset_query();*/ ?>
      </div>
   </div>-->
</section>
<section>
   <div class="container">
      <div class="row">
         <?php $pgid = 26;
				$thispage = get_post($pgid);
				$content = wp_trim_words( $thispage->post_content, 30, '...' );
				$imgrul = get_the_post_thumbnail_url($pgid,'full'); 
			?>
         <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="service-con"><img src="<?php echo $imgrul;?>" alt="Image" /></div>
            <div class="service-box">
               <h2><a href="<?php echo esc_url( get_permalink($pgid) ); ?>" style="color:#2a2a2a; text-decoration:none;"><?php echo get_the_title($pgid); ?></a></h2>
               <p><?php echo $content;?> <a href="<?php echo esc_url( get_permalink($pgid) ); ?>">Learn More...</a></p>
            </div>
         </div>
         <!--col-sm-3 end-->
         <?php $pgid = 65;
				$thispage = get_post($pgid);
				$content = wp_trim_words( $thispage->post_content, 30, '...' );
				$imgrul = get_the_post_thumbnail_url($pgid,'full'); 
			?>
         <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="service-con"><img src="<?php echo $imgrul;?>" alt="Image" /></div>
            <div class="service-box">
               <h2><a href="<?php echo esc_url( get_permalink($pgid) ); ?>" style="color:#2a2a2a; text-decoration:none;"><?php echo get_the_title($pgid); ?></a></h2>
               <p><?php echo $content;?> <a href="<?php echo esc_url( get_permalink($pgid) ); ?>">Learn More...</a></p>
            </div>
         </div>
         <!--col-sm-3 end-->
         <?php $pgid = 20;
				$thispage = get_post($pgid);
				$content = wp_trim_words( $thispage->post_content, 30, '...' );
				$imgrul = get_the_post_thumbnail_url($pgid,'full'); 
			?>
         <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="service-con"><img src="<?php echo $imgrul;?>" alt="Image" /></div>
            <div class="service-box">
               <h2><a href="<?php echo esc_url( get_permalink($pgid) ); ?>" style="color:#2a2a2a; text-decoration:none;"><?php echo get_the_title($pgid); ?></a></h2>
               <p><?php echo $content;?> <a href="<?php echo esc_url( get_permalink($pgid) ); ?>">Learn More...</a></p>
            </div>
         </div>
         <!--col-sm-3 end-->
         <?php $pgid = 22;
				$thispage = get_post($pgid);
				$content = wp_trim_words( $thispage->post_content, 30, '...' );
				$imgrul = get_the_post_thumbnail_url($pgid,'full'); 
			?>
         <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="service-con"><img src="<?php echo $imgrul;?>" alt="Image" /></div>
            <div class="service-box">
               <h2><a href="<?php echo esc_url( get_permalink($pgid) ); ?>" style="color:#2a2a2a; text-decoration:none;"><?php echo get_the_title($pgid); ?></a></h2>
               <p><?php echo $content;?> <a href="<?php echo esc_url( get_permalink($pgid) ); ?>">Learn More...</a></p>
            </div>
         </div>
         <!--col-sm-3 end-->
      </div>
      <!--row end-->
   </div>
   <!--container end-->
</section>
<section> 
	<div class="clearfix">&nbsp;</div>
	<div class="container">
		<div class="row">
			<center><a href="#"><img src="http://wbsoltech.co.uk/advertsignment/wp-content/uploads/2018/10/our-online-shop-button.jpg" alt="" class="img-responsive" /></a></center>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
   <div class="container">
      <div class="row">
         <?php
			  	$counter = 0;
				query_posts('post_type=services&order=DESC');
		   	while (have_posts()) : the_post();
				$imgurl = get_the_post_thumbnail_url(get_the_ID(),'full');
				$url = get_post_meta( get_the_ID(), 'url', true );
				?>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="tw-box"> <img src="<?php echo $imgurl;?>" alt="Image" /> <a class="tw-hover" href="<?php echo $url;?>" target="_blank"><?php the_title();?></a> </div>
					<div class="price-product-box1"><a style="text-decoration:none" href="<?php echo $url;?>" target="_blank"><?php the_title();?></a></div>
				</div>
         <?php $counter++; endwhile;?>
         <?php wp_reset_query(); ?>
      </div>
   </div>
</section>
<?php get_footer(); ?>
