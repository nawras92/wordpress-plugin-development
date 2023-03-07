<?php

add_action('admin_menu', 'lwn_recipe_add_admin_menus');
function lwn_recipe_add_admin_menus()
{
  $options_page = add_options_page(
    esc_html__('LWN Recipe Plugin', 'lwn-recipe'),
    esc_html__('LWN Recipes', 'lwn-recipe'),
    'manage_options',
    'lwn-recipe-plugin',
    'lwn_recipe_config_page'
  );

  add_action('load-' . $options_page, 'lwn_recipe_set_help_tabs');
}

function lwn_recipe_config_page()
{
  ?>
  <div class="lwn-recipe-admin-container">
    <!-- Plugin Heading -->
    <div class="lwn-recipe-admin-header">
      <h1 class="lwn-recipe-admin-heading">
        <?php esc_html_e('Lwn Recipe Plugin', 'lwn-recipe'); ?>
      </h1>
      <p class="lwn-recipe-admin-text">
        <?php esc_html_e('Manage your recipes smoothly!', 'lwn-recipe'); ?>
      </p>
    </div>
    <hr>
    <hr>
    <!-- How use Section -->
    <section class="lwn-recipe-admin-section">
      <h3 class="lwn-recipe-admin-heading">
        <?php esc_html_e('How to use?', 'lwn-recipe'); ?>
      </h3>
      <p class="lwn-recipe-admin-text">
        <?php esc_html_e(
          'Go to the bottom of admin sidebar, choose "Lwn Recipe", and enjoy adding your recipes!',
          'lwn-recipe'
        ); ?>
      </p>
    </section>
    <hr>
    <!-- All Recipes Link -->
    <section class="lwn-recipe-admin-section">
      <h3 class="lwn-recipe-admin-heading">
        <?php esc_html_e('How to check all recipes in the frontend?', 'lwn-recipe'); ?>
      </h3>
      <p class="lwn-recipe-admin-text">
        <?php esc_html_e('Go to:', 'lwn-recipe'); ?>
        <a class="lwn-recipe-admin-link" href="<?php echo esc_url(get_post_type_archive_link(
          'lwn_recipe'
        )); ?>" target="_blank"
               rel="noreferrer noopener"
               >

               <?php esc_html_e('All Recipes URL', 'lwn-recipe'); ?>

        </a>

      </p>
    </section>
    <hr>
    <!-- Customized Sidebar  -->
    <section class="lwn-recipe-admin-section">
      <h3 class="lwn-recipe-admin-heading">
        <?php esc_html_e('Customized Sidebar', 'lwn-recipe'); ?>
      </h3>
      <p class="lwn-recipe-admin-text">
        <?php esc_html_e(
          'You can add your customized Sidebar to Recipe pages. Check it in the widgets section!',
          'lwn-recipe'
        ); ?>
      </p>
    </section>
    <hr>
    <!-- Customized Widgets  -->
    <section class="lwn-recipe-admin-section">
      <h3 class="lwn-recipe-admin-heading">
        <?php esc_html_e('Customized Widgets', 'lwn-recipe'); ?>
      </h3>
      <p class="lwn-recipe-admin-text">
        <?php esc_html_e(
          'There are two recipe widgets; the first is "Lwn Latest Recipes", and the second one is "LWN Recipe Types". You can check them in the widgets section.',
          'lwn-recipe'
        ); ?>
      </p>
    </section>
    <hr>
    <!-- Useful Links  -->
    <section class="lwn-recipe-admin-section">
      <h3 class="lwn-recipe-admin-heading">
        <?php esc_html_e('Useful Links', 'lwn-recipe'); ?>
      </h3>
      <p class="lwn-recipe-admin-text">
        <?php esc_html_e(
          'If interested, you can learn more about plugin development, and how to make similar plugins here.',
          'lwn-recipe'
        ); ?>
      </p>
        <a class="lwn-recipe-admin-link" href="<?php echo esc_url(LWN_RECIPE_WORDPRESS_LP); ?>"
                                       target="_blank"
                                       rel="noreferrer noopener"
                                       >
                                       <?php _e(
                                         'Wordpress Development Learning Path',
                                         'lwn-recipe'
                                       ); ?>
      </a>
        <a class="lwn-recipe-admin-link" href="<?php echo esc_url(LWN_RECIPE_YOUTUBE_LINK) ?>"
                                       target="_blank"
                                       rel="noreferrer noopener"
                                       >
                                       <?php esc_html_e(
                                         'Check Youtube Videos',
                                         'lwn-recipe'
                                       ); ?>
      </a>
        <a class="lwn-recipe-admin-link" href="<?php echo esc_url(LWN_RECIPE_GIT_CODE) ?>"
                                       target="_blank"
                                       rel="noreferrer noopener"
                                       >
                                       <?php esc_html_e('Code Repo.', 'lwn-recipe'); ?>
      </a>
    </section>
    <hr>
  </div>

