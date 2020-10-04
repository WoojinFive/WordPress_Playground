<?php 
  get_header();
  pageBanner(array(
    'title' => 'Past Events',
    'subtitle' => 'A recap of our past events.'
  ));
?>

<div class="container container--narrow page-section">
<?php

  $today = date('Ymd');
  $pastEvents = new WP_Query(array(
    'paged' => get_query_var('paged', 1), // url 의 page 값 갖고와서 해당 데이터 보여줌, 1은 첫 페이지 디폴트값
    // 'posts_per_page' => 1,
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num', // 'rand', 'title', 'post_date', 'meta_value'
    'order' => 'ASC', // 'DESC'
    'meta_query' => array( // 출력할 조건 설정
      array(
        'key' => 'event_date',
        'compare' => '<',
        'value' => $today,
        'type' => 'numeric'
      )
    )
  ));

  while($pastEvents->have_posts()) {
    $pastEvents->the_post();
    get_template_part('template-parts/content-event');
    }
  echo paginate_links(array(
    'total' => $pastEvents->max_num_pages
  ));
?>
</div>

<?php
  get_footer();
?>