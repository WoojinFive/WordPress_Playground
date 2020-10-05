<?php

function ju_customize_register( $wp_customize ){
  // echo '<pre>';
  // print_r($wp_customize);
  // echo '</pre>';

  $wp_customize->get_section( 'title_tagline' )->title  = 'General'; 
  // 기존 설정 덮어쓰기. Identity 이런 이름을 General로 변경

  $wp_customize->add_panel( 'udemy', array(
    'title'         =>  __( 'Udemy', 'udemy' ),
    'description'   =>  '<p>Udemy Theme Settings</p>',
    'priority'      =>  160
  ));
  // 설정들을 하나의 panel로 묶기위해

  ju_social_customizer_section( $wp_customize );
  ju_misc_customizer_section( $wp_customize );
}