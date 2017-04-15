$(document).ready(function () {
    getSubCategory();

    // change category one
    $(document).on('change', '#category', function () {
        getSubCategory();
    });
});

function getSubCategory() {
    var parent_id = $('#category').val();
    var sub_id = $('#sub_id').val();
    $.ajax({
        type: 'POST',
        url: action['product_sub_category'],
        dataType: 'json',
        data: {
            parent_id: parent_id,
            sub_id: sub_id,
        },
        success:function (data) {
            if (data.result) {
                $('#sub-category').empty();
                $('#sub-category').html(data.html);
            }
        }
    });
}
