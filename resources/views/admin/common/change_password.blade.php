@extends('admin.block.master')
<!-- title off page -->
@section('title')
    {{ trans('common.lbl-change-pass-word') }}
@endsection
<!-- content of page -->
@section('content')
    <div class="">
        <div class="row">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>{{ trans('common.lbl-change-pass-word') }}</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                <div class="clearfix"></div>
                            </div>
                            {!! Form::open(['action' => 'Auth\ResetPasswordController@changePassword', 'class' => 'form-horizontal']) !!}
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    {{ Form::label('password', trans('user.lbl-password'), ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::password('password', ['class' => 'form-control',  'id' => 'password', 'required']) }}
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    {{ Form::label('password_confirmation', trans('user.lbl-comfirm_password'), ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::password('password_confirmation', ['class' => 'form-control',  'id' => 'password_confirmation', 'required']) }}

                                        @if ($errors->has('comfirm_password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2 col-md-offset-5">
                                        {{ Form::submit(trans('common.button.change'), ['class' => 'btn btn-primary']) }}
                                    </div>
                                </div>
                            {{ Form::close() }}
                            <!-- messages -->
                            @include('admin.block.messages')
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
@endsection
