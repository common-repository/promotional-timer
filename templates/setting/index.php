<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

?>
<div class="sn-pt-setting-page setting">
    <div class="sn-pt-header">
        <h2><?php echo( __('Manage General settings', SN_PT_SLUG) ); ?></h2>
        <p><?php echo( __('This section allows you to manage General settings', SN_PT_SLUG) ); ?></p>
    </div>
    <div class="sn-pt-box-section">
        <?php include( SN_PT_TEMPLATE_PATH.'/setting/navigation.php' );?>
        <div class="setting-box">
            <form id="form_setting" action="<?php echo(admin_url('admin-post.php')) ?>" method="post" class="sn-pt-form setting-form setting">
                <input type="hidden" id="action" name="action" value="sn_pt_update_setting" />
                <div class="input-row">
                    <div class="input-group left">
                        <label class="control-label"><?php echo( __('End Date & Time', SN_PT_SLUG) ); ?></label>
                        <input type="text" id="end_date_time" name="end_date_time" class="form-control required" placeholder="YYYY-MM-DD HH:MM" value="<?php echo($end_date_time) ?>" />
                    </div>
                    <div class="clear"></div>
                </div>
                Note: Use <strong>[sn_pt_promotional_timer]</strong> shortcode to display the timer on the webiste
            </form>
            <div class="footer">
                <button type="button" class="button button-primary btn-submit" data-form="form_setting"><?php echo( __('Save', SN_PT_SLUG) ); ?></button>
            </div>
        </div>
    </div>
</div>
