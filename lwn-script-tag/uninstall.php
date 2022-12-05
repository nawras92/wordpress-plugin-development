<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

//delete option
delete_option('lwn_script_tag_options');
