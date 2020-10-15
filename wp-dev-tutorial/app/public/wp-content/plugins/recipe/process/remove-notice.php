<?php

function r_dismiss_pending_recipe_notice() {
  update_option( 'r_pending_recipe_notice', 0);
}