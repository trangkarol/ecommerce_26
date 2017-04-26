<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('product_name', trans('product.lbl-name'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
        {{ Form::text('name', isset($productSuggest->product_name) ? $productSuggest->product_name : old('name'), ['class' => 'form-control', 'id' => 'product_name', 'required' => true, 'autofocus' => true]) }}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group">
    {{ Form::label('position', trans('product.lbl-images'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
       {{ Form::file('file', ['id' => 'images']) }}
        <div class="col-md-6">
            <img src="{{ isset($productSuggest->images)? $productSuggest->path_images : url(config('setting.path.show'), config('setting.images.product')) }}" width="200px" height="150px">
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    {{ Form::label('price', trans('product.lbl-price'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
        {{ Form::number('price', isset($productSuggest->price) ? $productSuggest->price : old('price'), ['class' => 'form-control', 'id' => 'price', 'required' => true]) }}

        @if ($errors->has('price'))
            <span class="help-block">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
        @endif
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group {{ $errors->has('number_current') ? 'has-error' : '' }}">
    {{ Form::label('number_current', trans('product.lbl-number'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
        {{ Form::number('number_current', isset($productSuggest->number_current) ? $productSuggest->number_current : old('number_current'), ['class' => 'form-control', 'id' => 'number_current', 'required' => true]) }}

        @if ($errors->has('number_current'))
            <span class="help-block">
                <strong>{{ $errors->first('number_current') }}</strong>
            </span>
        @endif
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group {{ $errors->has('made_in') ? 'has-error' : '' }}">
    {{ Form::label('made_in', trans('product.lbl-made-in'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
        {{ Form::select('made_in', $madeIn, isset($productSuggest->made_in) ? $productSuggest->made_in : old('made_in'), ['class' => 'form-control', 'id' => 'made_in']) }}
        @if ($errors->has('made_in'))
            <span class="help-block">
                <strong>{{ $errors->first('made_in') }}</strong>
            </span>
        @endif
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group old-category">
    {{ Form::label('category', trans('product.lbl-category'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
        {{ Form::hidden('sub_id', isset($productSuggest->sub_category_id) ? $productSuggest->sub_category_id : 0, ['id' => 'sub_id']) }}
        {{ Form::select('category_id', $parentCategory, isset($productSuggest->category_id) ? $productSuggest->category_id : old('sub_category_id'), ['class' => 'form-control', 'id' => 'category']) }}
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group old-category" id="sub-category">

</div>

<div class="form-group">
    <p class="col-md-12">
        <a href="javascript:void(0)" id="{{ isset($productSuggest->category_name) ? 'new-category' : 'old-category' }}">{{ trans('product.lbl-new-category') }}</a>
    </p>
    <div class="clearfix"></div>
</div>
<!-- new category -->
<div class="form-group div-category {{ isset($productSuggest->category_name) ? '' : ' div-category-new' }}">
    {{ Form::label('category_name', trans('product.lbl-new-parent-category'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
        {{ Form::text('category_name', isset($productSuggest->category_name) ? $productSuggest->category_name : old('category_name'), ['class' => 'form-control', 'id' => 'category_name']) }}
    </div>
    <div class="clearfix"></div>
</div>
<!-- new sub category -->
<div class="form-group div-category {{ isset($productSuggest->sub_category_new) ? '' : ' div-category-new'  }}">
    {{ Form::label('sub_category_new', trans('product.lbl-new-sub-category'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
        {{ Form::text('sub_category_name', isset($productSuggest->sub_category_name) ? $productSuggest->sub_category_name : old('sub_category_name'), ['class' => 'form-control', 'id' => 'sub_category_name']) }}
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group {{ $errors->has('date_manufacture') ? 'has-error' : '' }}">
    {{ Form::label('date_manufacture', trans('product.lbl-date-manufacture'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
        {{ Form::date('date_manufacture', isset($productSuggest->date_manufacture) ? $productSuggest->date_manufacture : old('date_manufacture'), ['class' => 'form-control', 'id' => 'date_manufacture', 'required' => true]) }}

        @if ($errors->has('date_manufacture'))
            <span class="help-block">
                <strong>{{ $errors->first('date_manufacture') }}</strong>
            </span>
        @endif
    </div>

    <div class="clearfix"></div>
</div>

<div class="form-group {{ $errors->has('date_expiration') ? 'has-error' : '' }}">
    {{ Form::label('date_expiration', trans('product.lbl-date-expiration'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
        {{ Form::date('date_expiration', isset($productSuggest->date_expiration) ? $productSuggest->date_expiration : old('date_expiration'), ['class' => 'form-control', 'id' => 'date_expiration', 'required' => true]) }}

        @if ($errors->has('date_expiration'))
            <span class="help-block">
                <strong>{{ $errors->first('date_expiration') }}</strong>
            </span>
        @endif
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {{ Form::label('description', trans('product.lbl-description'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-8">
        {{ Form::textarea('description', isset($productSuggest->description) ? $productSuggest->description : null, ['class' => 'form-control']) }}
        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
    <div class="clearfix"></div>
</div>
