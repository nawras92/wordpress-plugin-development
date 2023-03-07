<?php

add_action('init', 'lwn_recipe_init');
function lwn_recipe_init()
{
  $args = [
    'labels' => [
      'name' => esc_html__('LWN Recipes', 'lwn-recipe'),
      'singular_name' => esc_html__('LWN Recipe', 'lwn-recipe'),
      'add_new' => esc_html__('Add New', 'lwn-recipe'),
      'add_new_item' =>esc_html__('Add New Recipe', 'lwn-recipe'),
      'edit' => esc_html__('Edit', 'lwn-recipe'),
      'edit_item' =>esc_html__('Edit LWN Recipe', 'lwn-recipe'),
      'view' => esc_html__('View', 'lwn-recipe'),
      'view_item' => esc_html__('View LWN Recipe', 'lwn-recipe'),
      'search_items' => esc_html__('Search LWN Recipes', 'lwn-recipe'),
      'not_found' => esc_html__('No LWN Recipes Found', 'lwn-recipe'),
      'not_found_in_trash' => esc_html__('No LWN Recipes Found in Trash', 'lwn-recipe'),
    ],
    'public' => true,
    'supports' => ['title', 'thumbnail', 'comments'],
    'taxonomies' => ['lwn_recipe_type'],
    'has_archive' => true,
    'show_in_nav_menus' => true,
    'exclude_from_search' => true,
    'menu_icon' => 'dashicons-food',
    'menu_position' => 100,
    'rewrite' => ['slug' => 'recipe'],
  ];
  register_post_type('lwn_recipe', $args);
}

// Sanitize Title
add_filter('title_save_pre', 'lwn_recipe_sanitize_title');
function lwn_recipe_sanitize_title($title)
{
  global $post;
  if (isset($post) && $post->post_type === 'lwn_recipe') {
    $sanitized_title = wp_kses($title, ['strong' => []]);
    return $sanitized_title;
  }
  return $title;
}
