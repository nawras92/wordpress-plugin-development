<?php

add_action('admin_init', 'lwn_recipe_custom_post_details_meta_box');
function lwn_recipe_custom_post_details_meta_box()
{
    add_meta_box(
        'lwn-recipe-details',
        __('Recipe Details', 'lwn-recipe-custom-post'),
        'lwn_recipe_custom_show_details_box',
        'lwn_recipe',
        'normal',
        'default'
    );
}

function lwn_recipe_custom_show_details_box($recipe)
{
    $ingredients = get_post_meta($recipe->ID, 'lwn_recipe_ingredients', true);
    $steps = get_post_meta($recipe->ID, 'lwn_recipe_steps', true);
    $notes = get_post_meta($recipe->ID, 'lwn_recipe_notes', true);

    echo "<table>";
    echo "<tr>";
    echo "<td>";
    echo __('Ingredients', 'lwn-recipe-custom-type');
    echo "</td>";

    echo "<td>";
    echo "<textarea type='text' name='lwn_recipe_ingredients'>";
    echo esc_html($ingredients);
    echo "</textarea>";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Steps', 'lwn-recipe-custom-type');
    echo "</td>";

    echo "<td>";
    echo "<textarea type='text' name='lwn_recipe_steps'>";
    echo esc_html($steps);
    echo "</textarea>";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Notes', 'lwn-recipe-custom-type');
    echo "</td>";

    echo "<td>";
    echo "<textarea type='text' name='lwn_recipe_notes'>";
    echo esc_html($notes);
    echo "</textarea>";
    echo "</td>";

    echo "</tr>";
    echo "</table>";
}
