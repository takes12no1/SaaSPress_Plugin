<?php
/*
Plugin Name: SaaSPress
Plugin URI: https://saaspress.com
Description: A plugin to manage SaaSPress resources and tools.
Version: 1.1.0
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
require_once __DIR__ . '/inc/plugin-update-checker/plugin-update-checker.php';

// Initialize Update Checker
use YahnisElsts\PluginUpdateChecker\v5p5\PucFactory;

$updateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/takes12no1/SaaSPress_Plugin',
    __FILE__,
    'saaspress'
);
$updateChecker->getVcsApi()->enableReleaseAssets();
$updateChecker->setBranch('main');

// Include helper files
require_once SAASPRESS_DIR . 'inc/functions.php';

// Main plugin class
class SaaSPress {
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_menu', array( $this, 'add_submenu' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    // Add main menu to the admin panel
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

    // Add submenu for Reports and Help
    public function add_submenu() {
        add_submenu_page(
            'saaspress-dashboard',
            'SaaSPress Reports',
            'Reports',
            'manage_options',
            'saaspress-reports',
            array( $this, 'render_reports' )
        );
        // New Help submenu added here
        add_submenu_page(
            'saaspress-dashboard',
            'SaaSPress Help',
            'Help',
            'manage_options',
            'saaspress-help',
            array( $this, 'render_help' )
        );
    }

    // Enqueue CSS and JS assets
    public function enqueue_assets( $hook ) {
        // Load assets only on plugin pages
        if ( in_array( $hook, array( 'toplevel_page_saaspress-dashboard', 'saaspress_page_saaspress-reports', 'saaspress_page_saaspress-help' ) ) ) {
            wp_enqueue_style( 'saaspress-style', SAASPRESS_URL . 'assets/css/style.css', array(), '1.0.3' );
            wp_enqueue_script( 'saaspress-script', SAASPRESS_URL . 'assets/js/script.js', array(), '1.0.3', true );
        }
    }

    // Render the dashboard page
    public function render_dashboard() {
        ?>
        <div class="wrap">
            <div class="saaspress-header">
                <div class="logo"><i class="dashicons dashicons-chart-line"></i></div>
                <h1><?php esc_html_e( 'Welcome to SaaSPress', 'saaspress' ); ?></h1>
            </div>
            <div class="saaspress-dashboard">
                <p><?php esc_html_e( 'This is the central hub to manage SaaSPress resources and tools.', 'saaspress' ); ?></p>
                <div class="saaspress-modules">
                    <div class="saaspress-card" data-index="0">
                        <i class="dashicons dashicons-admin-users"></i>
                        <h2><?php esc_html_e( 'Users', 'saaspress' ); ?></h2>
                        <p><?php esc_html_e( 'Manage your user base.', 'saaspress' ); ?></p>
                    </div>
                    <div class="saaspress-card" data-index="1">
                        <i class="dashicons dashicons-chart-bar"></i>
                        <h2><?php esc_html_e( 'Analytics', 'saaspress' ); ?></h2>
                        <p><?php esc_html_e( 'View usage statistics.', 'saaspress' ); ?></p>
                    </div>
                    <div class="saaspress-card" data-index="2">
                        <i class="dashicons dashicons-admin-tools"></i>
                        <h2><?php esc_html_e( 'Tools', 'saaspress' ); ?></h2>
                        <p><?php esc_html_e( 'Access SaaSPress tools.', 'saaspress' ); ?></p>
                    </div>
                    <!-- Added three new cards here -->
                    <div class="saaspress-card" data-index="3">
                        <i class="dashicons dashicons-welcome-write-blog"></i>
                        <h2><?php esc_html_e( 'Content', 'saaspress' ); ?></h2>
                        <p><?php esc_html_e( 'Manage your content creation.', 'saaspress' ); ?></p>
                    </div>
                    <div class="saaspress-card" data-index="4">
                        <i class="dashicons dashicons-email"></i>
                        <h2><?php esc_html_e( 'Notifications', 'saaspress' ); ?></h2>
                        <p><?php esc_html_e( 'Set up user notifications.', 'saaspress' ); ?></p>
                    </div>
                    <div class="saaspress-card" data-index="5">
                        <i class="dashicons dashicons-shield"></i>
                        <h2><?php esc_html_e( 'Security', 'saaspress' ); ?></h2>
                        <p><?php esc_html_e( 'Enhance platform security.', 'saaspress' ); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    // Render the reports page
    public function render_reports() {
        $total_users = 120;
        $total_interactions = 450;
        ?>
        <div class="wrap">
            <div class="saaspress-header">
                <div class="logo"><i class="dashicons dashicons-chart-line"></i></div>
                <h1><?php esc_html_e( 'SaaSPress Reports', 'saaspress' ); ?></h1>
            </div>
            <div class="saaspress-dashboard">
                <table class="saaspress-table">
                    <tr>
                        <th><?php esc_html_e( 'Total Users', 'saaspress' ); ?></th>
                        <td><?php echo esc_html( $total_users ); ?></td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Total Interactions', 'saaspress' ); ?></th>
                        <td><?php echo esc_html( $total_interactions ); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
    }

    // Render the help page
    public function render_help() {
        ?>
        <div class="wrap">
            <div class="saaspress-header">
                <div class="logo"><i class="dashicons dashicons-chart-line"></i></div>
                <h1><?php esc_html_e( 'SaaSPress Help', 'saaspress' ); ?></h1>
            </div>
            <div class="saaspress-dashboard">
                <div class="saaspress-help-section">
                    <h2><?php esc_html_e( 'Getting Started', 'saaspress' ); ?></h2>
                    <p><?php esc_html_e( 'Welcome to SaaSPress! Click here to reconnect if your site URL has changed.', 'saaspress' ); ?></p>
                    <a href="#" class="saaspress-button saaspress-button-secondary"><?php esc_html_e( 'Reconnect', 'saaspress' ); ?></a>
                </div>
                <div class="saaspress-help-section">
                    <h2><?php esc_html_e( 'Support', 'saaspress' ); ?></h2>
                    <p><?php esc_html_e( 'Need help? Check our resources below.', 'saaspress' ); ?></p>
                    <a href="#" class="saaspress-button saaspress-button-info"><?php esc_html_e( 'Online Documentation', 'saaspress' ); ?></a>
                    <a href="#" class="saaspress-button saaspress-button-info"><?php esc_html_e( 'Ticket Support', 'saaspress' ); ?></a>
                </div>
            </div>
        </div>
        <?php
    }
}

// Initialize the plugin
new SaaSPress();