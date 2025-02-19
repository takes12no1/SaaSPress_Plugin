<?php
// If WordPress is not running, exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Remove plugin options from the database
delete_option('saaspress_settings');
delete_option('saaspress_version');

// If the plugin creates custom tables, remove them
global $wpdb;
$table_name = $wpdb->prefix . 'saaspress_data';
$wpdb->query("DROP TABLE IF EXISTS $table_name");

// Remove post metadata (if the plugin adds custom fields to posts)
delete_metadata('post', 0, 'saaspress_meta_key', '', true);

// Remove transient data from the database (if the plugin uses transients for temporary caching)
global $wpdb;
$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_saaspress_%'");