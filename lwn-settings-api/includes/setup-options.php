<?php

/**Get options*/
function lwn_settings_api_get_options()
{
    $options = get_option('lwn_settings_api_options', array());
    $default_options = array(
        'lwn_text_field' => 'Default text',
        'lwn_checkbox_field' => false
    );
    if (empty($options)) {
        update_option('lwn_settings_api_options', $default_options);
    }

    return $options;
}
