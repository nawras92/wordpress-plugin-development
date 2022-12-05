<?php


add_action('admin_menu', 'lwn_script_tag_add_admin_menus');
function lwn_script_tag_add_admin_menus()
{
    add_options_page(
        __('Lwn Script Tag', 'lwn-script-tag'),
        __('Script Tag', 'lwn-script-tag'),
        'manage_options',
        'lwn-script-tag',
        'lwn_script_tag_config_page'
    );
}

function lwn_script_tag_config_page()
{
    echo "<div class='lwn-config-page'>";
    echo "<form method='post' action='options.php' name ='lwn_script_tag_form' >";
    settings_fields('lwn_script_tag_settings');
    do_settings_sections('lwn-script-tag');
    echo "<input type = 'submit' value='Send'  class='button-primary' / >";
    echo "</form>";
    echo "</div>";
}
