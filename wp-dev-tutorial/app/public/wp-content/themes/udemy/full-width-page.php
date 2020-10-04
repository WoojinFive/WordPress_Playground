<?php 
/*
 *  Template Name: Full Width Page
 */

get_header(); 

?>

<!-- Page Title
============================================= -->
<section id="page-title">
  <div class="container clearfix">
    <h1><?php single_post_title(); ?></h1>
    <span>
      <?php
      do_action( 'plugins/wp_subtitle/the_subtitle', array(
        'post_id' =>  get_the_ID()
      ));
      ?>
    </span>
  </div>
</section><!-- #page-title end -->

<!-- rewind_posts(); // 같은 loop을 여러번 사용할때 한번의 loop끝나고 해줘야함. -->

<!-- Content
============================================= -->
<section id="content">

  <div class="content-wrap">

    <div class="container clearfix">

      <?php

      while( have_posts() ){
        the_post();
        
        global $post;
        $author_ID = $post->post_author;
        $author_URL = get_author_posts_url( $author_ID );
      }
      ?>
    </div>

  </div>

</section><!-- #content end -->

<?php get_footer(); ?>