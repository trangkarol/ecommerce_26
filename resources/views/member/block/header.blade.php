<div class="logo">
    <a href="index.html"><img src="{{ url(config('setting.path.images'), 'logo.png') }}" alt=""> </a>
</div>
<div class="header-left">
    <div class="contact-info">
        <ul>
            <li>{{ trans('common.lbl-help') }}</li>
            <li>{{ trans('common.lbl-sdt') }}</li>
        </ul>
    </div>
    <div class="menu">
        <ul class="nav">
            <li class="@if (Request::url() == action('Member\HomeController@index')) active @endif "><a href="{{ action('Member\HomeController@index') }}" title="{{ trans('common.title-home') }}">{{ trans('common.title-home') }}</a></li>
            <li class="@if (Request::url() == action('Member\ProductController@index')) active @endif "><a href="{{ action('Member\ProductController@index') }}">{{ trans('common.title-shop-online') }}</a></li>
            @if (Auth::guard()->check())
                <li class="@if (Request::url() == action('Member\SuggestProductController@index')) active @endif "><a href="{{ action('Member\HomeController@index') }}"><a href="{{ action('Member\SuggestProductController@index') }}">{{ trans('member.title-suggest') }}</a></li>
                <li><a href="{{ action('Auth\RegisterController@getUpdate', Auth::user()->id) }}">{{ Auth::user()->name }}</a></li>
                <li><a href="#"><img src="{{ Auth::user()->path_avatar }}" width="70px" height="50px"></a></li>
                <li>
                    <a href="{{ action('Auth\LoginController@logout') }}" id="btn-logout">
                        <i class="fa fa-sign-out pull-right"></i> {{ trans('common.title-logout') }}
                    </a>
                    {!! Form::open(['action' => 'Auth\LoginController@logout', 'class' => 'form-horizontal', 'id' => 'logout-form']) !!}
                    {{ Form::close() }}
                </li>
            @else
                <li><a href="{{ action('Auth\LoginController@index') }}">{{ trans('common.title-login') }}</a></li>
                <li><a href="{{ action('Auth\RegisterController@index') }}" id="resgiter">{{ trans('common.title-register') }}</a></li>
            @endif
            @include('member.cart.your_cart')
            <div class="clear"></div>
        </ul>
    </div>
</div>
<div class="clear"></div>
