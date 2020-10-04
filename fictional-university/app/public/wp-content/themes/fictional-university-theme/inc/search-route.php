<?php
  
  function universityRegisterSearch() {
    register_rest_route('university/v1', 'search', array(
      'methods' => WP_REST_SERVER::READABLE, //GET
      'callback' => 'universitySearchResults'
    ));  // (namespace, route, array)
    // http://fictional-university.local/wp-json/wp/v2/professor 에서 wp가 namespace, professor가 route
  }

  function universitySearchResults($data) {
    $mainQuery = new WP_Query(array(
      'post_type' => array('post', 'page', 'professor', 'program', 'campus', 'event'),
      's' => sanitize_text_field($data['term']) // s => search
      // sanitize_text_field => injection 공격 방지
    ));

    $results = array(
      'generalInfo' => array(),
      'professors' => array(),
      'programs' => array(),
      'events' => array(),
      'campuses' => array()
    );

    while($mainQuery->have_posts()) {
      $mainQuery->the_post();

      if (get_post_type() == 'post' || get_post_type() == 'page') {
        array_push($results['generalInfo'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
          'postType' => get_post_type(),
          'authorName' => get_the_author()
        ));
      }

      if (get_post_type() == 'professor') {
        array_push($results['professors'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
          'image' => get_the_post_thumbnail_url(0, 'professorLandscape') // 0 => current post
        ));
      }

      if (get_post_type() == 'program') {
        $relatedCampuses = get_field('related_campus');

        if ($relatedCampuses) {
          foreach($relatedCampuses as $campus) {
            array_push($results['campuses'], array(
              'title' => get_the_title($campus),
              'permalink' => get_the_permalink($campus)
            ));
          }
        }

        array_push($results['programs'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
          'id' => get_the_id()
        ));
      }

      if (get_post_type() == 'campus') {
        array_push($results['campuses'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink()
        ));
      }

      if (get_post_type() == 'event') {
        $eventDate = new DateTime(get_field('event_date'));
        $description = null;

        if (has_excerpt()) {
          $description = get_the_excerpt();
        } else {
          $description = wp_trim_words(get_the_content(), 18);
        }

        array_push($results['events'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
          'month' => $eventDate->format('M'),
          'day' => $eventDate->format('d'),
          'description' => $description
        ));
      }
      
    }

    if ($results['programs']) { // 아무것도 해당하지 않는 검색어에서 전체 professor결과 뜨는거 방지
      $programsMetaQuery = array(
        'relation' => 'OR'
      );
  
      foreach($results['programs'] as $item) {
        array_push($programsMetaQuery, array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"' . $item['id'] . '"'
        ));
      }
  
      $programRelationshipQuery = new WP_Query(array(
        'post_type' => array('professor', 'event'),
        'meta_query' => $programsMetaQuery
      ));
  
      while($programRelationshipQuery->have_posts()) {
        $programRelationshipQuery->the_post();

        if (get_post_type() == 'event') {
          $eventDate = new DateTime(get_field('event_date'));
          $description = null;
  
          if (has_excerpt()) {
            $description = get_the_excerpt();
          } else {
            $description = wp_trim_words(get_the_content(), 18);
          }
  
          array_push($results['events'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'month' => $eventDate->format('M'),
            'day' => $eventDate->format('d'),
            'description' => $description
          ));
        }
  
        if (get_post_type() == 'professor') {
          array_push($results['professors'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'image' => get_the_post_thumbnail_url(0, 'professorLandscape') // 0 => current post
          ));
        }   
      }
  
      $results['professors'] = array_values(array_unique($results['professors'], SORT_REGULAR)); 
      // array_unique => remove duplicated value, array_values => index넘버가 duplicated제거 후 0, 2, 3  이런식으로 되는것 방지
      $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR)); 
    }

    return $results;
  }

  add_action('rest_api_init', 'universityRegisterSearch');