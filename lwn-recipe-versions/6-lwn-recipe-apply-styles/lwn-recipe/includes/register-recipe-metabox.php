<?php

add_action('admin_init', 'lwn_recipe_register_metabox');


function lwn_recipe_register_metabox()
{
    add_meta_box(
        'lwn-recipe-ingredients-metabox',
        __('Recipe Ingredients', 'lwn-recipe'),
        'lwn_recipe_display_recipe_ingredients_metabox',
        'lwn_recipe',
        'normal',
        'core'
    );
    add_meta_box(
        'lwn-recipe-steps-metabox',
        __('Recipe Steps', 'lwn-recipe'),
        'lwn_recipe_display_recipe_steps_metabox',
        'lwn_recipe',
        'normal',
        'core'
    );
    add_meta_box(
        'lwn-recipe-metabox',
        __('Recipe Info', 'lwn-recipe'),
        'lwn_recipe_display_recipe_metabox',
        'lwn_recipe',
        'normal',
        'core'
    );
}

// Steps Metabox
function lwn_recipe_display_recipe_steps_metabox($recipe)
{
    $steps = get_post_meta($recipe->ID, 'lwn_recipe_steps', true);

    /* echo "<table>"; */
    /* echo "<tr>"; */
    /* echo "<td>"; */
    /* echo __('Steps', 'lwn-recipe'); */
    /* echo "</td>"; */

    /* echo "<td>"; */
    echo  wp_editor(($steps), 'lwn-recipe-steps-editor', $settings = array('textarea_name'=>'lwn_recipe_steps'));
    /* echo "<textarea type='text' name='lwn_recipe_steps'>"; */
    /* echo esc_html($steps); */
    /* echo "</textarea>"; */
    /* echo "</td>"; */

    /* echo "</tr>"; */
    /* echo "</table>"; */
}
// Ingredients Metabox
function lwn_recipe_display_recipe_ingredients_metabox($recipe)
{
    $ingredients = get_post_meta($recipe->ID, 'lwn_recipe_ingredients', true);

    /* echo "<table>"; */
    /* echo "<tr>"; */
    /* echo "<td>"; */
    /* echo __('Ingredients', 'lwn-recipe'); */
    /* echo "</td>"; */

    /* echo "<td>"; */
    echo  wp_editor(($ingredients), 'lwn-recipe-ingredients-editor', $settings = array('textarea_name'=>'lwn_recipe_ingredients'));
    /* echo "<textarea type='text' name='lwn_recipe_ingredients'>"; */
    /* echo esc_html($ingredients); */
    /* echo "</textarea>"; */
    /* echo "</td>"; */

    /* echo "</tr>"; */

    /* echo "</tr>"; */
    /* echo "</table>"; */
}
// General Recipe Metabox
function lwn_recipe_display_recipe_metabox($recipe)
{
    $notes = get_post_meta($recipe->ID, 'lwn_recipe_notes', true);
    $desc = get_post_meta($recipe->ID, 'lwn_recipe_desc', true);
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
    echo __('Short Description', 'lwn-recipe');
    echo "</td>";

    echo "<td>";
    echo "<textarea type='text' name='lwn_recipe_desc'>";
    echo esc_html($desc);
    echo "</textarea>";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Prep Time (in Minutes)', 'lwn-recipe');
    echo "</td>";

    echo "<td>";
    echo "<input type='number' name='lwn_recipe_prep_time' value='";
    echo esc_html($prep_time);
    echo "' />";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Cook Time (in Minutes)', 'lwn-recipe');
    echo "</td>";

    echo "<td>";
    echo "<input type='number' name='lwn_recipe_cook_time' value='";
    echo esc_html($cook_time);
    echo "' />";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Total Time (in Minutes)', 'lwn-recipe');
    echo "</td>";

    echo "<td>";
    echo "<input type='number' name='lwn_recipe_total_time' value='";
    echo esc_html($total_time);
    echo "' />";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Servings', 'lwn-recipe');
    echo "</td>";

    echo "<td>";
    echo "<input type='number' name='lwn_recipe_servings' value='";
    echo esc_html($servings);
    echo "' />";
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Vegan?', 'lwn-recipe');
    echo "</td>";

    echo "<td>";
    echo "<input type='checkbox' name='lwn_recipe_vegan' value='";
    echo esc_html($vegan);
    echo "' " . checked('on', $vegan, true) . '/>';
    echo "</td>";

    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo __('Meal', 'lwn-recipe');
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
    echo "<tr>";
    echo "<td>";
    echo __('Notes', 'lwn-recipe');
    echo "</td>";

    echo "<td>";
    echo "<textarea type='text' name='lwn_recipe_notes'>";
    echo esc_html($notes);
    echo "</textarea>";
    echo "</td>";

    echo "</tr>";
    echo "</table>";
}

add_action('save_post_lwn_recipe', 'lwn_recipe_save_recipe_meta');
function lwn_recipe_save_recipe_meta($post_id)
{
    if (isset($_POST['lwn_recipe_prep_time'])) {
        update_post_meta(
            $post_id,
            'lwn_recipe_prep_time',
            intval($_POST['lwn_recipe_prep_time'])
        );
    }
    if (isset($_POST['lwn_recipe_cook_time'])) {
        update_post_meta(
            $post_id,
            'lwn_recipe_cook_time',
            intval($_POST['lwn_recipe_cook_time'])
        );
    }
    if (isset($_POST['lwn_recipe_total_time'])) {
        update_post_meta(
            $post_id,
            'lwn_recipe_total_time',
            intval($_POST['lwn_recipe_total_time'])
        );
    }
    if (isset($_POST['lwn_recipe_servings'])) {
        update_post_meta(
            $post_id,
            'lwn_recipe_servings',
            intval($_POST['lwn_recipe_servings'])
        );
    }
    if (isset($_POST['lwn_recipe_desc'])) {
        update_post_meta(
            $post_id,
            'lwn_recipe_desc',
            sanitize_text_field($_POST['lwn_recipe_desc'])
        );
    }
    if (isset($_POST['lwn_recipe_ingredients'])) {
        /* update_post_meta( */
        /*     $post_id, */
        /*     'lwn_recipe_ingredients', */
        /*     sanitize_text_field($_POST['lwn_recipe_ingredients']) */
        /* ); */
        update_post_meta($post_id, 'lwn_recipe_ingredients', wp_kses_post($_POST['lwn_recipe_ingredients']));
    }
    if (isset($_POST['lwn_recipe_steps'])) {
        /* update_post_meta( */
        /*     $post_id, */
        /*     'lwn_recipe_steps', */
        /*     sanitize_text_field($_POST['lwn_recipe_steps']) */
        /* ); */
        update_post_meta($post_id, 'lwn_recipe_steps', wp_kses_post($_POST['lwn_recipe_steps']));
    }
    if (isset($_POST['lwn_recipe_notes'])) {
        update_post_meta(
            $post_id,
            'lwn_recipe_notes',
            sanitize_text_field($_POST['lwn_recipe_notes'])
        );
    }
    if (isset($_POST['lwn_recipe_vegan'])) {
        update_post_meta(
            $post_id,
            'lwn_recipe_vegan',
            'on'
        );
    } else {
        update_post_meta(
            $post_id,
            'lwn_recipe_vegan',
            'off'
        );
    }
    if (isset($_POST['lwn_recipe_meal'])) {
        update_post_meta(
            $post_id,
            'lwn_recipe_meal',
            sanitize_text_field($_POST['lwn_recipe_meal'])
        );
    }
}
