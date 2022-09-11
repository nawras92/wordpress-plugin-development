<?php

/*
 * Plugin Name: Custom Style
 * Description: add customized css rules to the website.
 * Author: Nawras Ali
 *
 * */

/** Add custom style action */
add_action('wp_head', 'lwn_add_custom_style');

function lwn_add_custom_style()
{
    $css_url = plugins_url('css/style.css', __FILE__);
    echo "<link rel='stylesheet' href='{$css_url}'>";
}
