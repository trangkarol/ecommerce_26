<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <!-- start css -->
        @section('contentCss')
            {{ Html::style('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
            {{ Html::style('/bower_components/components-font-awesome/css/font-awesome.min.css') }}
            {{ Html::style('/css/bootstrap.css') }}
            {{ Html::style('/css/style.css') }}
            {{ Html::style('/css/plugins/style.css') }}
            {{ Html::style('/css/coreSlider.css') }}
            {{ Html::style('/css/jstarbox.css') }}
            {{ Html::style('/css/flexslider.css') }}
            {{ Html::style('/css/jquery-ui.css') }}
            {{ Html::style('/css/owl.carousel.css') }}
            {{ Html::style('//fonts.googleapis.com/css?family=Cagliostro') }}
            {{ Html::style('/jquery-colorbox/example3/colorbox.css') }}
            {{ Html::style('////fonts.googleapis.com/css?family=Cabin+Condensed') }}
            {{ Html::style('/bower_components/bootstrap-star-rating/css/star-rating.min.css') }}
            {{ Html::style('/bower_components/bootstrap-star-rating/themes/krajee-svg/theme.min.css') }}
        @show
    </head>
    <body>
        <script type='text/javascript'>
            window._sbzq||function(e){e._sbzq=[];var t=e._sbzq;t.push(["_setAccount",44079]);var n=e.location.protocol=="https:"?"https:":"http:";var r=document.createElement("script");r.type="text/javascript";r.async=true;r.src=n+"//static.subiz.com/public/js/loader.js";var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)}(window);
        </script>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div class="wrap">
            <!-- header -->
            <div class="header">
                @include('member.block.header')
            </div>

            <!-- banner -->
            @yield('banner')
            <!-- content -->
           <div class="main">

                @yield('content')
            </div>
        </div>
        @section('contentJs')
            {{ Html::script('/bower_components/jquery/dist/jquery.js') }}
            {{ Html::script('/js/member/simpleCart.min.js') }}
            {{ Html::script('/js/member/responsiveslides.min.js') }}
            {{ Html::script('/js/member/jstarbox.js') }}
            {{ Html::script('/js/member/coreSlider.js') }}
            {{ Html::script('/js/member/main.js') }}
            {{ Html::script('/js/member/jquery.mousewheel.js') }}
            {{ Html::script('/js/member/jquery.mycart.js') }}
            {{ Html::script('/js/member/owl.carousel.js') }}
            {{ Html::script('/js/member/simpleCart.min.js') }}
            {{ Html::script('/js/member/bootstrap.js') }}
            {{ Html::script('/member/common.js') }}
            {{ Html::script('/jquery-colorbox/jquery.colorbox-min.js') }}
            {{ Html::script('/common/js/common.js') }}
            {{ Html::script('/common/js/bootbox.min.js') }}
            {{ Html::script('/bower_components/bootstrap-star-rating/js/star-rating.min.js') }}
            {{ Html::script('/bower_components/bootstrap-star-rating/js/star-rating_locale_LANG.js') }}
            {{ Html::script('/bower_components/bootstrap-star-rating/themes/krajee-svg/theme.js') }}
            <script type="text/javascript">
                var trans = {
                    'confirm_order': "{{ trans('common.msg.confirm-order') }}",
                    'confirm_delete_order': "{{ trans('common.msg.confirm-delete-order') }}",
                    'msg_login': "{{ trans('common.msg.not-login') }}",
                };

                var action = {
                    'get_login': "{{ action('Auth\LoginController@index') }}",
                    'add_cart': "{{ action('Member\OrderController@addCart') }}",
                    'remove_cart': "{{ action('Member\OrderController@removeCart') }}",
                    'search_product': "{{ action('Member\ProductController@searchProduct') }}",
                    'product_sub_category': "{{ action('Member\SuggestProductController@getCategory') }}",
                    'rating_product': "{{ action('Member\RatingController@addRating') }}",
                };

            </script>
        @show
    </body>
</html>
