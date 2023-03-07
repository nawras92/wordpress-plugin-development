<?php

add_action('init', 'lwn_recipe_add_taxonomy');

function lwn_recipe_add_taxonomy()
{
  register_taxonomy('lwn_recipe_type', 'lwn_recipe', [
    'labels' => [
      'name' => esc_html__('Recipe Type', 'lwn-recipe'),
      'add_new_item' => esc_html__('Add New Recipe Type', 'lwn-recipe'),
      'add_item_name' => esc_html__('New Recipe Type Name', 'lwn-recipe'),
    ],
    'show_ui' => true,
    'show_tagcloud' => false,
    'hierarchical' => true,
    'show_in_nav_menus' => true,
    'rewrite' => ['slug' => 'recipe-type'],
  ]);
}
