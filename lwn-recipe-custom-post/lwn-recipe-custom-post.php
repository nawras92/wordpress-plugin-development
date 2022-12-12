<?php
/**
 * Plugin Name:       LWN Recipe Custom Post
 * Plugin URI:        https://learnwithnaw.com/learning-path/3
 * Description:       A reciepe custom post
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Nawras Ali
 * Author URI:        https://learnwithnaw.com
 * Text Domain:       lwn-recipe-custom-post
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://learnwithnaw.com/learning-path/
 */

// Define Plugin url

define('LWN_RECIPE_CUSTOM_POST_PLUGIN_PATH', plugin_dir_path((__FILE__)));

/**Activate the plugin */
register_activation_hook(__FILE__, 'lwn_recipe_custom_post_activate_function');
function lwn_recipe_custom_post_activate_function()
{
    /* a function to run when the plugin is activated */
}

/**Add Admin Menu*/
require_once(LWN_RECIPE_CUSTOM_POST_PLUGIN_PATH. 'includes/admin-menus.php');
require_once(LWN_RECIPE_CUSTOM_POST_PLUGIN_PATH. 'includes/recipe-custom-post.php');
require_once(LWN_RECIPE_CUSTOM_POST_PLUGIN_PATH. 'includes/general-meta-box.php');
require_once(LWN_RECIPE_CUSTOM_POST_PLUGIN_PATH. 'includes/details-meta-box.php');
require_once(LWN_RECIPE_CUSTOM_POST_PLUGIN_PATH. 'includes/save-meta-box.php');

/**Deactivate the plugin */
register_deactivation_hook(__FILE__, 'lwn_recipe_custom_post_deactive_function');
function lwn_recipe_custom_post_deactive_function()
{
    // a function to run when the plugin is deactivated
}
