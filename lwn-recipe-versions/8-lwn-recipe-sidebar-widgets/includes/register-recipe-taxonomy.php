<?php

add_action('init', 'lwn_recipe_add_taxonomy');

function lwn_recipe_add_taxonomy()
{
  register_taxonomy('lwn_recipe_type', 'lwn_recipe', [
    'labels' => [
      'name' => __('Recipe Type', 'lwn-recipe'),
      'add_new_item' => __('Add New Recipe Type', 'lwn-recipe'),
      'add_item_name' => __('New Recipe Type Name', 'lwn-recipe'),
    ],
    'show_ui' => true,
    'show_tagcloud' => false,
    'hierarchical' => true,
    'show_in_nav_menus' => true,
    'rewrite' => ['slug' => 'recipe-type'],
  ]);
}
