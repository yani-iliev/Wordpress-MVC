<?php
class TheOptionsHelper {
	function wp_pages_dropdown($field_name, $page_id=0, $auto_page='', $include_disabled=false)
	{
		global $wpdb;
		$query = "SELECT * FROM {$wpdb->posts} WHERE post_status=%s AND post_type=%s";
		$query = $wpdb->prepare( $query, "publish", "page" );
		$results = $wpdb->get_results( $query );
		$pages = array();
		if($results)
			$pages = $results;

		$selected_page_id = (isset($_POST[$field_name])?$_POST[$field_name]:$page_id);

		?>
<select name="<?php echo $field_name; ?>"
	id="<?php echo $field_name; ?>"
	class="wafp-dropdown wafp-pages-dropdown">
	<?php if($include_disabled) { ?>
	<option value=""><?php _e('- Disable Page -', 'mingle'); ?>&nbsp;</option>
	<?php } ?>
	<?php if(!empty($auto_page)) { ?>
	<option value="__auto_page:<?php echo $auto_page; ?>"><?php _e('- Auto Create New Page -', THE_PLUGIN_NAME); ?>&nbsp;</option>
	<?php }

	foreach($pages as $page)
	{
		$selected = (((isset($_POST[$field_name]) and $_POST[$field_name] == $page->ID) or (!isset($_POST[$field_name]) and $page_id == $page->ID))?' selected="selected"':'');
		?>
	<option value="<?php echo $page->ID; ?>" <?php echo $selected; ?>><?php echo $page->post_title; ?>&nbsp;</option>
	<?php
	}
	?>
</select>
	<?php

	if($selected_page_id) {
		$permalink = get_permalink($selected_page_id);
		?>
&nbsp;
<a href="<?php echo $permalink; ?>" target="_blank"><?php _e('View', THE_PLUGIN_NAME); ?></a>
		<?php
	}
	}
}