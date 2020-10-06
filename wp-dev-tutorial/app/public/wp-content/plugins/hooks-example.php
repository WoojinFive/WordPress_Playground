<?php
/*
 * Plugin Name: Hooks Example
 */
 
function ju_title( $title ) {
  return 'Hooked ' . $title;
}

function ju_footer_shoutout() {
  echo 'Hooked Example plugin was here.';
}

add_filter( 'the_title', 'ju_title' );
add_action( 'wp_footer', 'ju_footer_shoutout' );