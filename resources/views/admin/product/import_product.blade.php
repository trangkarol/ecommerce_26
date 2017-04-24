@extends('admin.block.master')
<!-- title off page -->
@section('title')
    {{ trans('product.title-import-file') }}
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
                       <a href="#" class="btn btn-primary" id="save-file"><i class="fa fa-plus " ></i></a>
                        {{ Form::open(['action' => 'Admin\ProductController@saveFile', 'id' => 'form-save']) }}
                            {{ Form::hidden('nameFile',$nameFile) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- end title -->
        <div class="clearfix"></div>
        <!-- form search -->
        <div class="row">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2> {{ trans('product.lbl-data-import') }} </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                    <div class="table-responsive" id ="result-users">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('common.lbl-stt') }}</th>
                                                <th>{{ trans('product.lbl-name') }}</th>
                                                <th>{{ trans('product.lbl-price') }}</th>
                                                <th>{{ trans('product.lbl-description') }}</th>
                                                <th>{{ trans('product.lbl-made-in') }}</th>
                                                <th>{{ trans('product.lbl-date-manufacture') }}</th>
                                                <th>{{ trans('product.lbl-date-expiration') }}</th>
                                                <th>{{ trans('product.lbl-category') }}</th>
                                                <th>{{ trans('product.lbl-sub-name') }}</th>
                                                <th>{{ trans('product.lbl-number') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($products))
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>{{ $product->description }}</td>
                                                        <td>{{ $product->made_in }}</td>
                                                        <td>{{ $product->date_manufacture }}</td>
                                                        <td>{{ $product->date_expiration }}</td>
                                                        <td>{{ $product->category_name }}</td>
                                                        <td>{{ $product->subcategory_name }}</td>
                                                        <td>{{ $product->number }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
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
    {{ Html::script('/admin/js/user.js') }}
@endsection
