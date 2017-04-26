@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-update-suggest') }}
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
                <h3>{{ trans('member.title-update-suggest') }}</h3>
                    {!! Form::open(['action' => ['Member\SuggestProductController@update', $productSuggest->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

                    @include('member.product_suggest.form_product_suggest')
                    <div class="form-group col-md-offset-8" >
                        <div class="col-md-3">
                            {{ Form::reset(trans('common.button.reset'), ['class' => 'btn btn-success']) }}
                        </div>
                        <div class="col-md-3">
                            {{ Form::submit(trans('common.button.edit'), ['class' => 'btn btn-success']) }}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="clear"></div>
@endsection
<!-- js used for page -->
@section('contentJs')
    @parent
    {{ Html::script('/member/js/suggest_product.js') }}
    <!-- add trans and action used in file user.js -->
    <script type="text/javascript">
        var trans = {
            'new_category': "{{ trans('product.lbl-new-category') }}",
            'old_category': "{{ trans('product.lbl-old-category') }}",
            'choose_category': "{{ trans('product.lbl-choose-category') }}",
        };

        var action = {
            'product_sub_category': "{{ action('Member\SuggestProductController@getCategory') }}",
        };
    </script>
@endsection
