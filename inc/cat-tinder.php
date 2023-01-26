<?php

function load_cat()
{
  $catID = $_POST['cat_id'];
  $data = '';
  $ajaxposts = new WP_Query([
    'post_type' => 'cats_tinder',
    'p' => $catID,
  ]);

  if ($ajaxposts->have_posts()) {
    while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
      //$data .= $ajaxposts;
      //var_dump($ajaxposts);
      $data = array(
        'name' => get_the_title(),
        'id' => get_field('cat_tinder_id'),
        'age' => get_field('cat_tinder_age'),
        'gender' => get_field('cat_tinder_gender'),
        'microchip' => get_field('cat_tinder_microchip'),
        'description' => get_field('cat_tinder_description'),
        'images' => get_field('cat_tinder_images'),
      );
    endwhile;
  }

  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data);
  exit;
}
add_action('wp_ajax_load_cat', 'load_cat');
add_action('wp_ajax_nopriv_load_cat', 'load_cat');
