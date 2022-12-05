<?php

add_action('wp_footer', 'lwn_script_tag_display_in_footer');
function lwn_script_tag_display_in_footer()
{
    $options = lwn_script_tag_get_options();
    $script_location = $options['script_location'];
    $script_content = $options['script_content'];
    if ($script_location === 'Footer') {
        echo "<script>";
        echo $script_content;
        echo "</script>";
    } else {
        return;
    }
}

add_action('wp_head', 'lwn_script_tag_display_in_head');
function lwn_script_tag_display_in_head()
{
    $options = lwn_script_tag_get_options();
    $script_location = $options['script_location'];
    $script_content = $options['script_content'];
    if ($script_location === 'Head') {
        echo "<script>";
        echo $script_content;
        echo "</script>";
    } else {
        return;
    }
}
