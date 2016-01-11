<!-- page-node-215.tpl.php -->
<?php
// $Id: page.tpl.php $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" class="no-js">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  
   <!-- css for the tabs below //-->
  <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/themes/base/jquery-ui.css" type="text/css" media="all" />
<!-- end css for the tabs below //-->


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
  
    <!-- js for the tabs below //-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js" type="text/javascript"></script>
<!-- BEGIN js for the tabs  //-->
<script>
$.noConflict();
jQuery(document).ready(function(){
	jQuery( "#tabs" ).tabs();
	// hide the tabs until page loads to prevent "fuoc"
	jQuery( "#tabs" ).css('visibility','visible');
	
	jQuery( "#findings" ).accordion({ collapsible: true, active: false, autoHeight: false });
});
</script>
<!-- END js for the tabs  //-->



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
      <br/><br/>
      <?php } ?>
      <div id="main-wrapper" class="main-wrapper full-width">
        <div id="main" class="main row grid16-16">
          <div id="main-inner" class="main-inner inner clearfix">
            <?php print $pre_sidebar_first; ?>

            <!-- main group: width = grid_width - sidebar_first_width -->
            <div id="main-group" class="main-group row nested <?php print $main_group_width; ?>">
              <div id="main-group-inner" class="main-group-inner inner">
		
		
		<!-- Begin Tabs //-->

  <div id="tabs" style="visibility: hidden;"><!-- open #tabs //-->
  <h1>Deep Life</h1>
 
  <ul id="communities">
    <li><a href="#tabs-1" class="tab-1">Overview</a></li>
    <li><a href="#tabs-2" class="tab-2">Goals</a></li>
    <li><a href="#tabs-3" class="tab-3">Guiding Questions</a></li>
  </ul>
 
  <div id="tabs-1" class="tablabel"><!-- open #tabs-1 //-->
  	<div id="block-directorate"><!-- open #block-directorate //-->
		<?php print $block_directorate; ?>
	</div><!-- end #block-directorate //-->
  </div><!-- end #tabs-1 //-->
  
  
  <div id="tabs-2" class="tablabel"><!-- open #tabs-2 //-->
	<div id="community-goals"><!-- open #community-goals //-->
		 <?php print $community_goals; ?>
	</div><!-- end #community-goals //-->
  </div><!-- end #tabs-2 //-->
  
  
  <div id="tabs-3"><!-- open #tabs-3 //-->
  <div id="community-questions"><!-- open #community-questions //-->
		 <?php print $community_questions; ?>
	</div><!-- end #community-questions //-->
  </div><!-- end #tabs-3 //-->
  
</div><!-- end #tabs //-->
  
  
  
  <!-- End of Tabs //-->
  
  
  
 <div id="directorate-feature-block"><!-- open #directorate-feature-block //-->
		<?php print $directorate_feature_block; ?>
	</div><!-- end #directorate-feature-block //-->




<div id="community" class="main-content row nested">
	<div id="main-content-inner" class="main-content-inner inner">
			
	<?php if ($content_top): ?>
		<?php print $content_top; ?>
    <?php endif; ?>
       
		<div style="width: 300px;float: right; clear: none;" >
			
			<?php print $biblio_block; ?>
			</div>
			
			 </div><!-- /main-content-inner -->
                </div><!-- /main-content -->

			
			<div id="go-deeper">
			<div id="go-deeper-block">
			<?php print $go_deeper_block; ?>
			</div>
			</div>
                 
                <?php print $pre_postscript_top; ?>
             
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
<!-- page-node-215.tpl.php done-->
