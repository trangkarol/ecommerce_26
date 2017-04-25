<div class="cnt-main div-search">
    <div class="x_content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> {{ trans('common.lbl-search') }} </h2>
                        <div class="clearfix"></div>
                    </div>
                   {!! Form::open(['action' => 'Admin\ProductController@search', 'class' => 'form-horizontal form-label-left', 'id' => 'product-search']) !!}
                    <div class="form-group col-md-6">
                        {{ Form::label('name', trans('product.lbl-name'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('sort_price', trans('product.lbl-sort-price'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::select('sort_price', $sortPrice, old('sort_price'), ['class' => 'form-control', 'id' => 'sort_price']) }}
                        </div>
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
                        {{ Form::label('rating', trans('product.lbl-rating'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::select('rating', $ratings, old('rating'), ['class' => 'form-control', 'id' => 'rating']) }}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('category', trans('product.lbl-category'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::hidden('sub_id', isset($product->category_id) ? $product->category_id : 0, ['id' => 'sub_id']) }}
                            {{ Form::select('parentCategory_id', $parentCategory, isset($product->category->parent_id) ? $product->category->parent_id : old('parentCategory_id'), ['class' => 'form-control search', 'id' => 'category']) }}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group col-md-6" id="sub-category">

                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('sort_product', trans('product.lbl-sort_product'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::select('sort_product', $sortProduct, old('made_in'), ['class' => 'form-control', 'id' => 'sort_product']) }}
                        </div>
                        <div class="clearfix"></div>
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
</div>
