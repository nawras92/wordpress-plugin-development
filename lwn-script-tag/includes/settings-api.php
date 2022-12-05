<?php

add_action('admin_init', 'lwn_script_tag_settings_api');
function lwn_script_tag_settings_api()
{
    $args = array(
        'type' => 'array',
        'sanitize_callback' => 'lwn_script_tag_sanitize_input'
    );
    register_setting(
        'lwn_script_tag_settings',
        'lwn_script_tag_options',
        $args
    );

    add_settings_section(
        'lwn_script_tag_main_section',
        __('Main Section', 'lwn-script-tag'),
        'lwn_script_tag_main_section_code',
        'lwn-script-tag'
    );
    add_settings_field(
        'script_location',
        __('Script Location', 'lwn-script-tag'),
        'lwn_script_tag_select_script_location',
        'lwn-script-tag',
        'lwn_script_tag_main_section',
        array('name' => 'script_location', 'locations' => array('Head', 'Footer'))
    );
    add_settings_field(
        'script_content',
        __('Script Content', 'lwn-script-tag'),
        'lwn_script_tag_textarea_script_content',
        'lwn-script-tag',
        'lwn_script_tag_main_section',
        array('name' => 'script_content')
    );
}

//sanitize function
function lwn_script_tag_sanitize_input($input)
{
    //sanitize
    /* $option1 = 'script_location'; */
    /* $option2 = 'script_content'; */
    /* if (isset($input[$option1])) { */
    /*     $input[$option1] = sanitize_text_field($input[$option1]); */
    /* } */
    /* if (isset($input[$option2])) { */
    /*     $input[$option2] = sanitize_text_field($input[$option2]); */
    /* } */
    return $input;
}

// Main Section
function lwn_script_tag_main_section_code()
{
    echo "<p>Main Section</p>";
}

// Select Script Location
function lwn_script_tag_select_script_location($data)
{
    extract($data);
    $options = lwn_script_tag_get_options();
    $html = '';
    $html .= sprintf('<select name="lwn_script_tag_options[%1$s]">', esc_html($name));
    foreach ($locations as $loc) {
        $html .= sprintf(
            '<option value="%1$s" %2$s>%1$s</option>',
            esc_html($loc),
            selected($options[$name], $loc, false)
        );
    }
    $html .= "</select>";
    echo $html;
}


// Script Content
function lwn_script_tag_textarea_script_content($data)
{
    extract($data);
    $options = lwn_script_tag_get_options();
    $html = '';
    $html .= sprintf(
        '<textarea name="lwn_script_tag_options[%1$s]" cols="30" rows="5">%2$s</textarea>',
        esc_html($name),
        $options[$name]
    );
    echo $html;
}
