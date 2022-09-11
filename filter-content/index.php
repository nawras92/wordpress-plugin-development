<?php

/*
 * Plugin Name: Filter Content
 * Description: add content at the end of the post content.
 * */

add_filter('the_content', 'lwn_add_post_content');
function lwn_add_post_content($the_content)
{
    $footer_content = '<p>Thank you for reading our post</p>';
    $new_content = $the_content . $footer_content;
    return $new_content;
}
