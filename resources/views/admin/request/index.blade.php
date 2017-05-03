@extends('admin.block.master')
<!-- title off page -->
@section('title')
    {{ trans('product.title-request') }}
@endsection
<!-- css used for page -->
<!-- content of page -->
@section('content')
    <div class="">
        <!-- title -->
        <div class="page-title">
            <div class="title_left">
                <h3>{{ trans('product.title-request') }}</h3>
            </div>
        </div>
        <!-- end title -->
        <div class="clearfix"></div>
        @include('admin.block.messages')
        <!-- form search -->
        <div class="row">
            @include('admin.request.search')
        </div>
        <div class="row">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2> {{ trans('product.lbl-list-request') }} </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content" id="result-requests">
                                <div class="table-responsive">
                                    @include('admin.request.table_result')
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
    {{ Html::script('/admin/js/request.js') }}
    <script type="text/javascript">
        var action = {
            'request_search': "{{ action('Admin\RequestController@search') }}",
            'cancel': "{{ action('Admin\RequestController@cancel') }}",
        };

        var trans = {
            'msg_comfirm_accpet': "{{ trans('common.msg.confirm-accept') }}",
            'msg_comfirm_cancel': "{{ trans('common.msg.confirm-cancel') }}",
            'status_cancel': "{{ trans('common.product_status.cancel') }}",
        };
    </script>
@endsection
