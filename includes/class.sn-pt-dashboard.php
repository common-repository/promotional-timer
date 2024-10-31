<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! class_exists( 'SN_PT_DASHBOARD' ) ) {
    class SN_PT_DASHBOARD {

        /**
         * Constructor
         * @description Function to initialize WP actions for the class
         */
        function __construct()
        {
            // Assets
            add_action( 'admin_enqueue_scripts', array( &$this, 'set_page_assets' ), 10 );
            //-------
        }

        /**
         * Set page Assets
         * @description Function to include the JS for coupon page
         */
        public function set_page_assets() {
            global $pagenow;
            if ( $pagenow == 'index.php') {

            }
        }


        /**
         * Dashboard page
         * @description Function to show the dashboard of the plugin
         */
        public static function dashboard_page() {

            include( SN_PT_TEMPLATE_PATH.'/dashboard.php' );
        }
    }
}

$sn_pt_dashboard = new SN_PT_DASHBOARD();
