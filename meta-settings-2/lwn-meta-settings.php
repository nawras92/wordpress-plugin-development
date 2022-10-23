<?php
/*
 * Plugin Name: LWN Meta Tags 2
 * Description: Add custom meta tags from settings page
 * Author: Nawras Ali
 * Text Domain: meta-settings-2
 * */

/*
 * 2- make the plugin translateable
 * 3- add form to the configuration page
 * 4- save changes to database
 * 5- check if the plugin works
 * */
/**add stylesheet*/
add_action('admin_enqueue_scripts', 'lwn_register_plugin_styles');
function lwn_register_plugin_styles()
{
    wp_enqueue_style(
        'lwn-meta-plugin-css',
        plugin_dir_url(__FILE__) . 'css/style.css'
    );
}

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

/**HTML Code for configuration page*/
function lwn_meta_tags_html_code($tag_name, $tag_content)
{
    $html = '<div class="lwn-container">';
    $html .= '<h1 class="lwn-title">';
    $html .= __('Meta Tags', 'meta-settings-2');
    $html .= '</h1>';
    $html .= '<h4 class="lwn-heading">';
    $html .= __('Your current meta name is: ', 'meta-settings-2');
    $html .= $tag_name;
    $html .= '</h4>';
    $html .= '<h4 class="lwn-heading">';
    $html .= __('Your current meta content is: ', 'meta-settings-2');
    $html .= $tag_content;
    $html .= '</h4>';
    $html .= '<hr />';
    $html .= '<h3 class="lwn-heading">';
    $html .= __('Add your tags here', 'meta-settings-2');
    $html .= '</h3>';
    // add your form here
    $html .= '<form method="post" >';
    $html .= '<div class="lwn-form-control" >';
    $html .= '<label class="lwn-label" for="lwn-meta-name"> ';
    $html .= __('Meta Name', 'meta-settings-2');
    $html .= '</label> ';
    $html .= "<input name='lwn-meta-name' type='text' value={$tag_name} />";
    $html .= '</div >';
    $html .= '<div class="lwn-form-control" >';
    $html .= '<label class="lwn-label" for="lwn-meta-content"> ';
    $html .= __('Meta Content', 'meta-settings-2');
    $html .= '</label> ';
    $html .= "<input name='lwn-meta-content' type='text' value={$tag_content} />";
    $html .= '</div >';
    $html .= '<div class="lwn-form-control" >';
    $html .= "<input type='submit' class='lwn-button' value=' ";
    $html .= __('Save', 'meta-settings-2');
    $html .= "'/>";
    $html .= '</div >';

    $html .= '</form>';

    $html .= '</label>';
    return $html;
}
function lwn_meta_tags_config_page()
{
    $lwn_meta_name = get_option('lwn_meta_tag_name');
    $lwn_meta_content = get_option('lwn_meta_tag_content');

    echo lwn_meta_tags_html_code($lwn_meta_name, $lwn_meta_content);
}

/** Add meta tag to the head */
add_action('wp_head', 'lwn_add_meta_tag');

function lwn_add_meta_tag()
{
    $meta_name = get_option('lwn_meta_tag_name');
    $meta_content = get_option('lwn_meta_tag_content');
    echo "<meta name='{$meta_name}' content='{$meta_content}' />";
}
