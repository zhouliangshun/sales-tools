
jQuery.fn.copyme = function() {
    $('span[id^="success-alert"]').remove();
    this.select();
    $(this).focus();
    document.execCommand("copy");
    document.getSelection().removeAllRanges();
    $(this).after('<span id="success-alert"><br>Copied to clipboard</span>');
    $('#success-alert').css( "color", "green" );
};