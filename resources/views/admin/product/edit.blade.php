@extends('admin.block.master')
<!-- title off page -->
@section('title')
    {{ trans('product.title-update') }}
@endsection
<!-- css used for page -->
<!-- content of page -->
@section('content')
     <div class="">
        <!-- title -->
        <div class="page-title">
            <div class="title_left">
                <h3>{{ trans('product.title-product') }}</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                    <div class="col-md-4">
                       <a href="{{ action('Admin\ProductController@index') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('tooltip.list') }}" ><i class="fa fa-list " ></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end title -->
        <div class="clearfix"></div>
        @include('admin.block.messages')
        <!-- form search -->
        <div class="row">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2> {{ trans('product.title-edit') }} </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                <div class="clearfix"></div>
                            </div>
                            {!! Form::open(['action' => ['Admin\ProductController@update', $product->id], 'method' => 'PATCH', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                                {{ Form::hidden('id', isset($product->id) ? $product->id : null, ['id' => 'id']) }}
                                @include('admin.product.form_product')
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-7">
                                        <div class="col-md-3">
                                            {{ Form::reset(trans('common.button.reset'), ['class' => 'btn btn-success']) }}
                                        </div>
                                        <div class="col-md-3">
                                            {{ Form::submit(trans('common.button.edit'), ['class' => 'btn btn-success']) }}
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- js used for page -->
@section('contentJs')
    @parent
    {{ Html::script('/admin/js/product.js') }}
    <!-- add trans and action used in file user.js -->
    <script type="text/javascript">
        var action = {
            'product_sub_category': "{{ action('Admin\ProductController@getSubCategory') }}",
        };
    </script>
@endsection

