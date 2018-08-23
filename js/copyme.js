
jQuery.fn.copyme = function() {
    jQuery('span[id^="success-alert"]').remove();
    this.select();
    jQuery(this).focus();
    document.execCommand("copy");
    document.getSelection().removeAllRanges();
    jQuery(this).after('<span id="success-alert"><br>Copied to clipboard</span>');
    jQuery('#success-alert').css( "color", "green" );
};