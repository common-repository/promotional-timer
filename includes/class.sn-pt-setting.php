<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! class_exists( 'SN_PT_SETTINGS' ) ) {

    class SN_PT_SETTINGS {

        /**
         * Constructor
         * @description Function to initialize WP actions for the class
         */
        function __construct()
        {
            // Assets
            add_action( 'admin_enqueue_scripts', array( &$this, 'set_page_assets' ), 10 );
            //-------

            // Setting
            add_action( 'admin_post_sn_pt_update_setting', array( &$this, 'update_setting' ) );
            //--------
        }

        /**
         * Set page Assets
         * @description Function to include the JS for coupon page
         */
        public function set_page_assets() {
            $page = @sanitize_key( $_GET['page'] );
            if ( $page == 'sn-pt-settings') {
                //wp_enqueue_style('jquery-select2-css', SN_PT_ASSET_URL . '/css/select2.min.css', SN_PT_PLUGIN_VERSION);
                //wp_enqueue_script('jquery-select2-js', SN_PT_ASSET_URL . '/js/select2.min.js', array('jquery'), SN_PT_PLUGIN_VERSION);
                //wp_enqueue_script('jquery-validate-js', SN_PT_ASSET_URL . '/js/jquery.validate.min.js', array('jquery'), SN_PT_PLUGIN_VERSION);
                wp_enqueue_script('sn-pt-setting-js', SN_PT_ASSET_URL . '/js/setting.js', array('jquery'), SN_PT_PLUGIN_VERSION);
            }
        }

        /**
         * Setting page
         * @description Function to show the setting page
         */
        public static function setting_page() {

            $page_name = 'setting';
            $end_date_time = get_option( 'sn_pt_end_date_time' );

            include( SN_PT_TEMPLATE_PATH.'/setting/index.php' );
        }


        /**
         * Update setting
         * @description Function to update settings
         */
        public function update_setting() {
            $fn_status = true;
            $end_date_time = null;

            // Fetch Request Variables
            $end_date_time = sanitize_text_field($_POST['end_date_time']);
            //------------------------

            // Update option variables
            if($fn_status == true) {

                update_option( 'sn_pt_end_date_time', $end_date_time );
            }
            //------------------------

            // Set message
            SN_PT_INIT::set_message(__('Settings updated', SN_PT_SLUG), 'success');
            //------------

            wp_redirect( admin_url( 'admin.php?page=sn-pt-settings' ) );
        }
    }
}

$sn_pt_settings = new SN_PT_SETTINGS();