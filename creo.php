<?php
/*
Plugin Name: Creo  
Description: Our Plugin with PWA Functionality
Version: 1.1
Author: Vinay Dangodra
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define the path to the shortcodes directory
$shortcodes_dir = plugin_dir_path(__FILE__) . 'shortcodes/';

// Include all shortcode files
foreach (glob($shortcodes_dir . '*.php') as $file) {
    require_once $file;
}
require_once plugin_dir_path(__FILE__) . 'cart_count.php';

// Enqueue assets (Swiper and custom scripts)
function enqueue_swiper_assets() {
    wp_enqueue_style('swiper-css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css');
    wp_enqueue_script('swiper-js', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('custom-swiper-init', plugin_dir_url(__FILE__) . 'js/swiper-init.js', array('swiper-js'), null, true);
    wp_enqueue_script('custom-creo-script', plugin_dir_url(__FILE__) . 'js/custom.js', array('custom-swiper-init'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_swiper_assets');

// Enqueue custom styles
function enqueue_latest_arrivals_styles() {
    wp_enqueue_style(
        'latest-arrivals-styles',
        plugin_dir_url(__FILE__) . 'css/custom.css',
        array(),
        '1.0',
        'all'
    );
}
add_action('wp_enqueue_scripts', 'enqueue_latest_arrivals_styles');

// Enqueue PWA-related scripts and manifest
function creo_pwa_enqueue_scripts() {
    // Add the manifest
    echo '<link rel="manifest" href="' . plugin_dir_url(__FILE__) . 'manifest.json">';
}
add_action('wp_head', 'creo_pwa_enqueue_scripts');

// Register and enqueue the service worker
function register_service_worker() {
    echo '<script>
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("' . plugin_dir_url(__FILE__) . '/js/sw.js")
                .then(function(registration) {
                    console.log("Service Worker registered with scope:", registration.scope);
                })
                .catch(function(error) {
                    console.log("Service Worker registration failed:", error);
                });
        }
    </script>';
}
add_action('wp_footer', 'register_service_worker');

// Generate the manifest.json file
function creo_pwa_generate_manifest() {
    $manifest = [
        "name" => "Little Things Cute",
        "short_name" => "LTC",
        "start_url" => "/",
        "display" => "standalone",
        "background_color" => "#ffffff",
        "theme_color" => "#000000",
        "icons" => [
            [
                "src" => plugin_dir_url(__FILE__) . "icon-192x192.png",
                "sizes" => "192x192",
                "type" => "image/png",
            ],
            [
                "src" => plugin_dir_url(__FILE__) . "icon-512x512.png",
                "sizes" => "512x512",
                "type" => "image/png",
            ],
        ],
    ];

    $plugin_dir = plugin_dir_path(__FILE__);
    file_put_contents($plugin_dir . 'manifest.json', json_encode($manifest));
}
add_action('init', 'creo_pwa_generate_manifest');

// Enqueue PWA install script
function enqueue_pwa_install_script() {
    wp_enqueue_script('sw-register', plugin_dir_url(__FILE__) . 'js/sw-register.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_pwa_install_script');

// Add install PWA popup
function add_install_pwa_popup() {
    echo '
    <div id="install-pwa-popup" style="display: none; position: fixed; bottom: 20px; left: 20px; background-color: white; padding: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); z-index: 1000; border-radius: 8px;">
        <p>Would you like to install this app on your device?</p>
        <button id="install-pwa-button">Install</button>
        <button id="dismiss-pwa-popup">Dismiss</button>
    </div>';
}
add_action('wp_footer', 'add_install_pwa_popup');

// Add iOS-specific install PWA popup
function add_ios_install_pwa_popup() {
    echo '
    <div id="install-pwa-popup-ios" style="display: none; position: fixed; bottom: 20px; left: 20px; background-color: white; padding: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); z-index: 1000; border-radius: 8px;">
        <p>To install this app on your iPhone, tap the share button in Safari and choose "Add to Home Screen".</p>
        <button id="dismiss-pwa-popup-ios">Dismiss</button>
    </div>';
}
add_action('wp_footer', 'add_ios_install_pwa_popup');











