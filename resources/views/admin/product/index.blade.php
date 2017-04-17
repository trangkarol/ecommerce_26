@extends('admin.block.master')
<!-- title off page -->
@section('title')
    {{ trans('product.title-product') }}
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
                        <a href="{{ action('Admin\ProductController@create') }}" data-toggle="tooltip" data-placement="top" title="{{ trans('product.tooltip.create') }}" class="btn btn-primary"><i class="fa fa-user-plus " ></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end title -->
        <div class="clearfix"></div>
        @include('admin.block.messages')
        <!-- form search -->
        <div class="row">
            @include('admin.product.search')
        </div>
        <div class="row">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2> {{ trans('common.lbl-result-search') }} </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content" id="result-users">
                                <div class="table-responsive">
                                    @include('admin.product.table_result')
                                </div>
                            </div>
                            <div class="clearfix"></div>
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

@endsection
