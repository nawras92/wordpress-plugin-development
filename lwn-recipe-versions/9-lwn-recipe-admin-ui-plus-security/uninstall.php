<?php

// If the is not called by wordpress, DIE
if (! defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Unregister custom type lwn_recipe
add_action('init', 'lwn_recipe_unregister_recipe_custom_type');
function lwn_recipe_unregister_recipe_custom_type(){
    unregister_post_type('lwn_recipe');
}

// Unregister custom taxonomy type lwn_recipe_type
add_action('init', 'lwn_recipe_unregister_recipe_taxonomy_type');
function lwn_recipe_unregister_recipe_taxonomy_type(){
    unregister_taxonomy('lwn_recipe_type');
}