<?php
}

/* Help Tabs */
function lwn_recipe_set_help_tabs()
{
  $screen = get_current_screen();
  $screen->add_help_tab([
    'id' => 'lwn-recipe-help-tab-1',
    'title' => esc_html__('What is this plugin?', 'lwn-recipe'),
    'callback' => 'lwn_recipe_help_tab_1',
  ]);
  $screen->add_help_tab([
    'id' => 'lwn-recipe-help-tab-2',
    'title' => esc_html__('What is the purpose?', 'lwn-recipe'),
    'callback' => 'lwn_recipe_help_tab_2',
  ]);
  $screen->add_help_tab([
    'id' => 'lwn-recipe-help-tab-3',
    'title' => esc_html__('Documentation', 'lwn-recipe'),
    'callback' => 'lwn_recipe_help_tab_3',
  ]);

  $screen->set_help_sidebar(
    sprintf(
      "<p class='lwn-recipe-help-sidebar-text'>%s</p>",
      esc_html__('Ask for help at: help@LearnWithNaw.net', 'lwn-recipe')
    )
  );
}
/* Help Tab 1 => What is this plugin */
function lwn_recipe_help_tab_1()
{
  ?>
<div class="lwn-recipe-help-tab">
  <p class="lwn-recipe-help-tab-text">
           <?php esc_html_e(
             'LWN Recipes helps users to manage their recipes, and display them in custom templates.',
             'lwn-recipe'
           ); ?>
  </p>
  <p class="lwn-recipe-help-tab-text">
           <?php esc_html_e(
             'LWN Recipes also allows users to add custom recipes widgets and sidebar to their website.',
             'lwn-recipe'
           ); ?>

  </p>

</div>

<?php
}

/* Help Tab 2 => What is the purpose */
function lwn_recipe_help_tab_2()
{
  ?>
<div class="lwn-recipe-help-tab">
     <p class="lwn-recipe-help-tab-text">
       <?php esc_html_e(
         'LWN Recipes was created with the intention of teaching developers how to make a professional, yet simple WordPress plugin.',
         'lwn-recipe'
       ); ?>
     </p>

</div>

<?php
}

/* Help Tab 3 => Documentation */
function lwn_recipe_help_tab_3()
{
  ?>
  <div class="lwn-recipe-help-tab">
     <p class="lwn-recipe-help-tab-text">
       <?php esc_html_e(
         'If interested, you can learn more about plugin development, and how to make similar plugins here.',
         'lwn-recipe'
       ); ?>
     </p>
       <a class="lwn-recipe-help-tab-link" href="<?php echo esc_url(LWN_RECIPE_WORDPRESS_LP) ?>" target="_blank" rel="noreferrer noopener">
       <?php esc_html_e('WordPress Development Learning Path', 'lwn-recipe'); ?>
     </a>
       <a class="lwn-recipe-help-tab-link" href="<?php echo esc_url(LWN_RECIPE_YOUTUBE_LINK) ?>" target="_blank" rel="noreferrer noopener">
       <?php esc_html_e('Check Youtube Videos', 'lwn-recipe'); ?>
     </a>
       <a class="lwn-recipe-help-tab-link" href="<?php echo esc_url(LWN_RECIPE_GIT_CODE); ?>" target="_blank" rel="noreferrer noopener">
       <?php esc_html_e('Code Repo.', 'lwn-recipe'); ?>
     </a>

   </div>

<?php
}
