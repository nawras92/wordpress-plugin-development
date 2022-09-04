<?php
/*
Plugin Name: Head Plugin
Description: add new scripts and styles to the head.
Author: Nawras
 */

add_action('wp_head', 'headPlugin_add_script');

function headPlugin_add_script()
{
    echo "<script> alert('Hi from plugin') </script>";
}
