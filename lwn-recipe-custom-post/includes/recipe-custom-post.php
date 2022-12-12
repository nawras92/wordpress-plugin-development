<?php

add_action('init', 'lwn_recipe_custom_post_init');
function lwn_recipe_custom_post_init()
{
    $args = array(
        'labels' => array(
            'name' => __('LWN Recipes', 'lwn-recipe-custom-post'),
            'singular_name' => __('LWN Recipe', 'lwn-recipe-custom-post'),
            'add_new' => __('Add New', 'lwn-recipe-custom-post'),
            'add_new_item' => __('Add New Recipe', 'lwn-recipe-custom-post'),
            'edit' => __('Edit', 'lwn-recipe-custom-post'),
            'edit_item' => __('Edit LWN Recipe', 'lwn-recipe-custom-post'),
            'view' => __('View', 'lwn-recipe-custom-post'),
            'view_item' => __('View LWN Recipe', 'lwn-recipe-custom-post'),
            'search_items' => __('Search LWN Recipes', 'lwn-recipe-custom-post'),
            'not_found' => __('No LWN Recipes Foudn', 'lwn-recipe-custom-post'),
            'not_found_in_trash' => __('No LWN Recipes Found in Trash', 'lwn-recipe-custom-post'),

        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'comments'),
        'taxonomies' => array(),
        'has_archive' => false,
        'exclude_from_search' => true,
        'menu_icon' => 'dashicons-food',
        'menu_position' => 100,
        'rewrite' => array('slug' => 'recipe')

    );
    register_post_type('lwn_recipe', $args);
}
