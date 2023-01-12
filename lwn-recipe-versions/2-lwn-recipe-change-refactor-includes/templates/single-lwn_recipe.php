<?php wp_head(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<?php $id = get_the_ID(); ?>
<?php

    $prep_time = get_post_meta($id, 'lwn_recipe_prep_time', true);
    $cook_time = get_post_meta($id, 'lwn_recipe_cook_time', true);
    $total_time = get_post_meta($id, 'lwn_recipe_total_time', true);
    $servings = get_post_meta($id, 'lwn_recipe_servings', true);
    $meal = get_post_meta($id, 'lwn_recipe_meal', true);
    $vegan = get_post_meta($id, 'lwn_recipe_vegan', true);
    $notes = get_post_meta($id, 'lwn_recipe_notes', true);

    $new_content = '<div class="recipe-container">';
    $new_content .= '<div class="recipe-header">';
    $new_content .= '<div class="recipe-thumbnail">';
    $new_content .= get_the_post_thumbnail($id, 'medium');
    $new_content .= '</div>';
    $new_content .= '<h1 class="recipe-heading">';
    $new_content .= get_the_title();
    $new_content .= '</h1>';
    $new_content .= '</div>';

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
    $new_content .= get_the_content();
    $new_content .= '</div>';
    $new_content .= '<div class="recipe-notes">';
    $new_content .= $notes;
    $new_content .= '</div>';


    $new_content .= '</div>';

    echo $new_content;
    ?>


<?php endwhile; ?>

<?php endif; ?>


<?php wp_footer(); ?>


