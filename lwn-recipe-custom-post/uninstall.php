<?php

// IF the is not called by wordpress, DIE
if (! defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Plugin cleaning goes here
// Delete options from wp_options.php
// Delete tables from wp db
