<!-- page.tpl.php -->
<!-- SUBPAGE TEMPLATE //-->
<?php
if( arg(0) == 'node' && is_numeric(arg(1) ) && !arg(2) )
{
    $url_alias = drupal_get_path_alias('node/'.arg(1));
    $parts = explode( "/", $url_alias ) ;
    if( count( $parts ) > 1 && $parts[0] == "group" )
    {
	$node = node_load(arg(1));
	if( $node )
	{
	    $types = node_get_types();
	    $ntype = $types[$node->type]->name;
	    if( $ntype == "Group" )
	    {
		$url = drupal_get_path_alias(request_uri());
		#print( "url = $url<br/>\n" ) ;
		if( !strpos($url, "edit") && !strpos($url, "admin") )
		{
		    #print( "$url_alias - Load the other template<br/>\n" ) ;
		    include( "group-page.dco.php" ) ;
		    return ;
		}
	    }
	}
    }
}

// $Id: page.tpl.php $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" class="no-js">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
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
      <?php print $pre_preface_top; ?>

      <!-- main row: width = grid_width -->
      <div id="main-wrapper" class="main-wrapper full-width">
        <div id="main" class="main row <?php print $grid_width; ?>">
          <div id="main-inner" class="main-inner inner clearfix">
            <?php print $pre_sidebar_first; ?>

            <!-- main group: width = grid_width - sidebar_first_width -->
            <div id="main-group" class="main-group row nested <?php print $main_group_width; ?>">
              <div id="main-group-inner" class="main-group-inner inner">
                <?php print $pre_preface_bottom; ?>

                <div id="main-content" class="main-content row nested">
                  <div id="main-content-inner" class="main-content-inner inner">
                    <!-- content group: width = grid_width - (sidebar_first_width + sidebar_last_width) -->
                    <div id="content-group" class="content-group row nested <?php print $content_group_width; ?>">
                      <div id="content-group-inner" class="content-group-inner inner">
                    

                        <?php if ($content_top || $help || $messages): ?>
                        <div id="content-top" class="content-top row nested">
                          <div id="content-top-inner" class="content-top-inner inner">
                            <?php print $pre_help; ?>
                            <?php print $pre_messages; ?>
                           
                          </div><!-- /content-top-inner -->
                        </div><!-- /content-top -->
                        <?php endif; ?>

                        <div id="content-region" class="content-region row nested">
                          <div id="content-region-inner" class="content-region-inner inner">
                            <a name="main-content-area" id="main-content-area"></a>

                            <div id="content-inner" class="content-inner block">
                              <div id="content-inner-inner" class="content-inner-inner inner">
                            <?php if ($title && !$is_front): ?>
                                <h1 class="title"><?php print $title; ?></h1>
                                <?php endif; ?>
                                <?php if  (!empty($group_header_image)): ?>
                                  <div id="group-header" class="group-header">
                                    <?php print $group_header_image; ?>
                                    <div class="group-header-text">
                                    <?php print $group_header_text;?>
                                    </div> <!-- /group-header-text -->
                                  </div><!-- /group-header -->
                                <?php endif; ?>        
                                 <?php print $content_top; ?>                        
                                <?php print $pre_tabs; ?>
                                
                                
                                <?php if ($content): ?>
                                
                                <div id="content-content" class="content-content">
      <?php
      /*
      $a0=arg(0) ;
      if( $a0 ) print( "a0 = $a0<br/>\n" ) ;
      $a1=arg(1) ;
      if( $a1 ) print( "a1 = $a1<br/>\n" ) ;
      $a2=arg(2) ;
      if( $a2 ) print( "a2 = $a2<br/>\n" ) ;
      $url = drupal_get_path_alias(request_uri());
      if( $url ) print( "url = $url<br/>\n" ) ;
      $node = node_load(arg(1));
      if( $node )
      {
	$types = node_get_types();
	$ntype = $types[$node->type]->name;
	print( "ntype = $ntype<br/>\n" ) ;

	$group = og_features_get_group_context() ;
	if( $group )
	{
	    $gnid = $group->nid ;
	    $guid = $group->uid ;
	    $gtitle = $group->title ;
	    $gtype = $group->type ;
	    $gteaser = $group->teaser ;
	    print( "group nid = $gnid<br/>\n" ) ;
	    print( "group uid = $guid<br/>\n" ) ;
	    print( "group title = $gtitle<br/>\n" ) ;
	    print( "group type = $gtype<br/>\n" ) ;

	    $bc = og_get_breadcrumb($node);
	    print( "group bread crumb = " ) ;
	    print_r( $bc ) ;
	    print( "<br/>\n" ) ;

	    $groups = og_get_node_groups($node);
	    print( "group groups = " ) ;
	    print_r( $groups[0] ) ;
	    print( "<br/>\n" ) ;
	}
	else print( "NOTHING<br/>\n" ) ;
       }
       */
      ?>
      
                                  <?php print $content; ?>
                                  <?php print $feed_icons; ?>
                                </div><!-- /content-content -->
                                <?php endif; ?>
                              </div><!-- /content-inner-inner -->
                            </div><!-- /content-inner -->
                          </div><!-- /content-region-inner -->
                        </div><!-- /content-region -->

                        <?php print $pre_content_bottom; ?>
                      </div><!-- /content-group-inner -->
                    </div><!-- /content-group -->

                    <?php print $pre_sidebar_last; ?>
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
