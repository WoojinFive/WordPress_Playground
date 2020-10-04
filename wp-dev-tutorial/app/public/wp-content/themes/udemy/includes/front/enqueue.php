<?php
function ju_enqueue() {
  $uri = get_theme_file_uri();
  $ver = JU_DEV_MODE ? time () : false;

  wp_register_style( 
    'ju_google_fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i',
    [],
    $ver
  ); // 이렇게 하면 dev mode일때 ver값으로 항상 현재 시간이 들어가기 때문에 css 파일을 캐쉬에서 읽어오지 않고 항상 새로 다운로드 한다. dev끝나면 functions.php에서 JU_DEV_MODE = false로 바꿔주자.
  wp_register_style( 'ju_bootstrap', $uri . '/assets/css/bootstrap.css', [], $ver );
  wp_register_style( 'ju_style', $uri . '/assets/css/style.css', [], $ver );
  wp_register_style( 'ju_dark', $uri . '/assets/css/dark.css', [], $ver );
  wp_register_style( 'ju_font_icons', $uri . '/assets/css/font-icons.css', [], $ver );
  wp_register_style( 'ju_animate', $uri . '/assets/css/animate.css', [], $ver );
  wp_register_style( 'ju_magnific_popup', $uri . '/assets/css/magnific-popup.css', [], $ver );
  wp_register_style( 'ju_responsive', $uri . '/assets/css/responsive.css', [], $ver );
  wp_register_style( 'ju_custom', $uri . '/assets/css/custom.css', [], $ver );

  wp_enqueue_style( 'ju_google_fonts' );
  wp_enqueue_style( 'ju_bootstrap' );
  wp_enqueue_style( 'ju_style' );
  wp_enqueue_style( 'ju_dark' );
  wp_enqueue_style( 'ju_font_icons' );
  wp_enqueue_style( 'ju_animate' );
  wp_enqueue_style( 'ju_magnific_popup' );
  wp_enqueue_style( 'ju_responsive' );
  wp_enqueue_style( 'ju_custom' );

  wp_register_script( 'ju_plugins', $uri . '/assets/js/plugins.js', [], $ver, true );
  wp_register_script( 'ju_functions', $uri . '/assets/js/functions.js', [], $ver, true );

  wp_enqueue_script( 'jquery' );  // jquery는 내장 되어있기 떄문에 register 안하고enqueue바로 해줌
  wp_enqueue_script( 'ju_plugins' );
  wp_enqueue_script( 'ju_functions' );
}