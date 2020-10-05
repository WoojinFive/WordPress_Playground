<?php

function ju_misc_customizer_section( $wp_customize ) {
  // setting
  $wp_customize->add_setting( 'ju_header_show_search', array(
    'default'     =>  'yes',
    'transport'   =>  'postMessage' // default value is Refresh. Refresh will tell WordPress to refresh the page if a value is changed. postMessage will tell WorlPress that the developer will handle the changes using JavaScript.
    // refresh없이 javascript로 아이콘 hide, show조절하기 위함. (enqueue.php)
  ));

  $wp_customize->add_setting( 'ju_header_show_cart', array(
    'default'     =>  'yes',
    'transport'   =>  'postMessage'
  ));

  $wp_customize->add_setting( 'ju_footer_copyright_text', array(
    'default'     =>  'Copyrights &copy; 2020 All Rights Reserved.'
  ));

  $wp_customize->add_setting( 'ju_footer_tos_page', array(
    'default'     =>  0
  ));

  $wp_customize->add_setting( 'ju_footer_privacy_page', array(
    'default'     =>  0
  ));

  // section
  $wp_customize->add_section( 'ju_misc_section', array(
    'title'       =>  __( 'Udemy Misc Settings', 'Udemy' ),
    'priority'    =>  30,
    'panel'       =>  'udemy'
  ));

  // controller
  $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'ju_header_show_search_input',
    array(
      'label'     =>  __( 'Show Search Button in Header', 'udemy' ),
      'section'   =>  'ju_misc_section',
      'settings'  =>  'ju_header_show_search',
      'type'      =>  'checkbox',
      'choices'   =>  array(
        'yes'     =>  'Yes'
      )
    )
  ));

  $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'ju_header_show_cart_icon',
    array(
      'label'     =>  __( 'Show Cart Icon in Header', 'udemy' ),
      'section'   =>  'ju_misc_section',
      'settings'  =>  'ju_header_show_cart',
      'type'      =>  'checkbox',
      'choices'   =>  array(
        'yes'     =>  'Yes'
      )
    )
  ));

  $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'ju_footer_copyright_text_input',
    array(
      'label'     =>  __( 'Copyright Text', 'udemy' ),
      'section'   =>  'ju_misc_section',
      'settings'  =>  'ju_footer_copyright_text'
    )
  ));

  $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'ju_footer_tos_page_input',
    array(
      'label'     =>  __( 'Footer TOS Page', 'udemy' ),
      'section'   =>  'ju_misc_section',
      'settings'  =>  'ju_footer_tos_page',
      'type'      =>  'dropdown-pages'
    )
  ));

  $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'ju_footer_privacy_page_input',
    array(
      'label'     =>  __( 'Footer Privacy Policy Page', 'udemy' ),
      'section'   =>  'ju_misc_section',
      'settings'  =>  'ju_footer_privacy_page',
      'type'      =>  'dropdown-pages'
    )
  ));

}