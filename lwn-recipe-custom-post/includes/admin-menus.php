<?php


add_action('admin_menu', 'lwn_recipe_custom_post_add_admin_menus');
function lwn_recipe_custom_post_add_admin_menus()
{
    add_options_page(
        __('LWN Recipe Plugin', 'lwn-recipe-custom-post'), // Page Title
        __('LWN Recipes', 'lwn-recipe-custom-post'), // Menu Title
        'manage_options', // required capability
        'lwn-recipe-plugin', // Menu Slug
        'lwn_recipe_custom_post_config_page' // Config Page callback
    );
}


function lwn_recipe_custom_post_config_page()
{
    echo "<h1>";
    echo "Recipe Plugin";
    echo "</h1>";
    echo "<p>";
    echo "Please go to the recipe option in the sidebar";
    echo "</p>";
}
