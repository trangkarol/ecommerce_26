@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('common.title-login') }}
@endsection
<!-- css -->
@section('contentCss')
    @parent
    {{ Html::style('/member/css/login.css') }}
@endsection
<!-- banner -->
@section('banner')
@include('member.block.banner')
@endsection
<!-- content of page -->
@section('content')
    <div class="sidebar">
        @include('member.product.viewed_product')
        </div>
        <div class="content">
            <div class="cnt-main">
                <div class="login">
                <div class="form-w3agile form1">
                        <h3>{{ trans('common.title-login') }} {{ trans('common.lbl-or') }} <a href="{{ action('Auth\RegisterController@index') }}">{{ trans('common.title-register') }}</h3>
                            <div class="col-md-offset-3 omb_socialButtons">
                                <div class="col-xs-4 col-sm-2">
                                    <a href="{{ action('Auth\SocialiteController@redirectToProvider', 'facebook') }}" class="btn btn-lg btn-block omb_btn-facebook">
                                        <i class="fa fa-facebook visible-xs"></i>
                                        <span class="hidden-xs"><i class="fa fa-facebook-square" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                                <div class="col-xs-4 col-sm-2">
                                    <a href="#" class="btn btn-lg btn-block omb_btn-twitter">
                                        <i class="fa fa-twitter visible-xs"></i>
                                        <span class="hidden-xs"><i class="fa fa-twitter-square" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                                <div class="col-xs-4 col-sm-2">
                                    <a href="{{ action('Auth\SocialiteController@redirectToProvider', 'google') }}" class="btn btn-lg btn-block omb_btn-google">
                                        <i class="fa fa-google-plus visible-xs"></i>
                                        <span class="hidden-xs"><i class="fa fa-google-plus" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                            </div>
                            {!! Form::open(['action' => 'Auth\LoginController@login', 'method' => 'POST', 'class' => 'omb_loginForm']) !!}

                            <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6 col-md-offset-3">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                {{ Form::text('email', old('email'), ['id' => 'email', 'required', 'placeholder' => 'someone@gmail.com', 'class' => 'form-control']) }}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <div class="clearfix"></div>
                            </div>

                            <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6 col-md-offset-3" >
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                {{ Form::password('password', ['id' => 'password', 'required', 'placeholder' => '****************', 'class' => 'form-control']) }}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <div class="clearfix"></div>
                            </div>

                            <div class="col-md-4 col-md-offset-4">
                                {{ Form::submit(trans('common.button.login'), ['class' => 'btn btn-success btn-block btn-large']) }}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>

            </div>
        </div>
    <div class="clear"></div>
@endsection
<!-- js used for page -->
@section('contentJs')
    @parent
    {{ Html::script('//apis.google.com/js/platform.js') }}
@endsection
