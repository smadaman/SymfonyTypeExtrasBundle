/**
 * Input Boxes
 *
 * - Makes input boxes jump when something inputted
 */
$(document).on('keyup', '.input-boxes input', function(e) {
    var $input = $(this);
    var $nextInput = $input.nextAll('input').first();
    var kc = e.keyCode;
    if ($input.val() != "" && kc != 9 && kc != 16)
        $nextInput.focus();
});

$(document).on('click', '.input-boxes .clear-input-boxes', function(e) {
    e.preventDefault();
    $(this).closest('.input-boxes').find('input').val(null);
    $(this).closest('.input-boxes').find('input:first').focus();
});

$(document).on('focus', '.input-boxes input', function(e) {
    $(this).select();
});