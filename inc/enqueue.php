<?php

function enqueue_scripts()
{
  $version = md5('20220815.3'); // uniqid();

  wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array('jquery'), $version, false);
  wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css', null, $version);

  wp_enqueue_script('cpvs', get_stylesheet_directory_uri() . '/assets/js/cp_app.js', array('jquery'), $version, true);
  wp_enqueue_style('cpvs', get_stylesheet_directory_uri() . '/assets/css/cp_app.css', null, $version);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts', 9999999);
