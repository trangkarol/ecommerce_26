$(document).ready(function() {
    // accept
    $(document).on('click', '.btn-save', function(event) {
        $(this).parents('.form-save').addClass('current');
        event.preventDefault();
        bootbox.confirm(trans['msg_comfirm_accpet'], function(result) {
            if (result) {
                console.log($('.form-save.current').html());
                $('.form-save.current').submit();
                $('.form-save').removeClass('current');
            }
        });
    });
    // cacnel
    $(document).on('click', '.btn-cancel', function(event) {
        $(this).parents('.form-cancel').addClass('current');
        event.preventDefault();
        bootbox.confirm(trans['msg_comfirm_cancel'], function(result) {
            if (result) {
                $('.form-cancel.current').submit();
                $('.form-cancel').removeClass('current');
            }
        });
    });
});
