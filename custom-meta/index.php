<?php
/*
 * Plugin Name: Custom Meta Plugin
 * Description:  Add meta description to the website
 * */

/** Add meta description tag to the head */
add_action('wp_head', 'lwn_add_description_meta_tag');

function lwn_add_description_meta_tag()
{
    $meta_content = 'this is a variable description';
    echo "<meta name='description' content='{$meta_content}' />";
}
