$(document).ready(function() {
    // accept
    $(document).on('click', '.btn-save', function(event) {
        $('.form-save').removeClass('current');
        $(this).parents('.form-save').addClass('current');
        event.preventDefault();
        bootbox.confirm(trans['msg_comfirm_accpet'], function(result) {
            if (result) {
                $('.form-save.current').submit();
            }
        });
    });
    // cacnel
    $(document).on('click', '.btn-cancel', function(event) {
        $('.form-cancel').removeClass('current');
        $(this).parents('.form-cancel').addClass('current');
        event.preventDefault();
        bootbox.confirm(trans['msg_comfirm_cancel'], function(result) {
            if (result) {
                var data = $('.form-cancel.current').serialize();
                cancel(data, $('.form-cancel.current'), trans['status_cancel']);
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

function cancel(data, formCurrent, status) {
    $.ajax({
        type: 'POST',
        url: action['cancel'],
        dataType: 'json',
        data: data,
        success:function(data) {
            if (data.result) {
                formCurrent.parents('tr').find('.status').html(status);
                formCurrent.parents('td').remove();
            }
        }
    });
}
