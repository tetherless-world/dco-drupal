<!--dco-footer.php-->

<div id="footer"> 
  
  <div id="dcofooter-group-wrapper" class="dcofooter-group-wrapper full-width">
	<div id="dcofooter-group" class="dcofooter-group row grid16-16">
		<div id="dcofooter-group-inner" class="dcofooter-group-inner inner clearfix">
			<div id="dcofooter">
				<!-- Column One //-->
				<div class="grid16-3">
				<p>
				
				
				
					<?php $block = module_invoke('menu', 'block' , 'view', 'secondary-links'); 
								print $block['content'];
								?>
								</p>
				</div>
				
				
				<!-- Column Two //-->
				<div class="grid16-9">
					
					<?php print $footer_column_boilerplate; ?>
					
					
				<!--<?php $block = module_invoke('block', 'block' , 'view', 43); 
								print $block['content'];
								?>	//-->
								
								</div>
				
				<!-- Column Three //-->
				<div class="grid16-4">
				
				<?php print $footer_site_credits; ?>
					<!--<?php $block = module_invoke('block', 'block' , 'view', 42); 
								print $block['content']; ?>//-->
				 
				
				</div>
			</div><!-- /dcofooter //-->
	
		</div><!-- /dcofooter-group-inner //-->
	</div><!-- /dcofooter-group //-->
   </div><!-- /dcofooter-group-wrapper //-->
      <!-- postscript-bottom row: width = grid_width -->
      <?php #print $pre_postscript_bottom; ?>

      <!-- footer row: width = grid_width -->
      <?php #print $pre_footer; ?>
      
</div><!-- /Footer //-->	
<!--dco-footer.php done-->