<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! class_exists( 'SN_PT_INIT' ) ) {

    class SN_PT_INIT {

        /**
         * Constructor
         * @description Function to register and initialize WP actions for the plugin
         */
        function __construct() {

            register_activation_hook( SN_PT_FILE, array( 'SN_PT_INIT', 'install_plugin_data' ) );
            register_uninstall_hook( SN_PT_FILE, array( 'SN_PT_INIT', 'uninstall_plugin_data' ) );

            $this->init_plugin();
        }

        /**
         * Initializer plugin
         * @description Function initialize action for the plugin
         */
        public function init_plugin() {
            add_filter( 'plugin_action_links_' . SN_PT_FILE_NAME, array( $this, 'plugin_action_links' ) );
            add_action( 'admin_enqueue_scripts', array( &$this, 'set_admin_css' ), 10 );
            add_action( 'admin_enqueue_scripts', array( &$this, 'set_admin_js' ), 10 );
            add_action( 'admin_head', array( &$this, 'add_head_js'), 10 );
            add_action( 'admin_menu', array( &$this, 'set_menu' ) );
        }

        /**
         * Add action links on plugin page
         * @description Function to add plugin action links
         *
         * @param $links
         * @return array
         */
        public function plugin_action_links( $links ) {
            $plugin_links = array(
                '<a target="_blank" href="'.SN_PT_DOCUMENTATION_URL.'">' . __('Documentation', SN_PT_SLUG) . '</a>',
                '<a target="_blank" href="https://wordpress.org/support/plugin/promotional-timer/reviews?rate=5#new-post">' . __('Review', SN_PT_SLUG) . '</a>',
            );
            return array_merge($plugin_links, $links);
        }

        /**
         * Set admin CSS
         * @description Function to include the admin CSS
         */
        public function set_admin_css() {
            wp_register_style( 'sn-pt-admin-css', SN_PT_ASSET_URL . '/css/style.css', array(), SN_PT_PLUGIN_VERSION );
            wp_enqueue_style( 'sn-pt-admin-css' );
        }

        /**
         * Set admin JS
         * @description Function to include the admin JS
         */
        public function set_admin_js() {
            wp_enqueue_script( 'jquery-form-js', SN_PT_ASSET_URL . '/js/jquery.form.js', array('jquery'), SN_PT_PLUGIN_VERSION );
        }

        /**
         * Add Head JS
         * @description Function to add global JS variables in adminhead
         */
        public function add_head_js() {
            ?>
            <script>
                var sn_pt_admin_url = "<?php echo( admin_url() ); ?>";
            </script>
            <?php
        }

        /**
         * Set menu
         * @description Function to set the menu for the plugin
         */
        public function set_menu() {
            global $current_user;

            if ( current_user_can( 'administrator' ) || is_super_admin() ) {
                $capabilities = $this->user_capabilities();
                foreach ( $capabilities as $capability => $cap_desc ) {
                    $current_user->add_cap( $capability );
                }
                unset ( $capabilities );
            }

            add_menu_page( __('Promotional Timer', SN_PT_SLUG), __('Promotional Timer', SN_PT_SLUG), 'sn_pt_manage_dashboard', 'sn-pt-dashboard', array('SN_PT_DASHBOARD', 'dashboard_page') , SN_PT_ASSET_URL.'/images/icon.png' );
            add_submenu_page( 'sn-pt-dashboard', __('Dashboard', SN_PT_SLUG), __('Dashboard', SN_PT_SLUG), 'sn_pt_manage_dashboard', 'sn-pt-dashboard', array('SN_PT_DASHBOARD', 'dashboard_page' ) );
            add_submenu_page( 'sn-pt-dashboard', __('Settings', SN_PT_SLUG), __('Settings', SN_PT_SLUG), 'sn_pt_settings', 'sn-pt-settings', array('SN_PT_SETTINGS', 'setting_page' ) );
        }

        /**
         * Install plugin data
         * @description Function to install the data at installation
         */
        public function install_plugin_data() {

        }

        /**
         * Uninstall plugin data
         * @description Function to uninstall the data at un-installation
         */
        public function uninstall_plugin_data() {

        }

        /**
         * Set message
         * @description Function to set the message in session
         * @param $message
         * @param $type
         */
        public static function set_message( $message, $type ) {
            $_SESSION['sn_pt_message'] = ['type' => $type, 'message' => $message];
        }

        /**
         * Show message
         * @description Function to show the message on the top of page
         */
        public static function show_message() {
            $html = '';
            $message = sanitize_text_field( @$_SESSION['sn_ws_message']['message'] );
            if( $message ) {
                $html .= '<div id="message" class="sn-ws-message updated notice notice-success is-dismissible">';
                $html .= '<p>'. __($message, 'smtp-for-wp') .'</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">'.__('Dismiss this notice', 'smtp-for-wp').'</span></button>';
                $html .= '</div>';
                echo(wp_kses($html, 'post'));
            }
            unset($_SESSION['sn_ws_message']);
        }

        /**
         * User capabilities
         * @description Function to return plugin user capabilities
         * @return array
         */
        private function user_capabilities() {

            return array (
                'sn_pt_manage_dashboard'   => __( 'User can manage Dashboard', SN_PT_SLUG ),
                'sn_pt_settings'           => __( 'User can manage General Settings', SN_PT_SLUG ),
            );
        }
    }
}

$sn_pt_init = new SN_PT_INIT();
