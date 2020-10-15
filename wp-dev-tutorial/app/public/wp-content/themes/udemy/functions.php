<?php

// Setup
define( 'JU_DEV_MODE', true );

// Includes
include( get_theme_file_path( '/includes/front/enqueue.php' ) );
include( get_theme_file_path( '/includes/setup.php' ) );
include( get_theme_file_path( '/includes/custom-nav-walker.php' ) );
include( get_theme_file_path( '/includes/widgets.php' ) );
include( get_theme_file_path( '/includes/theme-customizer.php' ) );
include( get_theme_file_path( '/includes/customizer/social.php' ) );
include( get_theme_file_path( '/includes/customizer/misc.php' ) );
include( get_theme_file_path( '/includes/customizer/enqueue.php' ) );
include( get_theme_file_path( '/includes/buddypress/profile-tabs.php' ) );
include( get_theme_file_path( '/includes/utility.php' ) );
include( get_theme_file_path( '/includes/buddypress/profile-posts.php' ) );
include( get_theme_file_path( '/includes/admin/author-fields.php' ) );
include( get_theme_file_path( '/includes/avatar.php' ) );
include( get_theme_file_path( '/includes/home-query.php' ) );

// Hooks
add_action( 'wp_enqueue_scripts', 'ju_enqueue' );
add_action( 'after_setup_theme', 'ju_setup_theme' );
add_action( 'widgets_init', 'ju_widgets' );
add_action( 'customize_register' , 'ju_customize_register' ); // customize widget
add_action( 'customize_preview_init', 'ju_customize_preview_init' );
add_action( 'bp_setup_nav', 'ju_buddypress_profile_tabs' );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
// add_action( 'woocommerce_sidebar', function() {
//   echo 'test';
// });
add_filter( 'excerpt_more', '__return_false' );
add_action( 'show_user_profile', 'ju_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'ju_custom_user_profile_fields' );
add_action( 'personal_options_update', 'ju_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'ju_save_extra_profile_fields' );
add_action( 'avatar_defaults', 'ju_new_avatar');
add_action( 'pre_get_posts', 'ju_modify_home_page_query' );

// Shortcodes