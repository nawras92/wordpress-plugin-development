<?php

// Add template for recipe
add_filter('template_include', 'lwn_recipe_add_template');
function lwn_recipe_add_template($template_path)
{
    if (is_single() && get_post_type() === 'lwn_recipe') {
        $template_name = locate_template(array('templates/single-lwn_recipe.php'));
        if ($template_name) {
            return $template_name;
        } else {
            return LWN_RECIPE_PLUGIN_PATH . '/templates/single-lwn_recipe.php';
        }
    }

    return $template_path;
}

function lwn_recipe_filter_content($content)
{
    if (empty(get_the_ID())) {
        return $content;
    }
    global $post;
    $id = get_the_ID();
    $title = $post->post_title;
    $thumbnail = $post->thumbnail;
    $post_thumbnail_id = get_post_thumbnail_id($post->ID);
    $thumbnail_url = wp_get_attachment_image_url($post_thumbnail_id, 'thumbnail');
    $prep_time = get_post_meta($id, 'lwn_recipe_prep_time', true);
    $cook_time = get_post_meta($id, 'lwn_recipe_cook_time', true);
    $total_time = get_post_meta($id, 'lwn_recipe_total_time', true);
    $servings = get_post_meta($id, 'lwn_recipe_servings', true);
    $meal = get_post_meta($id, 'lwn_recipe_meal', true);
    $vegan = get_post_meta($id, 'lwn_recipe_vegan', true);
    $ingredients = get_post_meta($id, 'lwn_recipe_ingredients', true);
    $steps = get_post_meta($id, 'lwn_recipe_steps', true);
    $notes = get_post_meta($id, 'lwn_recipe_notes', true);
    $description = get_post_meta($id, 'lwn_recipe_desc', true);
    $minutes = __('Minutes', 'lwn-recipe') ;
    $ingredients_name = __('Ingredients', 'lwn-recipe') ;
    $steps_name = __('Steps', 'lwn-recipe') ;
    $notes_name = __('Notes', 'lwn-recipe') ;
    $prep_time_name = __('Prep Time', 'lwn-recipe') ;
    $cook_time_name = __('Cook Time', 'lwn-recipe') ;
    $total_time_name = __('Total Time', 'lwn-recipe') ;
    $servings_name = __('servings', 'lwn-recipe') ;
    $meal_name = __('Meal', 'lwn-recipe') ;
    $vegan_name = __('Vegan?', 'lwn-recipe') ;
    $yes = __('Yes', 'lwn-recipe') ;
    $no = __('No', 'lwn-recipe') ;
    $is_vegan = $vegan === 'off' ? $no : $yes;

    $new_content = <<<EOF
    <!-- Main Container -->

    <div class="lwn-recipe-container">
      <!-- Start: Page Header - Title & Thumbnail -->
      <div
        class="lwn-recipe-title-container"
        style=" background-image:linear-gradient( rgba(135, 80, 156, 0.4), rgba(135, 80, 156, 0.6)), url('{$thumbnail_url}');"
      >
        <h1>
          <span class="lwn-recipe-title">{$title}</span>
        </h1>
        <p class="lwn-recipe-description">{$description}</p>
      </div>
      <!-- End: Page Header - Title & Thumbnail -->

      <!-- Start: Recipe Meta Box -->
      <div class="lwn-recipe-section">
        <!-- Recipe Properties -->
        <div class="lwn-recipe-meta-box">
          <!-- Single Recipe Property -->
          <!-- Servings -->
          <div class="lwn-recipe-single-meta">
            <p>{$servings_name}: <span>{$servings}</span></p>
          </div>
          <!-- Preparation Time -->
          <div class="lwn-recipe-single-meta">
            <p>{$prep_time_name}: <span>{$prep_time} {$minutes}</span></p>
          </div>
          <!-- Cook Time -->
          <div class="lwn-recipe-single-meta">
            <p>{$cook_time_name}: <span>{$cook_time} {$minutes}</span></p>
          </div>
          <!-- Total Time -->
          <div class="lwn-recipe-single-meta">
            <p>{$total_time_name}: <span>{$total_time} {$minutes}</span></p>
          </div>
          <!-- Meal -->
          <div class="lwn-recipe-single-meta">
            <p>{$meal_name}: <span>{$meal}</span></p>
          </div>
          <!-- Vegan -->
          <div class="lwn-recipe-single-meta">
            <p>{$vegan_name}: <span>{$is_vegan}</span></p>
          </div>
        </div>
      </div>
      <!-- End: Recipe Meta Box -->

      <!-- Start: Recipe Ingredients -->
      <div id="ingredients-and-steps" class="lwn-recipe-ingredients-and-steps">
        <div class="lwn-recipe-section lwn-recipe-box-with-50">
          <div class="lwn-recipe-section-title">
            <h3>{$ingredients_name}</h3>
          </div>
          <div class="lwn-recipe-section-content">
            {$ingredients}
          </div>
        </div>
        <!-- End: Recipe Ingredients -->
        <!-- Start: Recipe Steps -->
        <div class="lwn-recipe-section lwn-recipe-box-with-50">
          <div class="lwn-recipe-section-title">
            <h3>{$steps_name}</h3>
          </div>
          <div class="lwn-recipe-section-content">
            {$steps}
          </div>
        </div>
      </div>
      <!-- End: Recipe Steps -->
      <!-- Start: Recipe Notes -->
      <div class="lwn-recipe-notes">
        <p>{$notes_name}: {$notes}</p>
      </div>
      <!-- End: Recipe Notes -->
    </div>

    EOF;
    return $new_content;
}
