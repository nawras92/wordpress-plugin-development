<?php
/*
 * Plugin Name: LWN Meta Tags 8
 * Description: Add custom meta tags from settings page
 * Author: Nawras Ali
 * Text Domain: meta-settings-8
 * */

/*
 * 2- make the plugin translateable
 * 3- add form to the configuration page
 * 8- save changes to database
 * 8- check if the plugin works
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

/**change the checkbox value
 * A possible jquery solution
 * it needs work
 * */

function lwn_change_checkbox_value()
{
    wp_enqueue_script(
        'lwn-meta-plugin-checkbox-js',
        plugin_dir_url(__FILE__) . 'js/checkbox-script.js'
    );
    /* echo '<script type="text/javascript">'; */
    /* echo 'console.log("hiiiiiiiiii from func");'; */
    /* echo '</script>'; */
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
    [
      'name' => 'description',
      'content' => 'here is website description',
      'show' => 'no',
    ],
    [
      'name' => 'author',
      'content' => 'Nawras Ali',
      'show' => 'no',
    ],
    [
      'name' => 'extra 1',
      'content' => 'Extra 1 content here',
      'show' => 'no',
    ],
    [
      'name' => 'extra 2',
      'content' => 'Extra 2 content here',
      'show' => 'no',
    ],
    [
      'name' => 'extra 3',
      'content' => 'Extra 3 content here',
      'show' => 'no',
    ],
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
function lwn_meta_tags_html_code($tags)
{
    if (isset($_GET['message']) && $_GET['message'] === 'ok') {
        $message_text =
      '<div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible">';
        $message_text .= '<p>';
        $message_text .= '<strong>';
        $message_text .= __('Settings Saved', 'meta-settings-8');
        $message_text .= '</strong>';
        $message_text .= '</p>';

        $message_text .= '</div>';
    } elseif (isset($_GET['message']) && $_GET['message'] === 'notOk') {
        $message_text =
      '<div id="setting-error-settings_updated" class="notice notice-error settings-error is-dismissible">';
        $message_text .= '<p>';
        $message_text .= '<strong>';
        $message_text .= __(
            'Something wrong happened, or you did not change the values.',
            'meta-settings-8'
        );
        $message_text .= '</strong>';
        $message_text .= '</p>';

        $message_text .= '</div>';
    } else {
        $message_text = '';
    }
    echo '<div class="lwn-container">';
    echo $message_text;
    echo '<h1 class="lwn-title">';
    echo __('Meta Tags', 'meta-settings-8');
    echo '</h1>';
    echo '<hr />';
    echo '<h3 class="lwn-heading">';
    echo __('Add your tags here', 'meta-settings-8');
    echo '</h3>';
    // add your form here
    echo '<form method="post" action="admin-post.php" id="lwn-meta-form" >';
    echo '<input type="hidden" name="action"  value="lwn_save_meta_tags" />';
    echo wp_nonce_field('lwnMetaTags', '_lwn_meta_tags_form_nonce');
    foreach ($tags as $index => $tag) {
        foreach ($tag as $key => $value) {
            if ($key === 'name') {
                $label = __('Meta Name', 'meta-settings-8');
                $type = 'text';
                $checked = '';
            } elseif ($key === 'content') {
                $label = __('Meta Content', 'meta-settings-8');
                $type = 'text';
                $checked = '';
            } elseif ($key === 'show') {
                $label = __('Show Meta?', 'meta-settings-8');
                $type = 'checkbox';
                $checked = $value === 'yes' ? "checked='checked'" : '';
            } else {
                $label = __('Unknown Meta Label', 'meta-settings-8');
                $type = 'text';
                $checked = '';
            }
            echo '<div class="lwn-form-control" >';
            echo "<label class='lwn-label' for='lwn-meta-{$key}-{$index}'> ";
            echo $label;
            echo '</label> ';
            echo "<input name='lwn-meta-{$key}-{$index}' type='{$type}' value='{$value}' {$checked}  />";
            echo '</div >';
        }
        echo '<hr />';
    }
    echo '<div class="lwn-form-control" >';
    echo "<input type='submit' class='lwn-button' value=' ";
    echo __('Save', 'meta-settings-8');
    echo "'/>";
    echo '</div >';

    echo '</form>';
    lwn_change_checkbox_value();

    echo '</div>';
}
function lwn_meta_tags_config_page()
{
    $meta_tags = lwn_get_options();

    lwn_meta_tags_html_code($meta_tags);
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
            __('You have no authorization to do this action.', 'meta-settings-8')
        );
    }
    check_admin_referer('lwnMetaTags', '_lwn_meta_tags_form_nonce');

    // Get options
    $options = lwn_get_options();
    $updated_options = [];
    if (isset($_POST)) {
        foreach ($options as $index => $meta_tag) {
            $posted_data = [
        'name' => '',
        'content' => '',
        'show' => '',
      ];
            foreach ($meta_tag as $key => $value) {
                $field_name = 'lwn-meta-' . $key . '-' . $index;
                if (isset($_POST[$field_name])) {
                    $clean = sanitize_text_field($_POST[$field_name]);
                    $posted_data[$key] = $clean;
                }
            }

            $updated_options[$index] = array_merge($options[$index], $posted_data);
        }
        // save to db
        $isUpdated = update_option('lwn_meta_tags_options', $updated_options);

        // Homework:
        // if the option is updated, show ok message;
        // otherwise, show error message
        $msg = $isUpdated ? 'ok' : 'notOk';

        wp_redirect(
            add_query_arg(
                ['page' => 'lwn-meta-tags', 'message' => $msg],
                admin_url('options-general.php')
            )
        );
        exit();
    }
}

/** Add meta tag to the head */
add_action('wp_head', 'lwn_add_meta_tag');

function lwn_add_meta_tag()
{
    $options = lwn_get_options();
    foreach ($options as $index => $option) {
        $meta_name = $option['name'];
        $meta_content = $option['content'];
        $meta_show = $option['show'];
        if ($meta_show === 'yes') {
            echo "<meta name='{$meta_name}' content='{$meta_content}' />";
        }
    }
}
