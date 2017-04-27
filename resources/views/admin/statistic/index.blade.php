@extends('admin.block.master')
<!-- title off page -->
@section('title')
    {{ trans('order.title-order') }}
@endsection
<!-- css used for page -->
<!-- content of page -->
@section('content')
    <div class="">
        <!-- title -->
        <div class="page-title">
            <div class="title_left">
                <h3>{{ trans('static.title-static') }}</h3>
                <div class="col-md-4">
                    <a href="#" class="btn btn-primary" id= "export-file" data-toggle="tooltip" data-placement="top" title="Export file"><i class="glyphicon glyphicon-export" ></i></a>
                    {!! Form::open(['action' => 'Admin\StatisticController@exportFile', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form-export']) !!}
                    {!! Form::close() !!}
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
                                <h2>{{ trans('static.title-satistic-category') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                           </div>
                            <div class="x_content">
                                <h2>Static category of website</h2>
                                <div class="col-md-6 col-md-offset-3">
                                    <div id="chart-statistic" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>{{ trans('static.title-satistic-product') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                           </div>
                            <div class="x_content">
                                <div class="col-md-12">
                                    <div id="statistic-product" style="height: 400px"></div>
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
    {{ Html::script('/admin/js/statistic.js') }}
    <script type="text/javascript">
        var data = {
            'category': {!! json_encode($category) !!},
        };
    </script>
@endsection
