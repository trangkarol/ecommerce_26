 <div class="x_content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{ trans('common.lbl-search') }} </h2>
                    <div class="clearfix"></div>
                </div>
                {!! Form::open(['action' => 'Admin\ProductController@search', 'class' => 'form-horizontal form-label-left', 'id' => 'order-search']) !!}
                <div class="form-group col-md-6">
                    {{ Form::label('price', trans('product.lbl-date'), ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-8">
                        <div class="col-md-6">
                            {{ Form::date('date_from', null, ['class' => 'form-control', 'id' => 'date_from']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::date('date_to', null, ['class' => 'form-control', 'id' => 'date_to']) }}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('price', trans('product.lbl-price'), ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-8">
                        <div class="col-md-6">
                            {{ Form::number('price_from', old('price_from'), ['class' => 'form-control', 'id' => 'price_from']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::number('price_to', old('price_to'), ['class' => 'form-control', 'id' => 'price_to']) }}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('status', trans('order.lbl-status'), ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-8">
                        {{ Form::select('status', $status, null, ['class' => 'form-control', 'id' => 'status']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-10">
                        <button type="button" class="btn btn-success" id="btn-search">{{ trans('common.button.search') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
