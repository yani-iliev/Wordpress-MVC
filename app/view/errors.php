<?php
  if( $errors != null and count($errors) > 0 )
  {
      ?>
<div class="error">
  <ul>
  <?php
    foreach( $errors as $error )
    {
        ?>
    <li><strong><?php _e('ERROR', THE_PLUGIN_NAME); ?></strong>: <?php print $error; ?></li>
    <?php
    }
      ?>
  </ul>
</div>
<?php
  }
?>