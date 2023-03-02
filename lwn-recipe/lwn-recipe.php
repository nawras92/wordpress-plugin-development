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
 * Domain Path:       /languages/
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Define Plugin url
define('LWN_RECIPE_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Help Tabs Constants
define('LWN_RECIPE_YOUTUBE_LINK', "https://www.youtube.com/playlist?list=PLt0HRIA9i35sTfR5hwaHkHdnAtK441aU2");
define('LWN_RECIPE_GIT_CODE', "https://github.com/nawras92/wordpress-plugin-development");
define('LWN_RECIPE_WORDPRESS_LP', "https://learnwithnaw.com/learning-path/3");
define('LWN_RECIPE_HELP_EMAIL', "help@learnwithnaw.net");

// Load translations
add_action('init', 'lwn_recipe_load_translations');
function lwn_recipe_load_translations()
{
  load_plugin_textdomain(
    'lwn-recipe',
    false,
    dirname(plugin_basename(__FILE__)) . '/languages'
  );
}

// Enqueue Admin Styles
add_action('admin_enqueue_scripts', 'lwn_recipe_admin_styles');
function lwn_recipe_admin_styles()
{
  wp_enqueue_style(
    'lwn_recipe_css_admin',
    plugins_url('admin/css/style.min.css', __FILE__)
  );
}

// Enqueue Front End Styles
add_action('wp_enqueue_scripts', 'lwn_recipe_public_styles');
function lwn_recipe_public_styles()
{
  if (is_singular('lwn_recipe')) {
    wp_enqueue_style(
      'lwn_recipe_css',
      plugins_url('public/css/style.min.css', __FILE__)
    );
  }
  if (is_post_type_archive('lwn_recipe') || is_tax('lwn_recipe_type')) {
    wp_enqueue_style(
      'lwn_recipe_css',
      plugins_url('public/css/archive.min.css', __FILE__)
    );
  }
}

// Include Files
require_once LWN_RECIPE_PLUGIN_PATH . 'admin/admin-config.php';
require_once LWN_RECIPE_PLUGIN_PATH . 'admin/admin-ui.php';
require_once LWN_RECIPE_PLUGIN_PATH . 'includes/register-recipe-type.php';
require_once LWN_RECIPE_PLUGIN_PATH . 'includes/register-recipe-taxonomy.php';
require_once LWN_RECIPE_PLUGIN_PATH . 'includes/register-recipe-metabox.php';
require_once LWN_RECIPE_PLUGIN_PATH . 'includes/register-sidebar.php';
require_once LWN_RECIPE_PLUGIN_PATH . 'includes/register-widgets.php';
require_once LWN_RECIPE_PLUGIN_PATH . 'includes/display-recipe-template.php';
