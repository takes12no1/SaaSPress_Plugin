<?php
/*
Plugin Name: SaaSPress
Plugin URI: https://saaspress.com
Description: A plugin to manage SaaSPress resources and tools.
Version: 1.0.1
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
        add_action( 'admin_menu', array( $this, 'add_submenu' ) );
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

    // Add a submenu for Reports
    public function add_submenu() {
        add_submenu_page(
            'saaspress-dashboard',    // Parent menu
            'SaaSPress Reports',      // Submenu title
            'Reports',                // Menu label
            'manage_options',         // Permission
            'saaspress-reports',      // Menu slug
            array( $this, 'render_reports' ) // Function to display the reports
        );
    }

    // Render the dashboard page
    public function render_dashboard() {
        echo '<div class="wrap">';
        echo '<h1>Welcome to SaaSPress</h1>';
        echo '<p>This is the central hub to manage SaaSPress resources and tools.</p>';
        echo '</div>';
    }

    // Render the reports page
    public function render_reports() {
        // Example report data (this could be replaced with dynamic data)
        $total_users = 120; // Sample data
        $total_interactions = 450; // Sample data

        echo '<div class="wrap">';
        echo '<h1>SaaSPress Reports</h1>';
        echo '<table class="form-table">';
        echo '<tr><th>Total Users</th><td>' . esc_html( $total_users ) . '</td></tr>';
        echo '<tr><th>Total Interactions</th><td>' . esc_html( $total_interactions ) . '</td></tr>';
        echo '</table>';
        echo '</div>';
    }
}

// Initialize the class
new SaaSPress();
?>