<?php

function r_recipe_creator_shortcode() {
  $recipe_option = get_option( 'r_opts' );

  if( !is_user_logged_in() && $recipe_option['recipe_submission_login_required'] == 2 ) {
    return 'You must be logged in to submit a recipe.';
  }

  $creatorHTML = file_get_contents( 'creator-template.php', true );

  $editorHTML = r_generate_content_editor();

  $creatorHTML = str_replace( 'CONTENT_EDITOR', $editorHTML, $creatorHTML);

  return $creatorHTML;
}

function r_generate_content_editor() {
  ob_start();
  wp_editor( '', 'recipecontenteditor' );
  $editor_content = ob_get_clean();
  return $editor_content;
}