<?php
add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes() {
  register_rest_route('university/v1', 'manageLike', array(
    'methods' => 'POST',
    'callback' => 'createLike'
  ));

  register_rest_route('university/v1', 'manageLike', array(
    'methods' => 'DELETE',
    'callback' => 'deleteLike'
  ));
}

function createLike($data) {
  if (is_user_logged_in()) {  // current_user_can('publish_note') 이것도 하나의 방법
    $professor = sanitize_text_field($data['professorId']);

    $existQuery = new WP_Query(array(
      'author' => get_current_user_id(),
      'post_type' => 'like',
      'meta_query' => array(
        array(
          'key' => 'liked_professor_id',
          'compare' => '=',
          'value' => $professor
        )
      )
    ));

    if ($existQuery->found_posts == 0 && get_post_type($professor) == 'professor') { // like does not already exist
      // create new like post
      return wp_insert_post(array(  // wp_insert_post는 new post id값을 return 함
        'post_type' => 'like',
        'post_status' => 'publish',
        'post_title' => '2nd PHP Test',
        'meta_input' => array( // custom field
          'liked_professor_id' => $professor
        )
      ));
    } else {
      die("Invalid professor id");
    }

    
  } else {
    die('Only logged in users can create a like.');
  }
}

function deleteLike($data) {
  $likeId = sanitize_text_field($data['like']);

  if (get_current_user_id() == get_post_field('post_author', $likeId) && get_post_type($likeId) == 'like') {
    wp_delete_post($likeId, true); // true -> trash로 안보내고 완전 지움
    return 'Congrats, like deleted.';
  } else {
    die('You do not have permission to delete that.');
  }
}