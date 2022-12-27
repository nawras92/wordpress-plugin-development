<?php


add_filter('template_include', 'lwn_recipe_custom_type_add_template');

function lwn_recipe_custom_type_add_template($template_path)
{
    if (is_single() && get_post_type() === 'lwn_recipe') {
        $template_name = locate_template(array('templates/single-lwn_recipe.php'));
        if ($template_name) {
            return $template_name;
        } else {
            /* add_filter('the_content', 'lwn_recipe_custom_type_filter_content'); */
            $plugin_template = LWN_RECIPE_CUSTOM_POST_PLUGIN_PATH . '/templates/single-lwn_recipe.php';
            return $plugin_template;
        }
    }

    return $template_path;
}

function lwn_recipe_custom_type_filter_content($content)
{
    if (empty(get_the_ID())) {
        return $content;
    }

    $id = get_the_ID();
    $prep_time = get_post_meta($id, 'lwn_recipe_prep_time', true);
    $cook_time = get_post_meta($id, 'lwn_recipe_cook_time', true);
    $total_time = get_post_meta($id, 'lwn_recipe_total_time', true);
    $servings = get_post_meta($id, 'lwn_recipe_servings', true);
    $meal = get_post_meta($id, 'lwn_recipe_meal', true);
    $vegan = get_post_meta($id, 'lwn_recipe_vegan', true);

    $new_content = '<div class="recipe-container">';
    $new_content .= '<div class="recipe-meta-box">';
    $new_content .= '<div class="recipe-single-meta">';
    $new_content .= __('Prep time', 'lwn-recipe-custom-type') . ": " . $prep_time ;
    $new_content .=  " " . __('Minutes', 'lwn-recipe-custom-type') ;
    $new_content .= '</div>';
    $new_content .= '<div class="recipe-single-meta">';
    $new_content .= __('Cook time', 'lwn-recipe-custom-type') . ": " . $cook_time;
    $new_content .= " " .  __('Minutes', 'lwn-recipe-custom-type') ;
    $new_content .= '</div>';
    $new_content .= '<div class="recipe-single-meta">';
    $new_content .= __('Total time', 'lwn-recipe-custom-type') . ": " . $total_time;
    $new_content .= " " .  __('Minutes', 'lwn-recipe-custom-type') ;
    $new_content .= '</div>';
    $new_content .= '<div class="recipe-single-meta">';
    $new_content .= __('Servings', 'lwn-recipe-custom-type') . ": " . $servings;
    $new_content .= '</div>';
    $new_content .= '<div class="recipe-single-meta">';
    $new_content .= __('Meal', 'lwn-recipe-custom-type') . ": " . $meal;
    $new_content .= '</div>';
    $new_content .= '<div class="recipe-single-meta">';
    $new_content .= __('Vegan', 'lwn-recipe-custom-type') . ": ";
    $new_content .= $vegan === 'on' ? 'Yes' : 'No' ;
    $new_content .= '</div>';
    $new_content .= '</div>';
    $new_content .= '<div class="recipe-text">';
    $new_content .= $content;

    $new_content .= '</div>';


    $new_content .= '</div>';
    return $new_content;
}
