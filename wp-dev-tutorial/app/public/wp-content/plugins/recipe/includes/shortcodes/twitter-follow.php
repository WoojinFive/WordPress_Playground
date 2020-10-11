<?php

function r_twitter_follow_shortcode( $atts, $content = null ) {

  $atts = shortcode_atts([
    'handle' => 'udemy'
  ], $atts); // user입력이 있으면 handle에 그거 쓰고 , 없으면 default로 udemy

  return '<a href="https:/twitter.com/' . $atts['handle'] . '" class="button button-rounded button-aqua" target="_blank"><i class="icon-twitter"></i> ' . do_shortcode($content) . '</a>';
}