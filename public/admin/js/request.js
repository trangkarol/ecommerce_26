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

    // click on search
    $(document).on('click', '#btn-search', function(){
        search(0);
    });
});

function search(page) {
    var data = $('#request-search').serialize();
    url = action['request_search'];
    if (page) {
        url += '?page=' + page;
    }

    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data,
        success:function(data) {
            if (data.result) {
                $('#result-requests').empty();
                $('#result-requests').html(data.html);
                $('.pagination').addClass('search');
                if (page){
                    location.hash='?page='+page;
                }
            }
        }
    });
}
