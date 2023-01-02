<?php

add_shortcode('lwn-recipes', 'lwn_recipe_custom_type_shortcode');

function lwn_recipe_custom_type_shortcode()
{
    $recipes_query = new WP_Query();
    $query_params = array('post_type' => 'lwn_recipe', 'post_status' => "publish",
        'posts_per_page' => 6
    );
    $recipes_query->query($query_params);
    if ($recipes_query->have_posts()) {
        $html = "<div class='recipe-container'>";
        while ($recipes_query->have_posts()) {
            $recipes_query->the_post();
            $recipes_types = wp_get_post_terms(get_the_ID(), 'lwn_recipe_type');
            if ($recipes_types) {
                $types = array();
                foreach ($recipes_types as $recipe_type) {
                    $types[] = $recipe_type->name;
                }
                $terms =  esc_html(implode(', ', $types));
            } else {
                $terms = __('Not classifed', 'lwn-recipe-custom-type');
            }
            $html .= "<div class='recipe-single'>";
            $html .= "<div class='recipe-header'>";
            $html .= "<h3>";
            $html .= "<a class='recipe-title' href='" . get_permalink()   .    "'>"  ;
            $html .= get_the_title();

            $html .= "</a>";
            $html .= "</h3>";


            $html .= "</div>";
            $html .= "<div class='recipe-meta'>";
            $html .= "<span class='recipe-meta-single'>" . __('Prep Time: ', 'lwn-recipe-custom-type');
            $html .= esc_html(get_post_meta(get_the_ID(), 'lwn_recipe_prep_time', true));
            $html .= "</span>";
            $html .= "<span class='recipe-meta-single'>" . __('Cook Time: ', 'lwn-recipe-custom-type');
            $html .= esc_html(get_post_meta(get_the_ID(), 'lwn_recipe_cook_time', true));
            $html .= "</span>";
            $html .= "<span class='recipe-meta-single'>" . __('Servings: ', 'lwn-recipe-custom-type');
            $html .= esc_html(get_post_meta(get_the_ID(), 'lwn_recipe_servings', true));
            $html .= "</span>";
            $html .= "</div>";
            $html .= "<div class='recipe-terms'>";
            $html .= "<span class='recipe-term'>" . __('Types: ', 'lwn-recipe-custom-type');
            $html .= esc_html($terms);
            $html .= "</span>";
            $html .= "</div>";
            $html .= "</div>";
        }
        $html .= "</div>";
    } else {
        $html = __('There are no recipes', 'lwn-recipe-custom-type');
    }

    wp_reset_postdata();


    return $html;
}
