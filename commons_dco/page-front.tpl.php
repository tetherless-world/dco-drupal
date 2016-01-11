<!-- page-front.tpl.php -->
<?php
// $Id: page.tpl.php $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" class="no-js">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <!-- Google Webmaster Tools Verification Tag. Must Stay in the head of the site. 1/2014 JW //-->
  <meta name="google-site-verification" content="dUwIezhNo5CNcatUgOZPOpMyxF13sLYtAzt5t05YnIc" />
  <?php print $styles; ?>
  <?php print $setting_styles; ?>
 <!--[if IE 8]>
  <?php print $ie8_styles; ?>
   <script src="sites/default/themes/commons_dco/js/ie8.js"></script>
  <![endif]-->
  <!--[if IE 7]>
  <?php print $ie7_styles; ?>
   <script src="sites/default/themes/commons_dco/js/ie7.js"></script>
  <![endif]-->
  <!--[if lte IE 6]>
  <?php print $ie6_styles; ?>
  <script src="sites/default/themes/commons_dco/js/ie7.js"></script>
  <![endif]-->
   <!--[if lt IE 9]>
  <script src="sites/default/themes/commons_dco/js/ie9.js"></script>
  <![endif]-->
 
  <?php print $local_styles; ?>
  <?php print $scripts; ?>
  <!-- Script added October 29 2013 // - by jw //-->
 <script src="sites/default/themes/commons_dco/js/slideshow.js"></script>
</head>

<body id="<?php print $body_id; ?>" class="<?php print $body_classes; ?>">


<!-- New Footer Fix Code //-->
  <div id="wrap">
  
  <div id="page" class="page">
    <div id="page-inner" class="page-inner">
      <div id="skip">
        <a href="#main-content-area"><?php print t('Skip to Main Content Area'); ?></a>
      </div>

<!-- Header Include //-->
 <?php include 'dco-header.php'; ?>
 
      
      <!-- preface-top row: width = grid_width -->
      

      <!-- main row: width = grid_width -->
      <?php if( !$logged_in ) { ?>
     
      <?php } ?>
      <div id="main-wrapper" class="main-wrapper full-width">
        <div id="main" class="main row grid16-16">
          <div id="main-inner" class="main-inner inner clearfix">
            <?php print $pre_sidebar_first; ?>

            <!-- main group: width = grid_width - sidebar_first_width -->
            <div id="main-group" class="main-group row nested <?php print $main_group_width; ?>">
              <div id="main-group-inner" class="main-group-inner inner">
              
              <!--- Slideshow added 10/2/13-jw //-->
              <div id="new-feature-block">
             
              	 <!-- preface-top row: width = grid_width -->
               <?php print $pre_preface_top; ?>
               
        <!--- block-first-front (community nav) //-->
		<div id="block-first-front">
			<?php print $block_first_front; ?> 
			
			
		</div><!--- EOD block-first-front //-->
		
		<!--- block-second-front (quick links) //-->
		<div id="block-second-front">
		
		<?php print $block_quicklinks; ?>
		
		
		
			
			
			<!-- Carbon Fact //-->
			<?php print $block_second_front; ?>
		</div><!--- block-first-front //-->
		
		<!--- Twitter Box (quick links) //-->
		<div id="block-third-front">
		<?php print $block_third_front; ?>
		</div><!--- block-third-front //-->

                <div id="main-content" class="main-content row nested">
                  <div id="main-content-inner" class="main-content-inner inner">
		
			
			<div id="featured">
			
			
			<!-- DCO Features List //-->
			<div id ="featured-block">
			<?php print $featured_block; ?>
			</div><!-- EOD Features List //-->
			
			</div>	<!-- EOD Featured //-->
			
			
			
                    	<div id="events-block">
			<div id="events-block-title">
			<h3>EVENTS</h3>
			</div>
			<?php print $events_block; ?>
			</div>
			<div id="go-deeper">
			<div id="go-deeper-block">
			<?php print $go_deeper_block; ?>
			</div>
			</div>
                  </div><!-- /main-content-inner -->
                </div><!-- /main-content -->

                <?php print $pre_postscript_top; ?>
              </div><!-- /main-group-inner -->
            </div><!-- /main-group -->
          </div><!-- /main-inner -->
       </div><!-- /main --> 
      </div><!-- /main-wrapper -->
	
	
	
	<!-- Old Footer Spot //-->

    </div><!-- /page-inner -->
  </div><!-- /page -->
  
  
  </div><!-- EOD Wrap: New Footer Fix Code //-->
  
  <!-- New Footer Spot //-->
 
  
  <?php include 'dco-footer.php'; ?>
       
      
      
  
  
  <?php print $closure; ?>
  
  


</body>
</html>
<!-- page.tpl.php done-->
