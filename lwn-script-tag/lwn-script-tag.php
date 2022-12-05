<?php

/**
 * Plugin Name:       LWN Script Tag
 * Plugin URI:        https://learnwithnaw.com/learning-path/3
 * Description:       An Example of clean Plugin Structure
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Nawras Ali
 * Author URI:        https://learnwithnaw.com
 * Text Domain:       lwn-script-tag
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://learnwithnaw.com/learning-path/
 */


// Register the plugin
register_activation_hook(__FILE__, 'lwn_script_tag_activate_func');
function lwn_script_tag_activate_func()
{
    // get options
    lwn_script_tag_get_options();
}

// Define plugin path
define('LWN_SCRIPT_TAG_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Includes
require_once(LWN_SCRIPT_TAG_PLUGIN_PATH . 'includes/setup-options.php');
require_once(LWN_SCRIPT_TAG_PLUGIN_PATH . 'includes/display-script.php');
require_once(LWN_SCRIPT_TAG_PLUGIN_PATH . 'includes/admin-menus.php');
require_once(LWN_SCRIPT_TAG_PLUGIN_PATH . 'includes/enqueue-scripts.php');
require_once(LWN_SCRIPT_TAG_PLUGIN_PATH . 'includes/settings-api.php');

// Deactivate the plugin
register_deactivation_hook(__FILE__, 'lwn_script_tag_deactivate_func');
function lwn_script_tag_deactivate_func()
{
    // deactivate settings
}
