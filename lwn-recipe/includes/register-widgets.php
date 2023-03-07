<?php

add_action('widgets_init', 'lwn_recipe_register_widgets');
function lwn_recipe_register_widgets()
{
  register_widget('Lwn_Recipe_Latest_Recipes_Widget');
  register_widget('Lwn_Recipe_List_Recipe_Types_Widget');
}
// Recipes Types
class Lwn_Recipe_List_Recipe_Types_Widget extends WP_Widget
{
  function __construct()
  {
    parent::__construct(
      'lwn_recipe_recipe_types',
      esc_html__('Lwn Recipe Types', 'lwn_recipe'),
      ['description' => esc_html__('Lists Lwn Recipe Types', 'lwn-recipe')]
    );
  }

  // Display Widget Content
  function widget($args, $instance)
  {
    $widget_title =
      isset($instance['widget_title']) && !empty($instance['widget_title'])
        ? esc_html($instance['widget_title'])
        : esc_html__('Recipe Types', 'lwn-recipe');
    $hide_empty = !empty($instance['hide_empty']) ? true : false;
    $recipe_types = get_terms([
      'taxonomy' => 'lwn_recipe_type',
      'hide_empty' => $hide_empty,
    ]);

    echo $args['before_widget'];
    echo $args['before_title'];
    echo esc_html($widget_title);
    echo $args['after_title'];

    // Display Recipe Types
    echo "<ul class='lwn-recipe-list'>";
    foreach ($recipe_types as $recipe_type) {
      $recipe_type_link = get_term_link($recipe_type);
      $recipe_type_name = $recipe_type->name;
      echo "<li class='lwn-recipe-item'>";
      echo "<a class='lwn-recipe-link' href='";
      echo esc_url($recipe_type_link);
      echo "'>";
      echo esc_html($recipe_type_name);
      echo '</a>';
      echo '</li>';
    }
    echo '</ul>';
    echo $args['after_widget'];
  }

  // Widget Form
  function form($instance)
  {
    $widget_title =
      isset($instance['widget_title']) && !empty($instance['widget_title'])
        ? esc_html($instance['widget_title'])
        : esc_html__('Recipe Types', 'lwn-recipe');

    $hide_empty = isset($instance['hide_empty'])
      ? (bool) $instance['hide_empty']
      : false;
    ?>

    <!-- Widget Input: Title -->
    <p>
    <label for="<?php esc_attr_e($this->get_field_id('widget_title')); ?>">
        <?php esc_html_e('Widget Title', 'lwn-recipe'); ?> 
    </label>
    <input type="text" 
           id="<?php esc_attr_e($this->get_field_id('widget_title')); ?>"
           name="<?php esc_attr_e($this->get_field_name('widget_title')); ?>"
           value="<?php esc_attr_e($widget_title); ?>"
    />
   </p>

    <!-- Widget Input: hide empty -->
    <p>
    <label for="<?php esc_attr_e($this->get_field_id('hide_empty')); ?>">
        <?php esc_html_e('Hide Empty Types', 'lwn-recipe'); ?> 
    </label>
    <input type="checkbox" 
           id="<?php esc_attr_e($this->get_field_id('hide_empty')); ?>"
           name="<?php esc_attr_e($this->get_field_name('hide_empty')); ?>"
           <?php checked($hide_empty); ?>
    />
   </p>

   <?php
  }

  // Update function
  function update($new_instance, $old_instance)
  {
    $instance = [];
    $instance['hide_empty'] = !empty($new_instance['hide_empty']) ? 1 : 0;
    $instance['widget_title'] = sanitize_text_field(
      $new_instance['widget_title']
    );

    return $instance;
  }
}
// Latest Recipes
class Lwn_Recipe_Latest_Recipes_Widget extends WP_Widget
{
  function __construct()
  {
    parent::__construct(
      'lwn_recipe_latest_recipes',
      esc_html__('Lwn Latest Recipes', 'lwn_recipe'),
      ['description' => esc_html__('Display Latest LWN Recipes', 'lwn-recipe')]
    );
  }

  // Display Widget Content
  function widget($args, $instance)
  {
    $widget_title =
      isset($instance['widget_title']) && !empty($instance['widget_title'])
        ? esc_html($instance['widget_title'])
        : esc_html__('Recipes', 'lwn-recipe');

    $number_of_recipes =
      isset($instance['number_of_recipes']) &&
      !empty($instance['number_of_recipes'])
        ? intval(esc_html($instance['number_of_recipes']))
        : 3;

    echo $args['before_widget'];
    echo $args['before_title'];
    echo esc_html($widget_title);
    echo $args['after_title'];

    // Display Latest Recipes
    $query_args = [
      'post_type' => 'lwn_recipe',
      'post_status' => 'publish',
      'posts_per_page' => $number_of_recipes,
    ];
    $the_recipes = new WP_Query($query_args);
    if ($the_recipes->have_posts()) {
      echo "<ul class='lwn-recipe-list'>";
      while ($the_recipes->have_posts()) {
        $the_recipes->the_post();
        echo "<li class='lwn-recipe-item'>";
        echo "<a class='lwn-recipe-link' href='";
        echo get_the_permalink();
        echo "'>";
        the_title();
        echo '</a>';
        echo '</li>';
      }
      echo '</ul>';
      wp_reset_postdata();
    }
    echo $args['after_widget'];
  }

  // Widget Form
  function form($instance)
  {
    $widget_title =
      isset($instance['widget_title']) && !empty($instance['widget_title'])
        ? esc_html($instance['widget_title'])
        : esc_html__('Recipes', 'lwn-recipe');

    $number_of_recipes =
      isset($instance['number_of_recipes']) &&
      !empty($instance['number_of_recipes'])
        ? intval(esc_html($instance['number_of_recipes']))
        : 3;
    ?>

    <!-- Widget Input: Title -->
    <p>
    <label for="<?php esc_attr_e($this->get_field_id('widget_title')); ?>">
        <?php _e('Widget Title', 'lwn-recipe'); ?> 
    </label>
    <input type="text" 
           id="<?php esc_attr_e($this->get_field_id('widget_title')); ?>"
           name="<?php esc_attr_e($this->get_field_name('widget_title')); ?>"
           value="<?php esc_attr_e($widget_title); ?>"
    />
   </p>

    <!-- Widget Input: Number of recipes -->
    <p>
    <label for="<?php esc_attr_e($this->get_field_id('number_of_recipes')); ?>">
        <?php esc_html_e('Number of recipes', 'lwn-recipe'); ?> 
    </label>
    <input type="text" 
           id="<?php esc_attr_e($this->get_field_id('number_of_recipes')); ?>"
           name="<?php esc_attr_e(
             $this->get_field_name('number_of_recipes')
           ); ?>"
           value="<?php esc_attr_e($number_of_recipes); ?>"
    />
   </p>
   <?php
  }

  // Update function
  function update($new_instance, $old_instance)
  {
    $instance = [];
    $instance['widget_title'] = sanitize_text_field(
      $new_instance['widget_title']
    );

    if (is_numeric($new_instance['number_of_recipes'])) {
      $instance['number_of_recipes'] = intval(
        $new_instance['number_of_recipes']
      );
    }

    return $instance;
  }
}
