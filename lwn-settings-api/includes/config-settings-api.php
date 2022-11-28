<?php

add_action('admin_init', 'lwn_settings_api_plugin_sections');
function lwn_settings_api_plugin_sections()
{
    register_setting(
        'lwn_settings_api_settings',
        'lwn_settings_api_options',
        array(
            'type' => 'array',
            'description' =>  'Example of settings api options',
            'sanitize_callback' => 'lwn_settings_api_sanitize_callback'
        )
    );

    // Add Section
    add_settings_section(
        'lwn_settings_api_main_section',
        __('Our Main Settings', 'lwn-settings-api'),
        'lwn_settings_api_display_main_section',
        'lwn-settings-api'
    ) ;

    // Add Field
    add_settings_field(
        'lwn_text_field',
        __('Text Field', 'lwn-settings-api'),
        'lwn_settings_api_display_text_field',
        'lwn-settings-api',
        'lwn_settings_api_main_section',
        array(
            'name' => 'lwn_text_field'
        )
    );
    // Add Field
    add_settings_field(
        'lwn_checkbox_field',
        __('Checkbox Field', 'lwn-settings-api'),
        'lwn_settings_api_display_checkbox_field',
        'lwn-settings-api',
        'lwn_settings_api_main_section',
        array(
            'name' => 'lwn_checkbox_field'
        )
    );
}

// Sanitize Callback
function lwn_settings_api_sanitize_callback($input)
{
    $option1 = 'lwn_text_field';
    $option2 = 'lwn_checkbox_field';

    if (isset($input[$option1])) {
        $input[$option1] = sanitize_text_field($input[$option1]);
    }

    if (isset($input[$option2])) {
        $input[$option2] =true;
    } else {
        $input[$option2] =false;
    }


    return $input;
}


// Main Section
function lwn_settings_api_display_main_section()
{
    // html to display on main section
    echo "<p>Main Section</p>";
}

// Text Field HTML
function lwn_settings_api_display_text_field($data)
{
    extract($data);
    $options = lwn_settings_api_get_options(); ?>
    <input type="text" name="lwn_settings_api_options[<?php echo esc_html($name) ; ?>]" value="<?php echo esc_html($options[$name]); ?>" />
    <br />

<?php
}
//Checkbox Field HTML
function lwn_settings_api_display_checkbox_field($data)
{
    extract($data);
    $options = lwn_settings_api_get_options(); ?>
    <input type="checkbox" name="lwn_settings_api_options[<?php echo esc_html($name) ; ?>]" value="<?php echo esc_html($options[$name]); ?>" <?php checked($options[$name]) ?> />
    <br />


<?php
}
