$(document).ready(function () {
    var selected = '';
    if ($('#sub_id').val() == 0) {
        selected = 'selected';
    }

    $('#category').prepend('<option value= "0"' + selected + '>' + trans['choose_category'] + '</option>');
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
