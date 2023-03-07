<?php

add_action('widgets_init', 'lwn_recipe_register_sidebar');
function lwn_recipe_register_sidebar()
{
  register_sidebar([
    'id' => 'lwn-recipe-sidebar',
    'name' => esc_html__('LWN Recipe Sidebar', 'lwn-recipe'),
    'before_sidebar' => '<div id="%1$s" class="%2$s lwn-recipe-sidebar">',
    'after_sidebar' => '</div>',
    'before_widget' => '<div id="%1$s" class="%2$s lwn-recipe-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="lwn-recipe-widget-title">',
    'after_title' => '</h4>',
  ]);
}
