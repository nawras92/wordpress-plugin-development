<?php

add_action('init', 'lwn_recipe_init');
function lwn_recipe_init()
{
    $args = array(
        'labels' => array(
            'name' => __('LWN Recipes', 'lwn-recipe'),
            'singular_name' => __('LWN Recipe', 'lwn-recipe'),
            'add_new' => __('Add New', 'lwn-recipe'),
            'add_new_item' => __('Add New Recipe', 'lwn-recipe'),
            'edit' => __('Edit', 'lwn-recipe'),
            'edit_item' => __('Edit LWN Recipe', 'lwn-recipe'),
            'view' => __('View', 'lwn-recipe'),
            'view_item' => __('View LWN Recipe', 'lwn-recipe'),
            'search_items' => __('Search LWN Recipes', 'lwn-recipe'),
            'not_found' => __('No LWN Recipes Found', 'lwn-recipe'),
            'not_found_in_trash' => __('No LWN Recipes Found in Trash', 'lwn-recipe'),

        ),
        'public' => true,
        'supports' => array('title', 'thumbnail', 'comments'),
        'taxonomies' => array(),
        'has_archive' => false,
        'exclude_from_search' => true,
        'menu_icon' => 'dashicons-food',
        'menu_position' => 100,
        'rewrite' => array('slug' => 'recipe')

    );
    register_post_type('lwn_recipe', $args);
}
