<?php

//custom post type
  function university_post_types() {
    // Event post type
    register_post_type('event', array(
      'show_in_rest' => true, // block editor 사용을 위해 true
      'capability_type' => 'event', // event에 만 해당하는 user role 만들기 위해
      'map_meta_cap' => true, // event에 만 해당하는 user role 만들기 위해
      'supports' => array('title', 'editor', 'excerpt'), // editor 에서 제공하는 기능 설정
      'rewrite' => array(
        'slug' => 'events' // url에 나타낼 문구
      ),
      'has_archive' => true, // true 해줘야 archive파일 이용 가능
      'public' => true,
      'labels' => array(
        'name' => 'Events',
        'add_new_item' => 'Add New Event',
        'edit_item' => 'Edit Event',
        'all_items' => 'All Events',
        'singuilar_name' => 'Event'
      ),
      'menu_icon' => 'dashicons-calendar'
    ));

    // Program post type
    register_post_type('program', array(
      'show_in_rest' => true, // block editor 사용을 위해 true
      'supports' => array('title'), // editor 에서 제공하는 기능 설정
      'rewrite' => array(
        'slug' => 'programs' // url에 나타낼 문구
      ),
      'has_archive' => true, // true 해줘야 archive파일 이용 가능
      'public' => true,
      'labels' => array(
        'name' => 'Programs',
        'add_new_item' => 'Add New Program',
        'edit_item' => 'Edit Program',
        'all_items' => 'All Programs',
        'singuilar_name' => 'Program'
      ),
      'menu_icon' => 'dashicons-awards'
    ));

    // Professor post type
    register_post_type('professor', array(
      'show_in_rest' => true, // block editor 사용을 위해 true
      'supports' => array('title', 'editor', 'thumbnail'), // editor 에서 제공하는 기능 설정
      // 'rewrite' => array(
      //   'slug' => 'professors' // url에 나타낼 문구
      // ),
      //'has_archive' => true, // true 해줘야 archive파일 이용 가능
      'public' => true,
      'labels' => array(
        'name' => 'Professors',
        'add_new_item' => 'Add New Professor',
        'edit_item' => 'Edit Professor',
        'all_items' => 'All Professors',
        'singuilar_name' => 'Professor'
      ),
      'menu_icon' => 'dashicons-welcome-learn-more'
    ));

    // Campus post type
    register_post_type('campus', array(
      'show_in_rest' => true, // block editor 사용을 위해 true
      'capability_type' => 'campus',
      'map_meta_cap' => true,
      'supports' => array('title', 'editor', 'excerpt'), // editor 에서 제공하는 기능 설정
      'rewrite' => array(
        'slug' => 'campuses' // url에 나타낼 문구
      ),
      'has_archive' => true, // true 해줘야 archive파일 이용 가능
      'public' => true,
      'labels' => array(
        'name' => 'Campuses',
        'add_new_item' => 'Add New Campus',
        'edit_item' => 'Edit Campus',
        'all_items' => 'All Campuses',
        'singuilar_name' => 'Campus'
      ),
      'menu_icon' => 'dashicons-location-alt'
    ));

    // Note post type
    register_post_type('note', array(
      'capability_type' => 'note', // note라는 이름의 post type에만 적용되는 brand new permission
      'map_meta_cap' => true,
      'show_in_rest' => true, // block editor 사용을 위해 true
      'supports' => array('title', 'editor'), // editor 에서 제공하는 기능 설정
      // 'rewrite' => array(
      //   'slug' => 'professors' // url에 나타낼 문구
      // ),
      //'has_archive' => true, // true 해줘야 archive파일 이용 가능
      'public' => false, // note는 private로 할거임! 그런데 false하면 dashboard에서 사라짐
      'show_ui' => true, // 그래서 이걸 추가해주면 dashboard에 나옴
      'labels' => array(
        'name' => 'Notes',
        'add_new_item' => 'Add New Note',
        'edit_item' => 'Edit Note',
        'all_items' => 'All Notes',
        'singuilar_name' => 'Note'
      ),
      'menu_icon' => 'dashicons-welcome-write-blog'
    ));

    // Like post type
    register_post_type('like', array(
      'supports' => array('title'), // editor 에서 제공하는 기능 설정
      // 'rewrite' => array(
      //   'slug' => 'professors' // url에 나타낼 문구
      // ),
      //'has_archive' => true, // true 해줘야 archive파일 이용 가능
      'public' => false, // note는 private로 할거임! 그런데 false하면 dashboard에서 사라짐
      'show_ui' => true, // 그래서 이걸 추가해주면 dashboard에 나옴
      'labels' => array(
        'name' => 'Likes',
        'add_new_item' => 'Add New Like',
        'edit_item' => 'Edit Like',
        'all_items' => 'All Likes',
        'singuilar_name' => 'Like'
      ),
      'menu_icon' => 'dashicons-heart'
    ));

  }

  add_action('init', 'university_post_types');