<?php

add_action('save_post_lwn_recipe', 'lwn_recipe_custom_post_save_recipe_meta');
function lwn_recipe_custom_post_save_recipe_meta($post_id)
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
    if (isset($_POST['lwn_recipe_ingredients'])) {
        update_post_meta(
            $post_id,
            'lwn_recipe_ingredients',
            sanitize_text_field($_POST['lwn_recipe_ingredients'])
        );
    }
    if (isset($_POST['lwn_recipe_steps'])) {
        update_post_meta(
            $post_id,
            'lwn_recipe_steps',
            sanitize_text_field($_POST['lwn_recipe_steps'])
        );
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
