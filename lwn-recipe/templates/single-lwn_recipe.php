<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
   <?php wp_head(); ?>
</head>
    <body <?php body_class(); ?>>
     <?php get_header(); ?>
     <!-- Main Container -->
     <div class="lwn-recipe-container">
        <!-- Title + Description + thumbnail -->
        <div class="lwn-recipe-title-container"
            style="
                background-image:linear-gradient(rgba(135, 80, 156, 0.4), rgba(135, 80, 156, 0.6)), url('<?php the_post_thumbnail_url(); ?>')
"
              >
            <h1>
              <span class="lwn-recipe-title">
                <?php the_title(); ?>
               </span>
             </h1>
             <p class="lwn-recipe-description">
                <?php esc_html_e(get_post_meta(
                  get_the_ID(),
                  'lwn_recipe_desc',
                  true
                )); ?>

             </p>
        </div>
        <!-- Meta container -->
        <div class="lwn-recipe-section">
          <div class="lwn-recipe-meta-box">
            <!-- Single Meta -->
            <div class="lwn-recipe-single-meta">
              <p>
                <?php esc_html_e('Servings', 'lwn-recipe'); ?>:
                <span>
                  <?php esc_html_e(get_post_meta(
                    get_the_ID(),
                    'lwn_recipe_servings',
                    true
                  )); ?>
                </span>
              </p>
            </div>
            <!-- Single Meta -->
            <div class="lwn-recipe-single-meta">
              <p>
                <?php esc_html_e('Prep Time', 'lwn-recipe'); ?>:
                <span>
                  <?php esc_html_e(get_post_meta(
                    get_the_ID(),
                    'lwn_recipe_prep_time',
                    true
                  )); ?>
                  <?php esc_html_e('Minutes', 'lwn-recipe'); ?>
                </span>
              </p>
            </div>
            <!-- Single Meta -->
            <div class="lwn-recipe-single-meta">
              <p>
                <?php esc_html_e('Cook Time', 'lwn-recipe'); ?>:
                <span>
                  <?php esc_html_e(get_post_meta(
                    get_the_ID(),
                    'lwn_recipe_cook_time',
                    true
                  )); ?>
                  <?php esc_html_e('Minutes', 'lwn-recipe'); ?>
                </span>
                </span>
              </p>
            </div>
            <!-- Single Meta -->
            <div class="lwn-recipe-single-meta">
              <p>
                <?php esc_html_e('Total Time', 'lwn-recipe'); ?>:
                <span>
                  <?php esc_html_e(get_post_meta(
                    get_the_ID(),
                    'lwn_recipe_total_time',
                    true
                  )); ?>
                  <?php esc_html_e('Minutes', 'lwn-recipe'); ?>
                </span>
                </span>
              </p>
            </div>
            <!-- Single Meta -->
            <div class="lwn-recipe-single-meta">
              <p>
                <?php esc_html_e('Meal', 'lwn-recipe'); ?>:
                <span>
                  <?php esc_html_e(get_post_meta(
                    get_the_ID(),
                    'lwn_recipe_meal',
                    true
                  )); ?>
                </span>
              </p>
            </div>
            <!-- Single Meta -->
            <div class="lwn-recipe-single-meta">
              <p>
                <?php esc_html_e('Vegan?', 'lwn-recipe'); ?>:
                <span>
                  <?php esc_html(get_post_meta(
                    get_the_ID(),
                    'lwn_recipe_vegan',
                    true
                  )) === 'on'
                    ? esc_html_e('Yes', 'lwn-recipe')
                    : esc_html_e('No', 'lwn-recipe'); ?>
                </span>
              </p>
            </div>
          </div>


        </div>
        <!-- Ingredients and Steps -->
        <div class="lwn-recipe-ingredients-and-steps">

          <!-- Ingredients -->
          <div class="lwn-recipe-section lwn-recipe-box-width-50">
            <div class="lwn-recipe-section-title">
              <h3>
                <?php esc_html_e('Ingredients', 'lwn-recipe'); ?>
              </h3>
            </div>
            <div class="lwn-recipe-section-content">
              <?php echo wp_kses_post(get_post_meta(
                get_the_ID(),
                'lwn_recipe_ingredients',
                true
              )); ?>
            </div>
          </div>

          <!-- Steps -->
          <div class="lwn-recipe-section lwn-recipe-box-width-50">
            <div class="lwn-recipe-section-title">
              <h3>
                <?php esc_html_e('Steps', 'lwn-recipe'); ?>
              </h3>
            </div>
            <div class="lwn-recipe-section-content">
              <?php echo wp_kses_post(get_post_meta(
                get_the_ID(),
                'lwn_recipe_steps',
                true
              )); ?>
            </div>
          </div>
        </div>

        <!-- Notes -->
        <div class="lwn-recipe-notes">
          <p>
            <?php esc_html_e('Notes', 'lwn-recipe'); ?>:
             <?php esc_html_e(get_post_meta(
               get_the_ID(),
               'lwn_recipe_notes',
               true
             )); ?>

          </p>

        </div>

     </div>
   

    
   <?php get_footer(); ?>
   <?php wp_footer(); ?>
</body>
</html>
