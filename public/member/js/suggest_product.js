$(document).ready(function () {
    $('#category').prepend('<option value= "0" selected>' + trans['choose_category'] + '</option>');
        getSubCategory();
    $(document).on('click', '#new-category', function () {
        $('.div-category').toggle();
        $('.old-category').toggle();
        $(this).text(trans['new_category']);
        $(this).prop('id', 'old-category');
    });

    $(document).on('click', '#old-category', function () {
        $('.div-category').toggle();
        $('.old-category').toggle();
        $(this).text(trans['old_category']);
        $(this).prop('id', 'new-category');
    });

    // change category one
    $(document).on('change', '#category',function() {
        getSubCategory();
    });

    // delelete
    $(document).on('click', '.btn-delete', function(event) {
        $(this).parents('.form-delete').addClass('current');
        event.preventDefault();
        bootbox.confirm(trans['confirm_delete'], function(result) {
            if(result) {
                $('.form-delete.current').submit();
            }
        });
    });
});

function getSubCategory() {
    var parent_id = $('#category').val();
    var sub_id = $('#sub_id').val();
    console.log(parent_id);
    $.ajax({
        type: 'POST',
        url: action['product_sub_category'],
        dataType: 'json',
        data: {
            parent_id: parent_id,
            sub_id: sub_id,
        },
        success:function(data) {
            if (data.result) {
                $('#sub-category').empty();
                $('#sub-category').html(data.html);
            }
        }
    });
}
