<?php

add_action('admin_init', 'lwn_recipe_register_metabox');

function lwn_recipe_register_metabox()
{
  add_meta_box(
    'lwn-recipe-ingredients-metabox',
    esc_html__('Recipe Ingredients', 'lwn-recipe'),
    'lwn_recipe_display_recipe_ingredients_metabox',
    'lwn_recipe',
    'normal',
    'high'
  );
  add_meta_box(
    'lwn-recipe-steps-metabox',
    esc_html__('Recipe Steps', 'lwn-recipe'),
    'lwn_recipe_display_recipe_steps_metabox',
    'lwn_recipe',
    'normal',
    'high'
  );
  add_meta_box(
    'lwn-recipe-metabox',
    esc_html__('Recipe Info', 'lwn-recipe'),
    'lwn_recipe_display_recipe_metabox',
    'lwn_recipe',
    'normal',
    'high'
  );
}

// Steps Metabox
function lwn_recipe_display_recipe_steps_metabox($recipe)
{
  wp_nonce_field('lwn_recipe_metabox_steps', 'lwn_recipe_metabox_steps_field');
  $steps = get_post_meta($recipe->ID, 'lwn_recipe_steps', true);
  wp_editor(
    wp_kses_post($steps),
    'lwn-recipe-steps-editor',
    $settings = ['textarea_name' => 'lwn_recipe_steps']
  );
}
// Ingredients Metabox
function lwn_recipe_display_recipe_ingredients_metabox($recipe)
{
  wp_nonce_field(
    'lwn_recipe_metabox_ingredients',
    'lwn_recipe_metabox_ingredients_field'
  );
  $ingredients = get_post_meta($recipe->ID, 'lwn_recipe_ingredients', true);
  wp_editor(
    wp_kses_post($ingredients),
    'lwn-recipe-ingredients-editor',
    $settings = ['textarea_name' => 'lwn_recipe_ingredients']
  );
}
// General Recipe Metabox
function lwn_recipe_display_recipe_metabox($recipe)
{
  wp_nonce_field('lwn_recipe_metabox_info', 'lwn_recipe_metabox_info_field');
  $notes = get_post_meta($recipe->ID, 'lwn_recipe_notes', true);
  $desc = get_post_meta($recipe->ID, 'lwn_recipe_desc', true);
  $prep_time = get_post_meta($recipe->ID, 'lwn_recipe_prep_time', true);
  $cook_time = get_post_meta($recipe->ID, 'lwn_recipe_cook_time', true);
  $total_time = get_post_meta($recipe->ID, 'lwn_recipe_total_time', true);
  $servings = get_post_meta($recipe->ID, 'lwn_recipe_servings', true);
  $vegan = get_post_meta($recipe->ID, 'lwn_recipe_vegan', true);
  $meal = get_post_meta($recipe->ID, 'lwn_recipe_meal', true);
  $meals = [
    'Breakfast' => __('Breakfast', 'lwn-recipe'),
    'Lunch' => __('Lunch', 'lwn-recipe'),
    'Dinner' => __('Dinner', 'lwn-recipe'),
  ];

  echo '<table>';
  echo '<tr>';
  echo '<td>';
  echo esc_html__('Short Description', 'lwn-recipe');
  echo '</td>';

  echo '<td>';
  echo "<textarea type='text' name='lwn_recipe_desc'>";
  echo esc_html($desc);
  echo '</textarea>';
  echo '</td>';

  echo '</tr>';
  echo '<tr>';
  echo '<td>';
  echo esc_html__('Prep Time (in Minutes)', 'lwn-recipe');
  echo '</td>';

  echo '<td>';
  echo "<input type='number' name='lwn_recipe_prep_time' value='";
  echo absint($prep_time);
  echo "' />";
  echo '</td>';

  echo '</tr>';
  echo '<tr>';
  echo '<td>';
  echo esc_html__('Cook Time (in Minutes)', 'lwn-recipe');
  echo '</td>';

  echo '<td>';
  echo "<input type='number' name='lwn_recipe_cook_time' value='";
  echo absint($cook_time);
  echo "' />";
  echo '</td>';

  echo '</tr>';
  echo '<tr>';
  echo '<td>';
  echo esc_html__('Total Time (in Minutes)', 'lwn-recipe');
  echo '</td>';

  echo '<td>';
  echo "<input type='number' name='lwn_recipe_total_time' value='";
  echo absint($total_time);
  echo "' />";
  echo '</td>';

  echo '</tr>';
  echo '<tr>';
  echo '<td>';
  echo esc_html__('Servings', 'lwn-recipe');
  echo '</td>';

  echo '<td>';
  echo "<input type='number' name='lwn_recipe_servings' value='";
  echo absint($servings);
  echo "' />";
  echo '</td>';

  echo '</tr>';
  echo '<tr>';
  echo '<td>';
  echo esc_html__('Vegan?', 'lwn-recipe');
  echo '</td>';

  echo '<td>';
  echo "<input type='checkbox' name='lwn_recipe_vegan' value='";
  echo esc_html($vegan);
  echo "' " . checked('on', $vegan, true) . '/>';
  echo '</td>';

  echo '</tr>';
  echo '<tr>';
  echo '<td>';
  echo esc_html__('Meal', 'lwn-recipe');
  echo '</td>';

  echo '<td>';
  echo "<select name='lwn_recipe_meal'>";
  foreach ($meals as $mealKey => $mealValue) { ?>
     <option value="<?php esc_attr_e($mealKey); ?>" <?php selected(
  $mealKey,
  $meal
); ?> >
           <?php echo esc_html($mealValue); ?>
        </option> 
    <?php }

  echo '</select>';
  echo '</td>';

  echo '</tr>';
  echo '<tr>';
  echo '<td>';
  echo esc_html__('Notes', 'lwn-recipe');
  echo '</td>';

  echo '<td>';
  echo "<textarea type='text' name='lwn_recipe_notes'>";
  echo esc_html($notes);
  echo '</textarea>';
  echo '</td>';

  echo '</tr>';
  echo '</table>';
}

