<?php

/*
 * Plugin Name: LWN ShortCode Plugin
 * Description: add twitter and other shortcodes
 * Author: Nawras Ali
 * */

/** For members only Shortcode*/
add_shortcode('lwn-members-only', 'lwn_add_members_only_shortcode');
function lwn_add_members_only_shortcode($atts, $content)
{
    if (is_user_logged_in()) {
        $output = "<div>{$content}</div>";
    } else {
        $output = 'you can NOT view this content';
    }
    return $output;
}

/** Twitter 2 Shortcode*/
add_shortcode('lwn-twitter-2', 'lwn_add_twitter_2_shortcode');
function lwn_add_twitter_2_shortcode($attributes)
{
    /* print_r($attributes); */
    /* echo $attributes['username']; */
    extract($attributes);
    if (empty($username)) {
        $username = 'barackObama';
    } else {
        $username = sanitize_text_field($username);
    }
    $output = "<a class='twitter-timeline' href='https://twitter.com/{$username}?ref_src=twsrc%5Etfw'>Tweets by {$username}</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>";

    return $output;
}
/** Twitter 1 Shortcode*/
add_shortcode('lwn-twitter-1', 'lwn_add_twitter_1_shortcode');
function lwn_add_twitter_1_shortcode()
{
    $output =
    "<a class='twitter-timeline' href='https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw'>Tweets by TwitterDev</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>";

    return $output;
}

/** Simple Shortcode*/
add_shortcode('lwn-simple', 'lwn_add_simple_shortcode');
function lwn_add_simple_shortcode()
{
    $output = '<h3>simple shortcode</h3>';
    return $output;
}
