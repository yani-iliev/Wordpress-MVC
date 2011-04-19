<div class="wrap">
<form name="the_options_form" method="post" action="">
<input type="hidden" name="action" value="process-form">
<?php wp_nonce_field('update-options'); ?>

<h3><?php _e('Plugin Settings', THE_PLUGIN_NAME); ?>:</h3>
<table class="form-table">
  <tr class="form-field">
    <td valign="top" style="text-align: right; width: 100px;"><?php _e('Welcome Page', 'estimator'); ?>*: </td>
    <td>
      <?php TheOptionsHelper::wp_pages_dropdown( $the_options->welcome_page_id_str, $the_options->welcome_page_id, __("Welcome Page"), true)?>
    </td>
  </tr>
</table>
<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', THE_PLUGIN_NAME); ?>" />
</p>
</form>
</div>
