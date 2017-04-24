$(document).ready(function () {
    // $(document).on('click', '#login', function () {
    //     getFormLogin();
    // });

    $(document).on('click', '#cart', function () {
        addCart();
    });
});

function addCart() {
    $.ajax({
        type: 'POST',
        url: action['get_login'],
        dataType: 'json',
        success:function(data) {
            if (data.result) {
                $('#sub-category').empty();
                $('#sub-category').html(data.html);
            }
        }
    });
}
