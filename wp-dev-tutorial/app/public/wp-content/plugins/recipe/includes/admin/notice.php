<?php

function r_admin_notices() {
  if (!get_option('r_pending_recipe_notice')){
    return;
  }
  ?>
  <div class="notice notice-warning is-dismissible" id="r-recipe-pending-notice">
    <p><?php _e( 'You have a couple of recipes wating to be reviewd', 'recipe' ); ?></p>
  </div>
  <?php
}