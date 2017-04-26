@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('common.title-register') }}
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
            @include('admin.block.messages')
            <div class="cnt-main">
                <div class="form-w3agile form1">
                    <h3>{{ trans('common.title-register') }}</h3>
                    {!! Form::open(['action' => 'Auth\RegisterController@register', 'enctype' => 'multipart/form-data']) !!}

                        @include('member.user.form_user')
                        <div class="form-group col-md-offset-8" >
                            <div class="col-md-3">
                                {{ Form::reset(trans('common.button.reset'), ['class' => 'btn btn-success']) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::submit(trans('common.button.insert'), ['class' => 'btn btn-success']) }}
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    <div class="clear"></div>
@endsection
