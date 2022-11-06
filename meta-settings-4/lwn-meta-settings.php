<?php
/*
 * Plugin Name: LWN Meta Tags 4
 * Description: Add custom meta tags from settings page
 * Author: Nawras Ali
 * Text Domain: meta-settings-4
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
    lwn_get_options();
}

/**Get Options */
function lwn_get_options()
{
    $options = get_option('lwn_meta_tags_options', []);
    $default_options = [
    'meta_name' => 'description',
    'meta_content' => 'here is website description',
  ];
    if (empty($options)) {
        update_option('lwn_meta_tags_options', $default_options);
    }
    return $options;
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
    if (isset($_GET['message']) && ($_GET['message'] = 'ok')) {
        $message_text =
      '<div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible">';
        $message_text .= '<p>';
        $message_text .= '<strong>';
        $message_text .= __('Settings Saved', 'meta-settings-4');
        $message_text .= '</strong>';
        $message_text .= '</p>';

        $message_text .= '</div>';
    } else {
        $message_text = '';
    }
    $html = '<div class="lwn-container">';
    $html .= $message_text;
    $html .= '<h1 class="lwn-title">';
    $html .= __('Meta Tags', 'meta-settings-4');
    $html .= '</h1>';
    $html .= '<h4 class="lwn-heading">';
    $html .= __('Your current meta name is: ', 'meta-settings-4');
    $html .= $tag_name;
    $html .= '</h4>';
    $html .= '<h4 class="lwn-heading">';
    $html .= __('Your current meta content is: ', 'meta-settings-4');
    $html .= $tag_content;
    $html .= '</h4>';
    $html .= '<hr />';
    $html .= '<h3 class="lwn-heading">';
    $html .= __('Add your tags here', 'meta-settings-4');
    $html .= '</h3>';
    // add your form here
    $html .= '<form method="post" action="admin-post.php" >';
    $html .= '<input type="hidden" name="action"  value="lwn_save_meta_tags" />';
    $html .= wp_nonce_field('lwnMetaTags', '_lwn_meta_tags_form_nonce');
    $html .= '<div class="lwn-form-control" >';
    $html .= '<label class="lwn-label" for="lwn-meta-name"> ';
    $html .= __('Meta Name', 'meta-settings-4');
    $html .= '</label> ';
    $html .= "<input name='lwn-meta-name' type='text' value='{$tag_name}' />";
    $html .= '</div >';
    $html .= '<div class="lwn-form-control" >';
    $html .= '<label class="lwn-label" for="lwn-meta-content"> ';
    $html .= __('Meta Content', 'meta-settings-4');
    $html .= '</label> ';
    $html .= "<input name='lwn-meta-content' type='text' value='{$tag_content}' />";
    $html .= '</div >';
    $html .= '<div class="lwn-form-control" >';
    $html .= "<input type='submit' class='lwn-button' value=' ";
    $html .= __('Save', 'meta-settings-4');
    $html .= "'/>";
    $html .= '</div >';

    $html .= '</form>';

    $html .= '</div>';
    return $html;
}
function lwn_meta_tags_config_page()
{
    $lwn_meta_name = get_option('lwn_meta_tags_options')['meta_name'];
    $lwn_meta_content = get_option('lwn_meta_tags_options')['meta_content'];

    echo lwn_meta_tags_html_code($lwn_meta_name, $lwn_meta_content);
}

/* Save Meta to Database**/
add_action('admin_init', 'lwn_meta_tags_admin_init');
function lwn_meta_tags_admin_init()
{
    add_action('admin_post_lwn_save_meta_tags', 'lwn_save_options_to_db');
}
function lwn_save_options_to_db()
{
    if (!current_user_can('manage_options')) {
        wp_die(
            __('You have no authorization to do this action.', 'meta-settings-4')
        );
    }
    check_admin_referer('lwnMetaTags', '_lwn_meta_tags_form_nonce');

    /**Get POST VALUES*/
    $provided_name = $_POST['lwn-meta-name'];
    $provided_content = $_POST['lwn-meta-content'];

    /** sanitize provided values */
    $updated_options = [];
    if ($provided_name) {
        $clean_name = sanitize_text_field($provided_name);
        $updated_options['meta_name'] = $clean_name;
    }
    if ($provided_content) {
        $clean_content = sanitize_text_field($provided_content);
        $updated_options['meta_content'] = $clean_content;
    }

    // save to db
    update_option('lwn_meta_tags_options', $updated_options);

    // Homework:
    // if the option is updated, show ok message;
    // otherwise, show error message

    wp_redirect(
        add_query_arg(
            ['page' => 'lwn-meta-tags', 'message' => 'ok'],
            admin_url('options-general.php')
        )
    );
    exit();
}

/** Add meta tag to the head */
add_action('wp_head', 'lwn_add_meta_tag');

function lwn_add_meta_tag()
{
    $meta_name = get_option('lwn_meta_tag_name');
    $meta_content = get_option('lwn_meta_tag_content');
    echo "<meta name='{$meta_name}' content='{$meta_content}' />";
}
