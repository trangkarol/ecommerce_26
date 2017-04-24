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
                    <div class="col-md-6 col-sm-6 col-xs-12">
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
                            <canvas id="chart-statistic"></canvas>
                          </div>
                        </div>
                    </div>
                    <script type="text/javascript">

                    </script>
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
            'nameCategory': {!! json_encode($nameCategory) !!},
            'totalPrice': {!! json_encode($totalPrice) !!},
        };
    </script>
@endsection
