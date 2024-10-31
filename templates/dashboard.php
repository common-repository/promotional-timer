<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

?>
<div class="sn-pt-dashboard-page">
    <div class="header">
        <h2><?php echo( __('Promotional Timer', SN_PT_SLUG) ); ?></h2>
        <p><?php echo( __('This is a demo of how the timer will show on the website.', SN_PT_SLUG) ); ?></p>
    </div>
    <div class="dashboard-section">
        <div class="dashboard-box">
            <div class="content">
                <?php echo do_shortcode('[sn_pt_promotional_timer]') ?>
                <div class="footer"><a href="<?php echo(SN_PT_DOCUMENTATION_URL); ?>" target="_blank">Documentation</a> | <a href="<?php echo(SN_PT_PLUGIN_URL); ?>contact-us" target="_blank">Support</a></div>
            </div>
        </div>
    </div>
</div>