<?php

add_action('admin_init', 'lwn_recipe_custom_post_general_info_box');


function lwn_recipe_custom_post_general_info_box()
{
    add_meta_box(
        'lwn-recipe-general-info',
        __('Recipe General Info', 'lwn-recipe-custom-post'),
        'lwn_recipe_custom_show_general_info_box',
        'lwn_recipe',
        'normal',
        'high'
    );
}

function lwn_recipe_custom_show_general_info_box($recipe)
{
    $prep_time =  get_post_meta($recipe->ID, 'lwn_recipe_prep_time', true);
    $cook_time =  get_post_meta($recipe->ID, 'lwn_recipe_cook_time', true);
    $total_time =  get_post_meta($recipe->ID, 'lwn_recipe_total_time', true);
    $servings =  get_post_meta($recipe->ID, 'lwn_recipe_servings', true);
    $vegan =  get_post_meta($recipe->ID, 'lwn_recipe_vegan', true);
    $meal =  get_post_meta($recipe->ID, 'lwn_recipe_meal', true);
    $meals = array('Breakfast', 'Lunch', 'Dinner');


    echo "<table>";
    echo "<tr>";
    echo "<td>";
    echo __('Prep Time (in Minutes)', 'lwn-recipe-custom-type');
    echo "</td>";

    echo "<td>";
    echo "<input type='number' name='lwn_recipe_prep_time' value='";
    echo esc_html($prep_time);
    echo "' />";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Cook Time (in Minutes)', 'lwn-recipe-custom-type');
    echo "</td>";

    echo "<td>";
    echo "<input type='number' name='lwn_recipe_cook_time' value='";
    echo esc_html($cook_time);
    echo "' />";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Total Time (in Minutes)', 'lwn-recipe-custom-type');
    echo "</td>";

    echo "<td>";
    echo "<input type='number' name='lwn_recipe_total_time' value='";
    echo esc_html($total_time);
    echo "' />";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Servings', 'lwn-recipe-custom-type');
    echo "</td>";

    echo "<td>";
    echo "<input type='number' name='lwn_recipe_servings' value='";
    echo esc_html($servings);
    echo "' />";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Vegan?', 'lwn-recipe-custom-type');
    echo "</td>";

    echo "<td>";
    echo "<input type='checkbox' name='lwn_recipe_vegan' value='";
    echo esc_html($vegan);
    echo "' " . checked('on', $vegan, true) . '/>';
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Meal', 'lwn-recipe-custom-type');
    echo "</td>";

    echo "<td>";
    echo "<select name='lwn_recipe_meal'>";
    foreach ($meals as $m) {
        echo "<option ". selected($m, $meal)   .">";
        echo esc_html($m);
        echo "</option>";
    }

    echo "</select>";
    echo "</td>";

    echo "</tr>";
    echo "</table>";
}
