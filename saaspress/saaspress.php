<?php
/*
Plugin Name: SaaSPress
Plugin URI: https://saaspress.com
Description: A plugin to manage SaaSPress resources and tools.
Version: 1.0
Author: SaaSPress
Author URI: https://saaspress.com
License: GPL2
*/

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'SAASPRESS_DIR', plugin_dir_path( __FILE__ ) );
define( 'SAASPRESS_URL', plugin_dir_url( __FILE__ ) );

// Include Update Checker
require_once SAASPRESS_DIR . 'inc/update-checker.php';

// Initialize Update Checker
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://saaspress.com/updates/saaspress.json',  // URL to the update JSON
    __FILE__,  // Main plugin file
    'saaspress'  // Plugin slug
);

// Include helper files
require_once SAASPRESS_DIR . 'inc/functions.php';

// Initialize the plugin
class SaaSPress {
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
    }

    // Add menu to the admin panel
    public function add_admin_menu() {
        add_menu_page(
            'SaaSPress Dashboard',
            'SaaSPress',
            'manage_options',
            'saaspress-dashboard',
            array( $this, 'render_dashboard' ),
            'dashicons-chart-line',
            2
        );
    }

    // Render the dashboard page
    public function render_dashboard() {
        echo '<div class="wrap">';
        echo '<h1>Welcome to SaaSPress</h1>';
        echo '<p>This is the central hub to manage SaaSPress resources and tools.</p>';
        echo '</div>';
    }
}

// Initialize the class
new SaaSPress();