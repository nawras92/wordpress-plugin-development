<?php

add_action('admin_enqueue_scripts', 'lwn_script_tag_enqueue_scripts');
function lwn_script_tag_enqueue_scripts()
{
    wp_enqueue_style('admin-style', plugins_url('admin/css/style.css', dirname(__FILE__, 1)));
}
