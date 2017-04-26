$(document).ready(function () {
    $('#example1').coreSlider({
        pauseOnHover: false,
        interval: 3000,
        controlNavEnabled: true
    });

    $('.value-plus1').on('click', function () {
        var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10) + 1;
        divUpd.text(newVal);
    });

    $('.value-minus1').on('click', function () {
        var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10) - 1;
        if(newVal >= 1) divUpd.text(newVal);
    });

    $(document).on('click', '#login', function () {
        getFormLogin();
    });

    $(function () {
        $("#slider").responsiveSlides({
            auto: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            pager: true,
        });
    });

    // change category one
    $(document).on('change', '#category',function() {
        getSubCategory();
    });

    $(document).on('click', '#order', function () {
        event.preventDefault();
        bootbox.confirm(trans['confirm_order'], function(result) {
            if(result) {
                $('.form-order').submit();
            }
        });
    });

    $(document).on('click', '#btn-agree', function () {
        event.preventDefault();
        bootbox.confirm(trans['confirm_rating'], function(result) {
            if(result) {
                rating();
            }
        });
    });

    $(document).on('click', '#message', function () {
        event.preventDefault();
        bootbox.alert(trans['msg_login']);
    });

    //handel pagination by ajax
    $(document).on('click', '.search.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        search(page);
    });

    $.ajaxSetup ({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#input-1').rating();
    $('#input-3').rating({displayOnly: true, step: 0.5});

    $('.close1').on('click', function(event) {
        $(this).parents('.cart-detail').addClass('curent-detail-cart');
        bootbox.confirm(trans['confirm_delete_order'], function(result) {
            if(result) {
                $('.cart-detail.curent-detail-cart').fadeOut('slow', function() {
                    removeCart();
                    $(this).remove();
                });
            } else {
                $('.cart-detail').removeClass('curent-detail-cart');
            }
        });
    });

    cart();

    $(document).on('click', '#btn-search',function() {
        // when event search is firstly
        search(0);
    });

});

function cart() {
    $(document).on('click', '.add-cart', function () {
        $(this).parent().addClass('cart-current');
        addCart();
        $(this).parent().removeClass('cart-current');
    });

    $('.btn-number').click(function(e){
        e.preventDefault();
        $(this).parents('.add-cart-number').addClass('current');
        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $('.add-cart-number.current').find("input[name='"+fieldName+"']");
        $(this).parents('.add-cart-number').removeClass('current');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {

                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.prop('value', currentVal + 1);
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });

    $('.add-cart-number').find('.input-number').focusin(function(){
       $(this).data('oldValue', $(this).val());
    });

    $('.input-number').change(function() {
        console.log('sdsdsdsds');
        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $('.add-cart-number.current').find(".btn-number[data-type='minus'][data-field='"+name+"']").prop('disabled', false);
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $('.add-cart-number.current').find(".btn-number[data-type='plus'][data-field='"+name+"']").prop ('disabled', false);
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
    });

    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
}

function getFormLogin() {
    $.ajax({
        type: 'GET',
        url: action['get_login'],
        dataType: 'json',
        success:function(data) {
            if (data.result) {
                $.colorbox({ html: data.html });
            }
        }
    });
}

function addCart() {
    var productId = $('.cart-current').find('.cart-product').val();
    var number = $('.cart-current').find('.number-product').val();
    $.ajax({
        type: 'POST',
        url: action['add_cart'],
        dataType: 'json',
        data: {
            productId: productId,
            number: number,
        },
        success:function(data) {
            if (data.result) {
                $('#div-your-cart').empty();
                $('#div-your-cart').html(data.html);
                bootbox.alert('Add product to your cart success!');
            }
        }
    });
}

function removeCart() {
    var productId = $('.cart-detail.curent-detail-cart').find('.cart-product').val();
    $.ajax({
        type: 'POST',
        url: action['remove_cart'],
        dataType: 'json',
        data: {
            productId: productId,
        },
        success:function(data) {
            console.log(data);
            if (data.result) {
                $('#div-your-cart').empty();
                $('#div-your-cart').html(data.html);
                $('#total-number-cart').text(data.totalNumber);
            }
        }
    });
}

function search(page) {
    var data = $('#product-search').serialize();
    var url = action['search_product'];
    if (!page) {
        url += '?page=' + page;
    }

    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data,
        success:function(data) {
            $('#div-result-product').empty();
            $('#div-result-product').html(data.html);
            $('.pagination').addClass('search');
            if (page) {
                location.hash='?page='+page;
            }
            $('.rating').rating();

            cart();
        },
    });
}

function rating() {
    var productId = $('#productId').val();
    var point = $('.point').val();
    console.log(point);
    $.ajax({
        type: 'POST',
        url: action['rating_product'],
        dataType: 'json',
        data: {
            productId: productId,
            point: point,
        },
        success:function(data) {
            console.log( data.avgRating.avg_rating);
            if (data.result) {
                $('.div-point').find('#input-3').val(data.avgRating.avg_rating);
                $('.rating').rating();
            }
        }
    });
}

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
