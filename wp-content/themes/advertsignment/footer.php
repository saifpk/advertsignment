<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>


<footer>
   <div class="container">
      <div class="footer-con1"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
         <?php if ( function_exists( 'ot_get_option' ) ) {
				$footerlogo = ot_get_option( 'footer_logo' );
			}?>
			<div class="footer-logo" style="margin-bottom:30px;"><img src="<?php echo $footerlogo;?>" alt="footerlogo" /></div>
         </a>
         <?php dynamic_sidebar( 'newsletter' ); ?>
			<div class="socialMedia">
				<?php dynamic_sidebar( 'social-media' ); ?>
			</div>
      </div>
      <!--footer-con1 end-->
      <div class="footer-con2">
         <div class="f-heading">Quick Links</div>
         <?php
				wp_nav_menu( array(
					'menu' 			  => 'footer-menu',
					'menu_class'     => 'footer-menu',
				));
			?>
         <!--f-services-con end-->
      </div>
      <!--footer-con2 end-->
      <div class="footer-con3">
         <?php dynamic_sidebar( 'footer-contact-detail' ); ?>
      </div>
   </div>
   <!--footer-con3 end-->
   <div class="copyrigth-con">
      <div class="container">
         <?php dynamic_sidebar( 'copy-right' ); ?>
      </div>
   </div>
   <!--copyrigth-con end-->
</footer>
<script src="<?php echo get_template_directory_uri();?>/js/jquery-1.12.3.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/bootstrap.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/scripts.html"></script>
<?php wp_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		
		jQuery("#bntQuote").click(function(){
    		jQuery(".quoteForm").toggle(300);
		}); 
		
		jQuery('#signType').change(function(){
			//alert(jQuery(this).val());
			jQuery('#frmQuote select option').prop('disabled', false);
			var opt1 = jQuery(this).val();
			if(opt1 == 'SHEET ONLY')
			{
				jQuery("#signMaterial option[value='ACRYLIC SHEET']").prop('disabled', true);
				//////////////////
				jQuery("#letterType option[value='3D ACRYLIC LETTERS']").prop('disabled', true);
				jQuery("#letterType option[value='3D STAINLESS STEEL LETTER']").prop('disabled', true);
				jQuery("#letterType option[value='STAINLESS STEEL LETTERS WITH ACRYLIC FRONT']").prop('disabled', true);
				/////////////////
				jQuery("#lightType option[value='STANDARD TUBE LIGHTS']").prop('disabled', true);
				jQuery("#lightType option[value='LED TUBE LIGHTS']").prop('disabled', true);
				jQuery("#lightType option[value='LED SIGN LIGHTS']").prop('disabled', true);
			}
			if(opt1 == 'INSIDE TRIM SIGN')
			{
				jQuery("#letterType option[value='3D ACRYLIC LETTERS']").prop('disabled', true);
				jQuery("#letterType option[value='3D STAINLESS STEEL LETTER']").prop('disabled', true);
				jQuery("#letterType option[value='STAINLESS STEEL LETTERS WITH ACRYLIC FRONT']").prop('disabled', true);
				/////////////////
				jQuery("#lightType option[value='STANDARD TUBE LIGHTS']").prop('disabled', true);
				jQuery("#lightType option[value='LED TUBE LIGHTS']").prop('disabled', true);
				jQuery("#lightType option[value='LED SIGN LIGHTS']").prop('disabled', true);
			}
			if(opt1 == 'LIGHT BOX SIGN')
			{
				jQuery("#signMaterial option[value='FOAMEX SHEET']").prop('disabled', true);
				jQuery("#signMaterial option[value='COMPOSITE SHEET']").prop('disabled', true);
				////////////////
				jQuery("#lightType option[value='TROUGH LIGHTS']").prop('disabled', true);
				jQuery("#lightType option[value='NO LIGHTS']").prop('disabled', true);				
			}
			if(opt1 == 'PAN SIGN')
			{
				jQuery("#signMaterial option[value='FOAMEX SHEET']").prop('disabled', true);
				jQuery("#signMaterial option[value='ACRYLIC SHEET']").prop('disabled', true);
			}
		});
		jQuery('#signMaterial').change(function(){
			if(jQuery('#signType').val() == 'SHEET ONLY' && jQuery(this).val() == 'FOAMEX SHEET')
			{
				jQuery("#letterType option[value='FLAT CUT LETTERS']").prop('disabled', true);
			}
		});
		jQuery('#letterType').change(function(){
			if(jQuery('#signType').val() == 'LIGHT BOX SIGN' && jQuery('#signMaterial').val() == 'ACRYLIC SHEET' && jQuery(this).val() == 'VINYL LETTERING')
			{
				jQuery("#lightType option[value='NO LIGHTS']").prop('disabled', true);
			}
			if(jQuery('#signType').val() == 'PAN SIGN' && jQuery('#signMaterial').val() == 'COMPOSITE SHEET' && jQuery(this).val() == 'VINYL LETTERING')
			{
				jQuery("#lightType option[value='STANDARD TUBE LIGHTS']").prop('disabled', true);
				jQuery("#lightType option[value='LED TUBE LIGHTS']").prop('disabled', true);
				jQuery("#lightType option[value='LED SIGN LIGHTS']").prop('disabled', true);
			}
		});		
	});
</script>
</body>
</html>

