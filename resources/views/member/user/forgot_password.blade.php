@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-forgot-password') }}
@endsection
<!-- banner -->
@section('banner')
    @include('member.block.banner')
@endsection
<!-- content of page -->
@section('content')
    <div class="login">
        <div class="main-agileits">
            @include('admin.block.messages')
            <div class="form-w3agile form1">
                <h3>{{ trans('member.title-forgot-password') }}</h3>
                 {!! Form::open(['action' => 'Auth\ForgotPasswordController@forgotPassword', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::label('email', trans('user.lbl-email'), ['class' => 'col-md-12 control-label']) }}
                        <div class="col-md-12">
                            {{ Form::email('email', old('email'), ['id' => 'email', 'required', 'class' => 'form-control']) }}
                        </div>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            {{ Form::reset(trans('common.button.reset'), ['class' => 'btn btn-success']) }}
                        </div>
                        <div class="col-md-3">
                            {{ Form::submit(trans('common.button.agree'), ['class' => 'btn btn-success']) }}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
