<?php

// Function to register assets (custom CSS and JS)
function saaspress_enqueue_assets() {
    wp_enqueue_style( 'saaspress-css', SAASPRESS_URL . 'assets/css/style.css', array(), '1.0.0' );
    wp_enqueue_script( 'saaspress-js', SAASPRESS_URL . 'assets/js/script.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'saaspress_enqueue_assets' );