<!--dco-header.php-->
 <!-- header-top row: width = grid_width -->
	<div id="topheader-group-wrapper" class="topheader-group-wrapper full-width">
	<div id="topheader-group" class="topheader-group row grid16-16">
	<div id="topheader-group-inner" class="topheader-group-inner inner clearfix">
	
	<!-- Begin Logo Area //-->
	<?php if ($logo || $site_name || $site_slogan): ?>
            <div id="header-site-info" class="header-site-info block">
              <div id="header-site-info-inner" class="header-site-info-inner inner">
                <?php if ($logo): ?>
                <div id="logo">
                  <a href="<?php print check_url($front_page); ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
                </div>
                <?php endif; ?>
                <?php if ($site_name || $site_slogan): ?>
                <div id="site-name-wrapper" class="clearfix">
                  <?php if ($site_name): ?>
                  <span id="site-name"><a href="<?php print check_url($front_page); ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a></span>
                  <?php endif; ?>
                  <?php if ($site_slogan): ?>
                  <span id="slogan"></span>
                  <?php endif; ?>
                </div><!-- /site-name-wrapper -->
                <?php endif; ?>
              </div><!-- /header-site-info-inner -->
            </div><!-- /header-site-info -->
            <?php endif; ?>
            <!-- End Logo Area //-->
            <!-- Toolbar //-->
 
              <div id="toolbar">  
               <!-- social chicklets //--><!-- /additional-nav-top -->  <?php include 'dco-login.php'; ?>
        </div> <!-- EOD toolbar //-->
	</div>
	</div>
	</div> 
      <!-- header-group row: width = grid_width -->
      <div id="header-group-wrapper" class="header-group-wrapper full-width">
        <div id="header-group" class="header-group row <?php print $grid_width; ?>">
          <div id="header-group-inner" class="header-group-inner inner clearfix">
          <div id="nav-group-top" class="nav-group clearfix">
	 <?php print $pre_primary_links_tree; ?> <!-- the community pulldown //--><?php #print $nav_block; ?><?php print $pre_search_box; ?>
	 <!-- EOD the community pulldown //-->
	  </div> 
            

            
                       <div id="header-region" class="header-region block">
              <div id="header-region-inner" class="header-region-inner inner">
     	      	       
            
              </div><!-- /header-region-inner -->
            </div><!-- /header-region -->

	   

          </div><!-- /header-group-inner -->
        </div><!-- /header-group -->
      </div><!-- /header-group-wrapper -->
<!--dco-header.php done-->