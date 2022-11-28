<?php
/**
 * Plugin Name:       LWN Clean Plugin
 * Plugin URI:        https://learnwithnaw.com/learning-path/3
 * Description:       An Example of clean Plugin Structure
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Nawras Ali
 * Author URI:        https://learnwithnaw.com
 * Text Domain:       lwn-clean-plugin
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://learnwithnaw.com/learning-path/
 */

/**Upon Activation*/
register_activation_hook(__FILE__, 'lwn_clean_plugin_activate_function');
function lwn_clean_plugin_activate_function()
{
    // Function to run when the user clicks on activate plugin.
}


/**Upon Deactivation*/
register_deactivation_hook(__FILE__, 'lwn_clean_plugin_deactivate_function');
function lwn_clean_plugin_deactivate_function()
{
    // Function to run when the user clicks on deactivate plugin.
}
