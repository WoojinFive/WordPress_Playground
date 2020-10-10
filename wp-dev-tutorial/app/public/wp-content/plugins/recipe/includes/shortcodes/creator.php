<?php

function r_recipe_creator_shortcode() {
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