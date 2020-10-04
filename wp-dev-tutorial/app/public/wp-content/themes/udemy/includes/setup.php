<?php

function ju_setup_theme() {
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'custom-logo' );

  register_nav_menu( 'primary', __( 'Primary Menu', 'udemy' ) ); // __() 2nd parameter -> theme name
  register_nav_menu( 'secondary', __( 'Secondary Menu', 'udemy' ) );

  if (function_exists('quads_register_ad')){
    quads_register_ad( array(
      'location'      => 'udemy_header',
      'description'   => 'Udemy Header position'
    ));
  }

}