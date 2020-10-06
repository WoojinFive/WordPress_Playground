<?php
/*
 * Plugin Name: Recipe
 * Description: A simple WordPress plugin that allows user to create recipes and rate those recipes
 * Version: 1.0
 * Author: Woojin Oh
 * Author URI: https://www.halifaxweb.dev
 * text domain: recipe
 */

//  for the security. 워드프레스 실행 없이 직접 파일에 접근할 경우 대비
 if( !function_exists( 'add_action' ) ) {
   echo "Hi there! I'm just a plugin, not much I can do when called directly.";
   exit;
 }

// Setup

// Includes
include( 'includes/activate.php' );
include( 'includes/init.php' );
include( 'process/save-post.php' );

// Hooks
register_activation_hook( __FILE__, 'r_activate_plugin' ); // This function will be called when our plugin is activated.
add_action( 'init', 'recipe_init' );
add_action ('save_post_recipe', 'r_save_post_admin', 10, 3 ); // 3rd argument -> priority, 4th argument -> number of parameters

// Shortcodes
