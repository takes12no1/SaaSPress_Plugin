<?php

require_once __DIR__ . '/plugin-update-checker/plugin-update-checker.php';

class SaaSPress_Update_Checker {
    private $plugin_slug;
    private $plugin_version;
    private $update_url;

    public function __construct($plugin_slug, $plugin_version, $update_url) {
        $this->plugin_slug = $plugin_slug;
        $this->plugin_version = $plugin_version;
        $this->update_url = $update_url;

        add_filter('site_transient_update_plugins', array($this, 'check_for_update'));
        add_filter('plugins_api', array($this, 'plugin_info'), 10, 3);
    }

    // Check if an update is available
    public function check_for_update($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }

        $response = wp_remote_get($this->update_url);
        if (is_wp_error($response)) {
            return $transient;
        }

        $data = json_decode(wp_remote_retrieve_body($response));
        if (!$data || !isset($data->version)) {
            return $transient;
        }

        if (version_compare($this->plugin_version, $data->version, '<')) {
            $plugin_data = new stdClass();
            $plugin_data->slug = $this->plugin_slug;
            $plugin_data->new_version = $data->version;
            $plugin_data->url = $data->homepage;
            $plugin_data->package = $data->download_url;
            $transient->response[$this->plugin_slug . '/' . $this->plugin_slug . '.php'] = $plugin_data;
        }

        return $transient;
    }

    // Display update information in the WordPress dashboard
    public function plugin_info($res, $action, $args) {
        if ($action !== 'plugin_information' || $args->slug !== $this->plugin_slug) {
            return $res;
        }

        $response = wp_remote_get($this->update_url);
        if (is_wp_error($response)) {
            return $res;
        }

        $data = json_decode(wp_remote_retrieve_body($response));
        if (!$data) {
            return $res;
        }

        $res = new stdClass();
        $res->name = $data->name;
        $res->slug = $this->plugin_slug;
        $res->version = $data->version;
        $res->author = $data->author;
        $res->homepage = $data->homepage;
        $res->sections = (array) $data->sections;
        $res->download_link = $data->download_url;

        return $res;
    }
}

// Initialize the update checker
new SaaSPress_Update_Checker(
    'saaspress',                          // Plugin slug
    '1.0.1',                              // Current plugin version
    'https://github.com/takes12no1/SaaSPress_Plugin/archive/refs/tags/v1.0.1.zip'  // GitHub URL for download
);
?>