<?php
/*
Plugin Name: Promotional Timer
Plugin URI: https://www.codeteam.in/product/promotional-timer/
Description: Show a promotional timer on the website.
Version: 1.1
Requires at least: 4.9
Tested up to: 6.4.1
Requires PHP: 5.4
Author: Siddharth Nagar
Author URI: http://www.codeteam.in/
License: GPLv2
*/

if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! defined( 'SN_PT_AUTHOR_URL' ) ) {
    define( 'SN_PT_AUTHOR_URL', 'https://www.codeteam.in/' );
}

if ( ! defined( 'SN_PT_PLUGIN_URL' ) ) {
    define( 'SN_PT_PLUGIN_URL', SN_PT_AUTHOR_URL.'product/promotional-timer/' );
}

if ( ! defined( 'SN_PT_DOCUMENTATION_URL' ) ) {
    define( 'SN_PT_DOCUMENTATION_URL', SN_PT_AUTHOR_URL.'documentation/promotional-timer/introduction/' );
}

if ( ! defined( 'SN_PT_PLUGIN_VERSION' ) ) {
    define( 'SN_PT_PLUGIN_VERSION', '1.1' );
}

if ( ! defined( 'SN_PT_SLUG' ) ) {
    define( 'SN_PT_SLUG', 'sn-promotional-timer' );
}

if ( ! defined( 'SN_PT_DIR' ) ) {
    define( 'SN_PT_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'SN_PT_URL' ) ) {
    define( 'SN_PT_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'SN_PT_FILE' ) ) {
    define( 'SN_PT_FILE', __FILE__ );
}

if ( ! defined( 'SN_PT_FILE_NAME' ) ) {
    define( 'SN_PT_FILE_NAME', plugin_basename(__FILE__) );
}

if ( ! defined( 'SN_PT_TEMPLATE_PATH' ) ) {
    define( 'SN_PT_TEMPLATE_PATH', SN_PT_DIR . 'templates' );
}

if ( ! defined( 'SN_PT_ASSET_URL' ) ) {
    define( 'SN_PT_ASSET_URL', SN_PT_URL . 'assets' );
}


/**
 * Initialize plugin
 * @description Function to initialize the plugin
 */
function sn_pt_init() {

    load_plugin_textdomain( SN_PT_SLUG, false, dirname( plugin_basename( __FILE__ ) ). '/languages/' );

    if(file_exists(SN_PT_DIR.'/includes/class.sn-pt-init.php')) {
        require_once(SN_PT_DIR.'/includes/class.sn-pt-init.php');
    }

    if(file_exists(SN_PT_DIR.'/includes/class.sn-pt-dashboard.php')) {
        require_once(SN_PT_DIR.'/includes/class.sn-pt-dashboard.php');
    }

    if(file_exists(SN_PT_DIR.'/includes/class.sn-pt-frontend.php')) {
        require_once(SN_PT_DIR.'/includes/class.sn-pt-frontend.php');
    }

    if(file_exists(SN_PT_DIR.'/includes/class.sn-pt-setting.php')) {
        require_once(SN_PT_DIR.'/includes/class.sn-pt-setting.php');
    }
}
add_action( 'sn_pt_init', 'sn_pt_init' );

/**
 * Install plugin
 * @description Function to initiate the plugin installation
 */
function sn_pt_install() {

    do_action( 'sn_pt_init' );
}
add_action( 'plugins_loaded', 'sn_pt_install', 10 );