<?php

function lwn_script_tag_get_options()
{
    $options = get_option('lwn_script_tag_options', array());
    $default_options = array(
        'script_content' => 'console.log("hii from lwn script tag");',
        'script_location' => 'Footer'

    );

    if (empty($options)) {
        update_option('lwn_script_tag_options', $default_options);
    }

    return $options;
}
