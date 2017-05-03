$(document).ready(function() {
    // click on search
    $(document).on('click', '#btn-search', function(){
        search(0);
    });

    // delelete
    $(document).on('click', '.btn-delete', function(event) {
        $(this).parents('.delete-form-user').addClass('current');
        event.preventDefault();
        bootbox.confirm(trans['msg_comfirm_delete'], function(result) {
            if (result) {
                $('.delete-form-user.current').submit();
            }
        });
    });

    // status paid
    $(document).on('click', '.btn-status-paid', function(event) {
        $(this).parents('.form-status-paid').addClass('current');
        event.preventDefault();
        bootbox.confirm(trans['msg_comfirm_status'], function(result) {
            if (result) {
                var data = $('.form-status-paid.current').serialize();
                changeStatus(data, $('.form-status-paid.current'), trans['status_paid']);
            }
        });
    });

    // status cancel
    $(document).on('click', '.btn-status-cancel', function(event) {
        $(this).parents('.form-status-cancel').addClass('current');
        event.preventDefault();
        bootbox.confirm(trans['msg_comfirm_status'], function(result) {
            if (result) {
                var data = $('.form-status-cancel.current').serialize();
                changeStatus(data, $('.form-status-cancel.current'), trans['status_cancel']);
            }
        });
    });

    //handel pagination by ajax
    $(document).on('click', '.search.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        search(page);
    });

});

function search(page) {
    var data = $('#order-search').serialize();
    console.log(data);
    url = action['order_search'];
    if (page) {
        url += '?page=' + page;
    }

    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data,
        success:function(data) {
            console.log(data);
            if (data.result) {
                $('#result-orders').empty();
                $('#result-orders').html(data.html);
                $('.pagination').addClass('search');
                if (page){
                    location.hash='?page='+page;
                }
            }
        }
    });
}

function changeStatus(data, formCurrent, status) {
    $.ajax({
        type: 'POST',
        url: action['change_status'],
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
