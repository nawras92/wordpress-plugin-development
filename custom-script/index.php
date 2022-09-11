<?php

/**
 * Plugin Name: Custom Script
 *
 * */

add_action('wp_footer', 'lwn_add_custom_script');
function lwn_add_custom_script()
{
    $script_url = esc_url(plugins_url('js/script.js', __FILE__));
    echo "<script src='{$script_url}'></script>";
}
