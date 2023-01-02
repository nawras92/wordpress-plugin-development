<?php


add_action('init', 'lwn_recipe_custom_type_add_taxonomy');

function lwn_recipe_custom_type_add_taxonomy()
{
    register_taxonomy(
        'lwn_recipe_type',
        'lwn_recipe',
        array(
            'labels' => array(
                'name' => __('Recipe Type', 'lwn-recipe-custom-post'),
                'add_new_item' => __('Add New Recipe Type', 'lwn-recipe-custom-post'),
                'add_item_name' => __('New Recipe Type Name', 'lwn-recipe-custom-post'),
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
