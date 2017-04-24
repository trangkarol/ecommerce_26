$(document).ready(function() {
    getSubCategory();
    // change category one
    $(document).on('change', '#category',function() {
        getSubCategory();
    });

    // click on search
    $(document).on('click', '#btn-search', function(){
        search(0);
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
        success:function(data) {
            if (data.result) {
                $('#sub-category').empty();
                $('#sub-category').html(data.html);
            }
        }
    });
}

function search(page) {
    var data = $('#product-search').serialize();
    url = action['product_search'];
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
                $('#result-products').empty();
                $('#result-products').html(data.html);
                $('.pagination').addClass('search');
                if (page){
                    location.hash='?page='+page;
                }
            }
        }
    });
}
