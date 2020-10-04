<?php

function ju_setup_theme() {
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'title-tag' );

  register_nav_menu( 'primary', __( 'Primary Menu', 'udemy' ) ); // __() 2nd parameter -> theme name
}