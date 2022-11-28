<?php

add_action('admin_menu', 'lwn_settings_api_add_admin_menus');
function lwn_settings_api_add_admin_menus()
{
    add_options_page(
        __('Learn Settings API', 'lwn-settings-api'),
        __('LWN Settings', 'lwn-settings-api'),
        'manage_options',
        'lwn-settings-api',
        'lwn_settings_api_config_page'
    );
}

/**Config page*/
function lwn_settings_api_config_page()
{
    echo '<div class="lwn-config-page">';
    echo "<h3>Config Page</h3>";
    echo "<form method='post' action='options.php' name='lwn_settings_api_form'>";
    settings_fields('lwn_settings_api_settings');

    do_settings_sections('lwn-settings-api');
    echo "<input type='submit' value='Send' class='button-primary'/ >";
    echo "</form>";

    echo "</div>";
}
