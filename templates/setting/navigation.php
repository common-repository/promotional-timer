<?php SN_PT_INIT::show_message(); ?>
<div class="sn-pt-navigation-box">
    <a href="admin.php?page=sn-pt-setting" class="nav-link <?php echo($page_name=='setting'?'active':'') ?>"><?php echo( __('Setting', SN_PT_SLUG) ); ?></a>
    <div class="support-links">
        <a href="<?php echo( SN_PT_DOCUMENTATION_URL ); ?>../setting" target="_blank"><?php echo( __('Documentation', SN_PT_SLUG) ); ?></a> | <a href="<?php echo( SN_PT_PLUGIN_URL ); ?>contact-us" target="_blank"><?php echo( __('Support', SN_PT_SLUG) ); ?></a>
    </div>
</div>
