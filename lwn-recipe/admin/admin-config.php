<?php
$filter_name =
  'plugin_action_links_' .
  plugin_basename(LWN_RECIPE_PLUGIN_PATH . '/lwn-recipe.php');

add_filter($filter_name, 'lwn_recipe_add_settings_link');
function lwn_recipe_add_settings_link($links)
{
  $settings_url = esc_url(
    admin_url('options-general.php?page=lwn-recipe-plugin')
  );
  $settings_aTag = "<a href='{$settings_url}' >";
  $settings_aTag .= esc_html__('Settings', 'lwn-recipe');
  $settings_aTag .= '</a>';
  array_push($links, $settings_aTag);

  return $links;
}

