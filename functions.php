<?php

add_action('wp_enqueue_scripts', 'salient_child_enqueue_styles', 100);

function salient_child_enqueue_styles()
{

  $nectar_theme_version = nectar_get_theme_version();
  wp_enqueue_style('salient-child-style', get_stylesheet_directory_uri() . '/style.css', '', $nectar_theme_version);

  if (is_rtl()) {
    wp_enqueue_style('salient-rtl',  get_template_directory_uri() . '/rtl.css', array(), '1', 'screen');
  }
}


function enqueue_scripts()
{
  $version = md5('20220815.3'); // uniqid();
  wp_enqueue_script('cpvs', get_stylesheet_directory_uri() . '/assets/js/cp_app.js', array('jquery'), $version, true);
  wp_enqueue_style('cpvs', get_stylesheet_directory_uri() . '/assets/css/cp_app.css', null, $version);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

require_once(dirname(__FILE__) . '/inc/cat-tinder.php');
