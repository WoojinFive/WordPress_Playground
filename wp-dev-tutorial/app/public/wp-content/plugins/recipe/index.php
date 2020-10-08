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
define( 'RECIPE_PLUGIN_URL', __FILE__ );

// Includes
include( 'includes/activate.php' );
include( 'includes/init.php' );
include( 'process/save-post.php' );
include( 'process/filter-content.php' );
include( 'includes/front/enqueue.php' );
include( 'process/rate-recipe.php' );
include( 'includes/admin/init.php' );
include( 'blocks/enqueue.php');

// Hooks
register_activation_hook( __FILE__, 'r_activate_plugin' ); // This function will be called when our plugin is activated.
add_action( 'init', 'recipe_init' );
add_action ('save_post_recipe', 'r_save_post_admin', 10, 3 ); // 3rd argument -> priority, 4th argument -> number of parameters
add_filter( 'the_content', 'r_filter_recipe_content' );
add_action( 'wp_enqueue_scripts', 'r_enqueue_scripts', 100 );
add_action( 'wp_ajax_r_rate_recipe', 'r_rate_recipe' );
add_action( 'wp_ajax_nopriv_r_rate_recipe', 'r_rate_recipe' );
add_action( 'admin_init', 'recipe_admin_init' );
add_action( 'enqueue_block_editor_assets', 'r_enqueue_block_editor_assets' );

// Shortcodes
