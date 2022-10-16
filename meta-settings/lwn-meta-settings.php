<?php
/*
 * Plugin Name: LWN Meta Tags
 * Description: Add custom meta tags from settings page
 * Author: Nawras Ali
 * */

/** Add options to db upon plugin activation */
register_activation_hook(__FILE__, 'lwn_set_meta_options');
function lwn_set_meta_options()
{
    if (!get_option('lwn_meta_tag_name')) {
        add_option('lwn_meta_tag_name', 'author');
    }
    if (!get_option('lwn_meta_tag_content')) {
        add_option('lwn_meta_tag_content', 'Nawras Ali');
    }
}

/** Add plugin menu to settings */
add_action('admin_menu', 'lwn_meta_settings_menu');
function lwn_meta_settings_menu()
{
    add_options_page(
        'LWN Meta Tags',
        'LWN Meta',
        'manage_options',
        'lwn-meta-tags',
        'lwn_meta_tags_config_page'
    );
}
function lwn_meta_tags_config_page()
{
    $lwn_meta_name = get_option('lwn_meta_tag_name');
    $lwn_meta_content = get_option('lwn_meta_tag_content');
    $html = '<h1>Meta Tags</h1>';
    $html .= '<p>Add your tags here: </p>';
    $html .= '<h3>Your meta name is: </h3>';
    $html .= $lwn_meta_name;
    $html .= '<h3>Your meta content is: </h3>';
    $html .= $lwn_meta_content;

    echo $html;
}

/** Add meta tag to the head */
add_action('wp_head', 'lwn_add_meta_tag');

function lwn_add_meta_tag()
{
    $meta_name = get_option('lwn_meta_tag_name');
    $meta_content = get_option('lwn_meta_tag_content');
    echo "<meta name='{$meta_name}' content='{$meta_content}' />";
}