add_action('save_post_lwn_recipe', 'lwn_recipe_save_recipe_meta');
function lwn_recipe_save_recipe_meta($post_id)
{
  //Verify steps nonce
  if (
    !isset($_POST['lwn_recipe_metabox_steps_field']) ||
    !wp_verify_nonce(
      $_POST['lwn_recipe_metabox_steps_field'],
      'lwn_recipe_metabox_steps'
    )
  ) {
    return;
  }
  if (
    !isset($_POST['lwn_recipe_metabox_ingredients_field']) ||
    !wp_verify_nonce(
      $_POST['lwn_recipe_metabox_ingredients_field'],
      'lwn_recipe_metabox_ingredients'
    )
  ) {
    return;
  }
  if (
    !isset($_POST['lwn_recipe_metabox_info_field']) ||
    !wp_verify_nonce(
      $_POST['lwn_recipe_metabox_info_field'],
      'lwn_recipe_metabox_info'
    )
  ) {
    return;
  }

  if (isset($_POST['lwn_recipe_prep_time'])) {
    update_post_meta(
      $post_id,
      'lwn_recipe_prep_time',
     absint($_POST['lwn_recipe_prep_time'])
    );
  }
  if (isset($_POST['lwn_recipe_cook_time'])) {
    update_post_meta(
      $post_id,
      'lwn_recipe_cook_time',
      absint($_POST['lwn_recipe_cook_time'])
    );
  }
  if (isset($_POST['lwn_recipe_total_time'])) {
    update_post_meta(
      $post_id,
      'lwn_recipe_total_time',
      absint($_POST['lwn_recipe_total_time'])
    );
  }
  if (isset($_POST['lwn_recipe_servings'])) {
    update_post_meta(
      $post_id,
      'lwn_recipe_servings',
      absint($_POST['lwn_recipe_servings'])
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
    update_post_meta(
      $post_id,
      'lwn_recipe_ingredients',
      wp_kses_post($_POST['lwn_recipe_ingredients'])
    );
  }
  if (isset($_POST['lwn_recipe_steps'])) {
    update_post_meta(
      $post_id,
      'lwn_recipe_steps',
      wp_kses_post($_POST['lwn_recipe_steps'])
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
    update_post_meta($post_id, 'lwn_recipe_vegan', 'on');
  } else {
    update_post_meta($post_id, 'lwn_recipe_vegan', 'off');
  }
  if (isset($_POST['lwn_recipe_meal'])) {
    update_post_meta(
      $post_id,
      'lwn_recipe_meal',
      sanitize_text_field($_POST['lwn_recipe_meal'])
    );
  }
}
