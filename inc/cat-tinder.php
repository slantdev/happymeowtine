<?php

register_post_type('cats_tinder', array(
  'name' => 'cats_tinder',
  'label' => 'Cats Tinder',
  'active' => true,
  'description' => '',
  'hierarchical' => false,
  'supports' => array(
    'title',
    'editor',
    'author',
    'thumbnail',
    'excerpt',
    'custom-fields',
    'revisions',
  ),
  'taxonomies' => array(),
  'public' => true,
  'exclude_from_search' => false,
  'publicly_queryable' => true,
  'can_export' => true,
  'delete_with_user' => null,
  'labels' => array(),
  'menu_position' => '',
  'menu_icon' => 'dashicons-buddicons-activity',
  'show_ui' => true,
  'show_in_menu' => true,
  'show_in_nav_menus' => true,
  'show_in_admin_bar' => true,
  'has_archive' => true,
  'rewrite' => true,
  'capability_type' => 'post',
  'capabilities' => array(),
  'map_meta_cap' => null,
  'show_in_rest' => false,
  'rest_base' => '',
  'rest_controller_class' => 'WP_REST_Posts_Controller',
  'acfe_archive_template' => '',
  'acfe_archive_ppp' => 10,
  'acfe_archive_orderby' => 'date',
  'acfe_archive_order' => 'DESC',
  'acfe_archive_meta_key' => '',
  'acfe_archive_meta_type' => '',
  'acfe_single_template' => '',
  'acfe_admin_archive' => false,
  'acfe_admin_ppp' => 10,
  'acfe_admin_orderby' => 'date',
  'acfe_admin_order' => 'DESC',
  'acfe_admin_meta_key' => '',
  'acfe_admin_meta_type' => '',
));

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
