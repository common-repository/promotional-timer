<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! class_exists( 'SN_PT_FRONTEND' ) ) {
    class SN_PT_FRONTEND {

        /**
         * Constructor
         * @description Function to initialize WP actions for the class
         */
        function __construct()
        {
            // Add JS in head
            add_action('wp_head', array($this, 'promotional_timer_js'));
            add_action('admin_head', array($this, 'promotional_timer_js'));
            //---------------

            // Add shortcode
            add_shortcode('sn_pt_promotional_timer', array( $this, 'promotional_timer' ) );
            //--------------
        }

        public function promotional_timer_js() {
            //wp_enqueue_script( 'jquery-js', SN_PT_ASSET_URL . '/js/jquery.js', array(), SN_PT_PLUGIN_VERSION );
            $promotional_end_date_time = get_option( 'sn_pt_end_date_time' );
            if($promotional_end_date_time) {
                ?>
                <script src="<?php echo(SN_PT_ASSET_URL) ?>/js/jquery.js?ver=<?php echo(SN_PT_PLUGIN_VERSION); ?>"></script>
                <script>
                    var sn_pt_discount_end_date = "<?php echo($promotional_end_date_time); ?>";
                    jQuery(document).ready(function(){
                        // Run discount end timer
                        if(sn_pt_discount_end_date) {
                            sn_pt_discount_end_date = new Date(sn_pt_discount_end_date).getTime();
                        }
                        function sn_pt_update_discount_timer() {

                            // Get todays date and time
                            let now = new Date().getTime();

                            // Find the distance between now and the countdown date
                            let distance = sn_pt_discount_end_date - now;

                            if(distance > 0) {
                                jQuery('.sn-pt-promotional-timer').show();

                                // Time calculations for days, hours, minutes and seconds
                                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                let hours = ('0'+Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).slice(-2);
                                let minutes = ('0'+Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).slice(-2);
                                let seconds = ('0'+Math.floor((distance % (1000 * 60)) / 1000)).slice(-2);
                                //-------------------------------------------------------

                                let remaining_time = "";
                                if(days > 0) {
                                    remaining_time += "<span class='days digit'>" + days + "<span class='digit-label'>DAYS</span></span> ";
                                }

                                remaining_time += "<span class='hours digit'>" + hours + "<span class='digit-label'>HOURS</span></span><span class='digit-separator'>:</span><span class='minutes digit'>" + minutes + "<span class='digit-label'>MINUTES</span></span><span class='digit-separator'>:</span><span class='seconds digit'>" + seconds + "<span class='digit-label'>SECONDS</span></span>";
                                if(jQuery('.sn-pt-promotional-timer .timer').length > 0) {
                                    jQuery('.sn-pt-promotional-timer .timer').html(remaining_time);
                                }
                            }

                            // If the count down is over, hide the timer
                            if (distance < 0) {
                                clearInterval(discount_timer);
                                jQuery('.sn-pt-promotional-timer').hide().find('.timer').remove();
                            }
                            //------------------------------------------
                        }
                        if(sn_pt_discount_end_date) {

                            sn_pt_discount_end_date = new Date(sn_pt_discount_end_date).getTime();
                            discount_timer = setInterval(sn_pt_update_discount_timer, 1000);
                        }
                        //-----------------------
                    });
                </script>
                <?php
            }
        }

        /**
         * Show promotional timer
         * @description Function to show promotional timer
         */
        public function promotional_timer() {

            $html = '<div class="sn-pt-promotional-timer" style="display:none;"><div class="timer"></div></div>';
            echo(wp_kses($html, 'post'));
        }
    }
}

$sn_pt_admin = new SN_PT_FRONTEND();
