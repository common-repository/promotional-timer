jQuery(document).ready(function()
{
    var $setting_box = jQuery('.sn-pt-setting-page.setting .setting-box');

    // Apply Custom Select
    //$setting_box.find('.custom-select').select2({'minimumResultsForSearch': -1});
    //--------------------

    // Validate Forms
    //$setting_box.find('.setting-form').validate();
    //---------------

    // Form Submit Event
    $setting_box.find('.btn-submit').click(function() {
        jQuery('form#'+jQuery(this).data('form')).submit();
    });
    //------------------
});
