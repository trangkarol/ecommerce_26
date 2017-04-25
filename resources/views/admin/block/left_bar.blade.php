<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>{{ trans('common.title-system') }}</span></a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>{{ trans('common.lbl-welcome') }}</span>
                <h2></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>{{ trans('common.lbl-genaral') }}</h3>
                <ul class="nav side-menu">
                    <!-- management statics-->
                    <li class="@if (Request::url() == action('Admin\StatisticController@index')) active @endif ">
                        <a href="{{ action('Admin\StatisticController@index') }}"><i class="fa fa-bar-chart"></i><span> {{ trans('static.title-static') }} </span></a>
                    </li>
                    <!-- management users-->
                    <li class="@if (Request::url() == action('Admin\UserController@index')) active @endif ">
                        <a href="{{ action('Admin\UserController@index') }}"><i class="fa fa-users"></i><span> {{ trans('user.title-users') }} </span></a>
                    </li>
                    <!-- management category-->
                    <li class="@if (Request::url() == action('Admin\CategoryController@index')) active @endif ">
                        <a href="{{ action('Admin\CategoryController@index') }}"><i class="fa fa-th-list"></i><span> {{ trans('category.title-category') }} </span></a>
                    </li>
                    <!-- management products-->
                    <li class="@if (Request::url() == action('Admin\ProductController@index')) active @endif ">
                        <a href="{{ action('Admin\ProductController@index') }}"><i class="fa fa-product-hunt"></i><span> {{ trans('product.title-product') }} </span></a>
                    </li>
                    <!-- management orders-->
                    <li class="@if (Request::url() == action('Admin\OrderController@index')) active @endif ">
                        <a href="{{ action('Admin\OrderController@index') }}"><i class="fa fa-first-order"></i><span> {{ trans('order.title-order') }} </span></a>
                    </li>
                    <!-- management request-->
                    <li class="@if (Request::url() == action('Admin\RequestController@index')) active @endif ">
                        <a href="{{ action('Admin\RequestController@index') }}"><i class="fa fa-retweet"></i><span> {{ trans('product.title-request') }} </span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
    <!-- /menu footer buttons -->
    </div>
</div>
