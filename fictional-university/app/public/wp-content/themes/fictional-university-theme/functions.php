<?php
  function universityQueryVars($vars) {
    $vars[] = 'skyColor';
    $vars[] = 'grassColor';
    return $vars;
  }

  add_filter('query_vars', 'universityQueryVars'); // Query Vars

  require get_theme_file_path('/inc/search-route.php');
  require get_theme_file_path('/inc/like-route.php');

  function university_custom_rest() { // 기본 post API에 authorName 추가
    register_rest_field('post', 'authorName', array(
      'get_callback' => function() { return get_the_author(); }
    ));

    register_rest_field('note', 'userNoteCount', array(
      'get_callback' => function() { return count_user_posts(get_current_user_id(), 'note'); }
    ));
  }

  add_action('rest_api_init', 'university_custom_rest');

  function pageBanner($args = NULL) {
    
    if (!$args['title']) {
      $args['title'] = get_the_title();
    }

    if (!$args['subtitle']) {
      $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if (!$args['photo']) {
      if (get_field('page_banner_background_image') AND !is_archive() AND !is_home()) {
        $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
      } else {
        $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
      }
    }

    ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <!-- <?php print_r($pageBannerImage); ?> -->
        <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
        <div class="page-banner__intro">
          <p><?php echo $args['subtitle']; ?></p>
        </div>
      </div>  
    </div>
  <?php }

  function university_files() {
    //wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    //wp_enqueue_style('university_main_style', get_stylesheet_uri()); // deafult uri
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyDPshRA-W6QWyyMT7BJYRun_wxcC89Fv9E', NULL, '1.0', true);

    if (strstr($_SERVER['SERVER_NAME'], 'fictional-university.local')) {
      wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
    } else {
      wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.e36fd7b5fee0fe4626c2.js'), NULL, '1.0', true);
      wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.f9b54e55ab7c086b9a6f.js'), NULL, '1.0', true);
      wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.f9b54e55ab7c086b9a6f.css'));
    }

    wp_localize_script('main-university-js', 'universityData', array(
      'root_url' => get_site_url(),
      'nonce' => wp_create_nonce('wp_rest')
    ));
  }

  add_action('wp_enqueue_scripts', 'university_files');

  function university_features() {
    // navigation menu
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two');

    // for the title tag on browser tab
    add_theme_support('title-tag');
    // for the featured image in editor
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true); // 새로운 size의 이미지를 자동으로 생성
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
  }

  add_action('after_setup_theme', 'university_features');




  // events 페이지에서의 query 조건 걸기
  function university_adjust_queries($query) {
    if (!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {
      $query->set('posts_per_page', -1);
    }

    if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
      $query->set('orderby', 'title');
      $query->set('order', 'ASC');
      $query->set('posts_per_page', -1);
    }

    if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
      $today = date('Ymd');
      // $query->set('posts_per_page', '1');
      $query->set('meta_key', 'event_date');
      $query->set('orderby', 'meta_value_num');
      $query->set('order', 'ASC');
      $query->set('meta_query', array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        )
        ));
    }
  }

  add_action('pre_get_posts', 'university_adjust_queries');

  function universityMapKey($api) {
    $api['key'] = 'AIzaSyDPshRA-W6QWyyMT7BJYRun_wxcC89Fv9E';
    return $api;
  }

  add_filter('acf/fields/google_map/api', 'universityMapKey');




  // Redirect subscriber accounts out of admin and onto homepage
  function redirectSubsToFrontend() {
    $ourCurrentUser = wp_get_current_user();
    
    if (count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber') {
      wp_redirect(site_url('/'));
      exit;
    }
  }

  add_action('admin_init', 'redirectSubsToFrontend');

  // remove admin bar at top for subscriber user
  function noSubsAdminBar() {
    $ourCurrentUser = wp_get_current_user();
    
    if (count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber') {
      show_admin_bar(false);
    }
  }

  add_action('wp_loaded', 'noSubsAdminBar');




  // Customize Login Screen
  add_filter('login_headerurl', 'ourHeaderUrl');

  function ourHeaderUrl() {
    return esc_url(site_url('/'));
  }

  add_action('login_enqueue_scripts', 'ourLoginCSS');

  function ourLoginCSS() {
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.f9b54e55ab7c086b9a6f.css'));
  }

  function ourLoginTitle()
  {
    return get_bloginfo('name');
  }
  
  add_filter('login_headertitle', 'ourLoginTitle');




  // Force note posts to be private
  add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);
  // 10 => 같은 hook (wp_insert_post_data) 에서 여러개의 함수를 호출할때의 우선순위. 숫자 낮은게 먼저 실행 
  // 2 => parameter 가 2개

  function makeNotePrivate($data, $postarr) {
    if ($data['post_type'] == 'note') {
      // Per-User Post Limit
      if (count_user_posts(get_current_user_id(), 'note') >= 3 && !$postarr['ID']) {
        die('You have reached your note limit.');
      }
      // wp_insert_post_data는 create뿐만 아니라 post update 할때도 작동하기 때문에 !$postarr['ID'] 추가해서 only create일때만 작동하게 해줌.

      $data['post_content']  = sanitize_textarea_field($data['post_content']); // html tag 등 코드등이 전부 동작 안하도록. (이거 안해주면 해롭지 않은 코드는 db에 저장 가능)
      $data['post_title']  = sanitize_textarea_field($data['post_title']);
    }

    if ($data['post_type'] == 'note' && $data['post_status'] != 'trash') {
      $data['post_status'] = 'private';
    }
    
    return $data;
  }

