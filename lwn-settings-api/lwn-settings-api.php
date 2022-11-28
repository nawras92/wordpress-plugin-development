<?php
/**
 * Plugin Name:       LWN Settings API
 * Plugin URI:        https://learnwithnaw.com/learning-path/3
 * Description:       Learn Settings API
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Nawras Ali
 * Author URI:        https://learnwithnaw.com
 * Text Domain:       lwn-settings-api
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://learnwithnaw.com/learning-path/
 */

/*Define Plugin Path */
define('LWN_SETTINS_API_PLUGIN_PATH', plugin_dir_path(__FILE__));

/**Upon Activation*/
register_activation_hook(__FILE__, 'lwn_settings_api_activate_function');
function lwn_settings_api_activate_function()
{
    // Function to run when the user clicks on activate plugin.
    // Add Options to DB , Add table to DB
    lwn_settings_api_get_options();
}

/*Required Files /Includes */
require_once(LWN_SETTINS_API_PLUGIN_PATH . 'includes/setup-options.php');
require_once(LWN_SETTINS_API_PLUGIN_PATH . 'includes/admin-menus.php');
require_once(LWN_SETTINS_API_PLUGIN_PATH . 'includes/config-settings-api.php');


/**Upon Deactivation*/
register_deactivation_hook(__FILE__, 'lwn_settings_api_deactivate_function');
function lwn_settings_api_deactivate_function()
{
    // Function to run when the user clicks on deactivate plugin.
}
