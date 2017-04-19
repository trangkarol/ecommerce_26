<div class="header-top">
    <div class="container">
         <div class="top-left">
            <a href="#">{{ trans('common.lbl-help') }}<i class="glyphicon glyphicon-phone" aria-hidden="true"></i>{{ trans('common.lbl-sdt') }}</a>
        </div>
        <div class="top-right">
            <ul>
                @if (auth()->check())
                    <li><a href="{{ action('Auth\RegisterController@getUpdate', auth()->id) }}">{{ auth()->name }}</a></li>
                    <li><a href="#"><img src="{{ auth()->path_avatar }}" class="img-avatar"></a></li>
                    <li>
                        <a href="{{ action('Auth\LoginController@logout') }}" id="btn-logout">
                            <i class="fa fa-sign-out pull-right"></i> {{ trans('common.title-logout') }}
                        </a>
                        {!! Form::open(['action' => 'Auth\LoginController@logout', 'class' => 'form-horizontal', 'id' => 'logout-form']) !!}
                        {{ Form::close() }}
                    </li>
                @else
                    <li><a href="javascript:void(0)" id="login">{{ trans('common.title-login') }}</a></li>
                    <li><a href="{{ action('Auth\RegisterController@index') }}" id="resgiter">{{ trans('common.title-register') }}</a></li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="heder-bottom">
    <div class="container">
        <div class="logo-nav">
            <div class="logo-nav-left">
                <h1><a href="index.html">{{ trans('common.title-newshop') }}<span>{{ trans('common.title-everywhere') }}</span></a></h1>
            </div>
            <div class="logo-nav-left1">
                <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header nav_2">
                    <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ action('Member\HomeController@index') }}" class="act">{{ trans('common.title-home') }}</a></li>
                        <!-- Mega Menu -->
                        @foreach ($menus as $menu)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $menu->name }}<b class="{{ $menu->subCategory->isEmpty() ? '' : 'caret' }}"></b></a>
                                @if (!$menu->subCategory->isEmpty())
                                    <ul class="dropdown-menu multi-column columns-3">
                                        <div class="row">
                                            <div class="col-sm-3  multi-gd-img">
                                                <ul class="multi-column-dropdown">
                                                    <h6>{{ trans('common.title-submenu') }}</h6>
                                                    @foreach ($menu->subCategory as $subCategory)
                                                        <li><a href="#">{{ $subCategory->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        @if (auth()->check())
                            <li><a href="{{ action('Member\SuggestProductController@index') }}">{{ trans('member.title-suggest') }}</a></li>
                        @endif
                    </ul>
                </div>
                </nav>
            </div>
            <div class="logo-nav-right">
                <ul class="cd-header-buttons">
                    <li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
                </ul> <!-- cd-header-buttons -->
                <div id="cd-search" class="cd-search">
                    <form action="#" method="post">
                        <input name="Search" type="search" placeholder="Search...">
                    </form>
                </div>
            </div>
            <div class="header-right2">
                <div class="cart box_1">
                    <a href="checkout.html">
                        <h3> <div class="total">
                            <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div>
                            <img src="{{ url(config('setting.path.images'), 'bag.png') }}" alt="" />
                        </h3>
                    </a>
                    <p><a href="javascript:;" class="simpleCart_empty">{{ trans('common.lbl-empty-cart') }}</a></p>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
