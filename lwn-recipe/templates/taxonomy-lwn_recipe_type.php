<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
   <?php wp_head(); ?>
</head>
    <body <?php body_class(); ?>>
     <?php get_header(); ?>
     <!-- Main Container -->
     <div class="lwn-recipe-container">
       <!-- All recipes container -->
       <div class="lwn-recipe-content">
        <?php $paged = get_query_var('paged') ? get_query_var('paged') : 1; ?>
        <?php $term = get_queried_object(); ?>

         <?php $args = [
           'post_type' => 'lwn_recipe',
           'posts_per_page' => 4,
           'paged' => $paged,
           'tax_query' => array( [
             'taxonomy' => 'lwn_recipe_type',
             'field' => 'slug',
             'terms' => $term->slug,
           ]),
         ]; ?>
         <?php $the_recipes = new WP_Query($args); ?>
         <?php if ($the_recipes->have_posts()) { ?>
         <?php while ($the_recipes->have_posts()) { ?>
         <?php $the_recipes->the_post(); ?>
         <div class="lwn-recipe-card">
           <div class="lwn-recipe-thumbnail">
             <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title() .
  ' thumbnail'; ?>" />
           </div>
           <div class="the-recipe-content">
             <h3 class="lwn-recipe-title">
               <a class="lwn-recipe-link" href="<?php the_permalink(); ?>">
                 <?php the_title(); ?>
               </a>
             </h3>
             <p class="lwn-recipe-text">
               <?php esc_html_e(get_post_meta(
                 get_the_ID(),
                 'lwn_recipe_desc',
                 true
               )); ?>
             </p>

           </div>
         </div>

         <?php } ?>
         <?php } ?>

         <div class="lw-recipe-pagination">
           <?php next_posts_link(
             esc_html__('Older Recipes', 'lwn-recipe'),
             $the_recipes->max_num_pages
           ); ?>
           <?php previous_posts_link(esc_html__('Newer Recipes', 'lwn-recipe')); ?>
         </div>


         <?php wp_reset_postdata(); ?>


       </div>

       <!-- LWN Recipe Sidebar -->
      <?php if (is_active_sidebar('lwn-recipe-sidebar')) {
        dynamic_sidebar('lwn-recipe-sidebar');
      } ?>
     </div>
   
   <?php get_footer(); ?>
   <?php wp_footer(); ?>
</body>
</html>
