<?php
/**
 * Plugin Name:       LWN Recipe
 * Plugin URI:        https://learnwithnaw.com/learning-path/3
 * Description:       Manage your recipes easily
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Nawras Ali
 * Author URI:        https://learnwithnaw.com
 * Text Domain:       lwn-recipe
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://learnwithnaw.com/learning-path/
 */

// Define Plugin url

define('LWN_RECIPE_PLUGIN_PATH', plugin_dir_path((__FILE__)));

/**Activate the plugin */
register_activation_hook(__FILE__, 'lwn_recipe_activate_function');
function lwn_recipe_activate_function()
{
    /* a function to run when the plugin is activated */
}

/** Enqueue Scripts*/
add_action('wp_enqueue_scripts', 'lwn_recipe_public_styles');
function lwn_recipe_public_styles()
{
    if (is_singular('lwn_recipe')) {
        wp_enqueue_style('lwn_recipe_css', plugins_url('public/css/style.css', __FILE__));
    }
}

/**Add Admin Menu*/
require_once(LWN_RECIPE_PLUGIN_PATH. 'includes/admin-menus.php');
require_once(LWN_RECIPE_PLUGIN_PATH. 'includes/register-recipe-type.php');
require_once(LWN_RECIPE_PLUGIN_PATH. 'includes/register-recipe-taxonomy.php');
require_once(LWN_RECIPE_PLUGIN_PATH. 'includes/register-recipe-metabox.php');
require_once(LWN_RECIPE_PLUGIN_PATH. 'includes/display-recipe-template.php');

/**Deactivate the plugin */
register_deactivation_hook(__FILE__, 'lwn_recipe_deactive_function');
function lwn_recipe_deactive_function()
{
    // a function to run when the plugin is deactivated
}
