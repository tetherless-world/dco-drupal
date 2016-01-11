<!-- group-page.dco.php -->
<?php
/* This template file is used for a groups home page. It is included from the
 * page.tpl.php file in this themes directory if and only if the node the user
 * is visiting is a groups home page.
 *
 * Example page: group/dco-data-science-team
*/
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" class="no-js">

<head>
  <?php
	$node = node_load( arg( 1 ) ) ;
	if( !og_is_group_member( $node ) )
	{
	  $mytitle = $node->title ;
  ?>
  <title><?php print $mytitle; ?></title>
  <?php
    }
	else
	{
  ?>
  <title><?php print $head_title; ?></title>
  <?php
    }
  ?>
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
			  <?php
				global $user;
				$id = $user->uid ;

				$node = node_load( arg( 1 ) ) ;

				// Find out if the current user is a member of this group or not
			    $ismember = og_is_group_member( $node ) ;

				// For some reason, if anonymous user then the list of taxonomy
				// terms for this current page is empty. So I have to query the
				// database directly. Get the title of the node, add " Private"
				// to it to get the private taxonomy term for this group. Go get
				// the taxonomy terms for this node (all of them by tid) and go
				// through the list to see if the private term is in there.
				$title = $node->title ;
				$tname = $title ;
				$tpname = $title . " Private" ;
				$rname = "Restricted" ;
				$isrestricted = false ;

				$isprivate = false ;
				$result = db_query("SELECT term_data.tid,term_data.name FROM term_node,term_data WHERE term_node.nid = $node->nid AND term_node.tid = term_data.tid") ;
				if( $result )
				{
					while( $term = db_fetch_object( $result ) )
					{
						if( $term->name == $tpname )
						{
							$isprivate = true ;
						}
						if( $term->name == $rname )
						{
							$isrestricted = true ;
						}
					}
				}

				if( $id == 0 && $isrestricted )
				{
					$isprivate = true ;
				}

			    if( !$ismember && $isprivate )
				{
					// 0 means that the user is currently not logged in, aka the
					// anonymous user. So tell them they need to log in to do
					// anything.
					if( $id == 0 )
					{
						print( "<span style=\"font-weight:bold;font-size:13pt;\">Please log in to access this group.</span>" ) ;
					}
					else
					{
						// The groups_choice_logo variable should contain the
						// information about how to subscribe to or be invited
						// to the group. Otherwise they'll just have to figure
						// it out.
						print( "<span style=\"font-weight:bold;font-size:13pt;\">This is a private group. You must either be invited to this group, or request to join it.</span>" ) ;
						print( "<br/><br/>" ) ;
						print( "<div id=\"groups-choice-logo\">" ) ;
						print $groups_choice_logo ;
						print( "</div>" ) ;
					}
				}
				else
				{
				?>
		
	<!--
	The pre_tabs are the "Group Home", "Group Activity", "By term", "Edit",
	"Features", "Q&A", "Feeds", and "Devel" tabs on a group page.
	-->
	<?php print $pre_tabs; ?>
	<div id="groups-choice-logo">
	<?php print $groups_choice_logo; ?>
	</div>
	<div id="groups-menu">
	<?php print $groups_menu; ?>
	</div>
		<div id="groups-blocks-wrapper">
		<div id="groups-block-one">
		<?php print $groups_block_one; ?>
		</div>
		<div id="groups-block-two">
		<?php print $groups_block_two; ?>
		</div>
		<div id="groups-block-three">
		<?php print $groups_block_three; ?>
		</div>
		<div id="groups-block-four">
		<?php print $groups_block_four; ?>
		</div>
		<div id="groups-block-five">
		<?php print $groups_block_five; ?>
		</div>
		<div id="groups-block-six">
		<?php print $groups_block_six; ?>
		</div>
		</div>
		<div id="groups-calendar">
		<?php print $groups_calendar; ?>
		</div>
		<div id="groups-links">
		<?php print $groups_links; ?>
		</div>
		<div id="groups-mytasks">
		<?php print $groups_mytasks; ?>
		</div>
		<div id="events-block">
		<div id="events-block-title">
		<b style="padding-left: 20px; font-size: 25px;">GROUP EVENTS</b>
		</div>
		<?php print $events_block; ?>
		</div>
			<div id="go-deeper">
			<div id="go-deeper-block">
			<?php print $go_deeper_block; ?>
			</div>
			</div>
                <?php print $pre_postscript_top; ?>
			    <?php }?>
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
<!-- group-page.dco.php done -->
