<?php 
/*
Template Name: Shop Signs page template
*/

get_header(); 

while ( have_posts() ) : the_post();?>

<section>
   <?php
	$title = get_the_title();
	if($title == 'About'){echo do_shortcode('[smartslider3 slider=2]');}
	if($title == 'Shop Signs and Displays'){echo do_shortcode('[smartslider3 slider=3]');}
	if($title == 'Vehicle Graphics'){echo do_shortcode('[smartslider3 slider=4]');}
	if($title == 'Digital Screens and Digital Menu'){echo do_shortcode('[smartslider3 slider=5]');}
	if($title == 'Web Design'){echo do_shortcode('[smartslider3 slider=6]');}
	if($title == 'Quote Now'){echo do_shortcode('[smartslider3 slider=7]');}
	if($title == 'Products'){echo do_shortcode('[smartslider3 slider=9]');}
	if($title == 'Services'){echo do_shortcode('[smartslider3 slider=8]');}
?>
</section>
<section>
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <h1>
               <?php the_title();?>
            </h1>
				<div class="btnGetQuote"><a id="bntQuote" href="#quoteContainer"><img src="http://wbsoltech.co.uk/advertsignment/wp-content/uploads/2018/09/get-quote-btn.png"></a></div>
         </div>
         <div id="quoteContainer" class="col-lg-12 col-md-12 col-sm-12 quoteForm" style="display:none;">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <div class="quote-h1">
                  <h2>HOW TO USE</h2>
                  <?php dynamic_sidebar( 'quote-form-how-to-use-text' ); ?>
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <div class="qoute-form">
                  <form id="frmQuote" method="post" action="<?php echo esc_url( get_page_link( 272 ) ); ?>">
                     <label>SELECT SIGN TYPE</label>
                     <select name="signType" id="signType">
                        <option value="">Select Sign Type</option>
								<option title="A sheet sign consists of only the sheet being screwed or attached to the wall or any surface and can be made of any of the 2 sheet materials i.e Foamex, and aluminium composite" value="SHEET ONLY">SHEET ONLY</option>
                        <option title="In this type of sign the sheet is secured within a metal trim casing. The aluminium anodised finish of the trim provides a durable exterior solution which makes the sign suitable for; Shop Fronts & Fascias, External Wall Mounted Signs, Notice Boards and Menu Boards." value="INSIDE TRIM SIGN">INSIDE TRIM SIGN</option>
                        <option title="The light box is made from anodised aluminium which gives the sign a strong structure. The tube lights fitted inside the box make the sign highly lit and visible at night. It uses opal acrylic sheets on which vinyl graphics, flatcut and 3d letters can be applied." value="LIGHT BOX SIGN">LIGHT BOX SIGN</option>
                        <option title="This sign is constructed from aluminium sheet which is moulded to create the pan sign. A number of options, available with this sign type are vinyl lettering, flat cut or built up letters. It can be created as an illuminated sign by using lights behind or trough light on top of the sign or non-illuminated sign. This sign type is the long-lasting option and most visually appealing." value="PAN SIGN">PAN SIGN</option>
                     </select>
                     <label>SELECT SIGN MATERIAL</label>
                     <select name="signMaterial" id="signMaterial">
                        <option value="">Select Sign Material</option>
								<option title="A foamex sheet is usually used for a short term use as a sign. It can be directly screwed on to the wall or any surface for a temporary sign. It can also be used for a longer term use if used in a panatrim sign." value="FOAMEX SHEET">FOAMEX SHEET</option>
                        <option title="Acrylic sheets can be used in all the sign types, except a sheet only sign that is normally directly fitted on the wall, but is the most useful in a light box or Pan sign as it allows the light behind it to shine through. It can also be used in a panatrim sign with the trough light only." value="ACRYLIC SHEET">ACRYLIC SHEET</option>
                        <option title="Aluminium composite sheet is the long-lasting option due to its weather durability, Strong composition and Lightweight and Rigid Construction property. Due to its many features, this is a good option with any of the sign types." value="COMPOSITE SHEET">COMPOSITE SHEET</option>
                     </select>
                     <label>SELECT LETTER TYPE</label>
                     <select name="letterType" id="letterType">
                        <option value="">Select Letter Type</option>
								<option title="Vinyl lettering is the most common and popularly used options due to its cheap price and multi usage. Vinyl lettering can be used in all of the sign types and has a 7+ year guarantee so is long lasting." value="VINYL LETTERING">VINYL LETTERING</option>
                        <option title="Flat cut letters can be made from a range of materials including acrylic, foamex, aluminium and stainless steel which are then fixed on to the sign using locators to give them a floating 3D look." value="FLAT CUT LETTERS">FLAT CUT LETTERS</option>
                        <option title="3D acrylic letters are made from acrylic sheets moulded in to the letters which are then stuck on to the signboard. The acrylic allows light to pass through so gives the letters a glowing affect, and so can be used in a light box or pan sign." value="3D ACRYLIC LETTERS">3D ACRYLIC LETTERS</option>
                        <option title="3D stainless steel letters can be used with LED sign lighting resulting in the light to show from below the letters which gives a hallow effect on the sign. The lights give a shadow affect which creates a even further 3D affect on the reflective stainless steel letters." value="3D STAINLESS STEEL LETTER">3D STAINLESS STEEL LETTER</option>
                        <option title="These letter types consist of the letters body made from the stainless steel and the front of acrylic. This allows the light to shine through the front and if fitted on the locators, then from the sides as well" value="STAINLESS STEEL LETTERS WITH ACRYLIC FRONT">STAINLESS STEEL LETTERS WITH ACRYLIC FRONT</option>
                     </select>
                     <label>SELECT LIGHT TYPE</label>
                     <select name="lightType" id="lightType">
                        <option value="">Select Light Type</option>
								<option title="The normal day light tubes which give the sign a bright look at night but a limited brightness during the day. It is also the cheapest option compared to LED lights and can be used behind a light box and pan sign." value="STANDARD TUBE LIGHTS">STANDARD TUBE LIGHTS</option>
                        <option title="The LED tube lights are a long lasting option which also has a very bright result on the sign. They tend to be slightly more expensive than some of the other options but are energy efficient." value="LED TUBE LIGHTS">LED TUBE LIGHTS</option>
                        <option title="The LED sign Lights are mostly used within 3D Channel letters on signs due to their small size which results in them giving the letters a glowing affect to make them stand out. They also have low electrical consumption levels and are long lasting." value="LED SIGN LIGHTS">LED SIGN LIGHTS</option>
                        <option title="The trough light is installed either below or above the sign using normal or LED tubes. This gives the sign a spot light so it’s highly visible during the night making it one of the fancier and attractive options." value="TROUGH LIGHTS">TROUGH LIGHTS</option>
                        <option title="Please choose this option if you would like a plain sign without any type of lights" value="NO LIGHTS">NO LIGHTS</option>
                     </select>
                     <label>Your Reference:</label>
                     <input type="text" name="reference" class="quote-fields" />
                     <div class="sign-size">Please enter the sign size:</div>
                     <label>Length:(CM)</label>
                     <input type="text" name="length" class="quote-fields" />
                     <label>Width:(CM)</label>
                     <input type="text" name="width" class="quote-fields" />
                     <label>Email me this quote to:</label>
                     <input type="text" name="email" class="quote-fields" />
                     <label>My Maximum Budget:</label>
                     <input type="text" name="maxbudget" class="quote-fields" />
                     <label>My Business Type:</label>
                     <input type="text" name="businesstype" class="quote-fields" />
                     <input type="submit" value="Get A Quote" class="qoute-btn">
							<?php 
								if(isset($_REQUEST['status']) && $_REQUEST['status'] == 1)
								{
									echo '<p style="color:red;">Request sent successfully.</p>';
								}
								if(isset($_REQUEST['status']) && $_REQUEST['status'] == 0)
								{
									echo '<p style="color:red;">Request could not be sent successfully.</p>';
								}
							?>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-lg-12 col-md-12 col-sm-12">
            <?php the_content();?>
         </div>
      </div>
   </div>
</section>
<?php endwhile;?>
<?php get_footer(); ?>
