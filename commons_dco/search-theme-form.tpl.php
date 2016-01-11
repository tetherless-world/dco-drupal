<!-- search-theme-form.tpl.php -->
<div class="container-inline" id="searchbox">

	<input type="text" maxlength="250" name="search_theme_form" id="edit-search-theme-form-1" value="Search" title="Enter the terms you wish to search for." class="form-text" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" value="value" />			<input type="submit" name="op" id="edit-submit-button" value="&#187;" title="Search"  class="form-submit" />
	<input type="hidden" name="form_build_id" id="<?php print drupal_get_token('form_build_id'); ?>" value="<?php print drupal_get_token('form_build_id'); ?>" />
	<input type="hidden" name="form_token" id="edit-search-theme-form-form-token" value="<?php print drupal_get_token('search_theme_form'); ?>" />
	<input type="hidden" name="form_id" id="edit-search-theme-form" value="search_theme_form" />
</div>
<!-- search-theme-form.tpl.php done -->