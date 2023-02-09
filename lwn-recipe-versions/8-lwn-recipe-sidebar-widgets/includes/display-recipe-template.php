<?php

add_filter('template_include', 'lwn_recipe_add_template');

function lwn_recipe_add_template($template_path)
{
  if (is_single() && get_post_type() === 'lwn_recipe') {
    $template_name = locate_template(['templates/single-lwn_recipe.php']);
    if ($template_name) {
      return $template_name;
    } else {
      return LWN_RECIPE_PLUGIN_PATH . '/templates/single-lwn_recipe.php';
    }
  }

  if (is_post_type_archive('lwn_recipe')) {
    $template_name = locate_template(['templates/archive-lwn_recipe.php']);
    if ($template_name) {
      return $template_name;
    } else {
      return LWN_RECIPE_PLUGIN_PATH . '/templates/archive-lwn_recipe.php';
    }
  }

  if (is_tax('lwn_recipe_type')) {
    $template_name = locate_template(['templates/taxonomy-lwn_recipe_type.php']);
    if ($template_name) {
      return $template_name;
    } else {
      return LWN_RECIPE_PLUGIN_PATH . '/templates/taxonomy-lwn_recipe_type.php';
    }
  }

  return $template_path;
}
