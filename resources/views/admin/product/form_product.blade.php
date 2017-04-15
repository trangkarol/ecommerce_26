<div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
      {{ Form::label('name', trans('product.lbl-name'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::text('name', isset($product->name) ? $product->name : old('name'), ['class' => 'form-control', 'id' => 'name', 'required' => true, 'autofocus' => true]) }}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    {{ Form::label('position', trans('product.lbl-images'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
       {{ Form::file('file', ['id' => 'images']) }}
        <div class="col-md-6">
            <img src="{{ isset($product->image)? url(config('setting.file.show'), $product->image) : url(config('setting.file.show'), config('setting.images.product')) }}" width="200px" height="150px">
        </div>

    </div>
</div>

<div class="form-group{{ $errors->has('price') ? 'has-error' : '' }}">
    {{ Form::label('price', trans('product.lbl-price'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::number('price', isset($product->price) ? $product->price : old('price'), ['class' => 'form-control', 'id' => 'price', 'required' => true]) }}
    </div>

    @if ($errors->has('price'))
        <span class="help-block">
            <strong>{{ $errors->first('price') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('number_current') ? 'has-error' : '' }}">
    {{ Form::label('number_current', trans('product.lbl-number'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::number('number_current', isset($product->number_current) ? $product->number_current : old('number_current'), ['class' => 'form-control', 'id' => 'number_current', 'required' => true]) }}
    </div>

    @if ($errors->has('number_current'))
        <span class="help-block">
            <strong>{{ $errors->first('number_current') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('made_in') ? 'has-error' : '' }}">
    {{ Form::label('made_in', trans('product.lbl-made-in'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::select('made_in', $madeIn, isset($product->made_in) ? $product->made_in : old('made_in'), ['class' => 'form-control', 'id' => 'made_in']) }}
    </div>

    @if ($errors->has('made_in'))
        <span class="help-block">
            <strong>{{ $errors->first('made_in') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    {{ Form::label('category', trans('product.lbl-category'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::hidden('sub_id', isset($product->category_id) ? $product->category_id : 0, ['id' => 'sub_id']) }}
        {{ Form::select('category', $parentCategory, isset($product->category->parent_id) ? $product->category->parent_id : old('category'), ['class' => 'form-control', 'id' => 'category']) }}
    </div>
</div>

<div class="form-group" id="sub-category">

</div>

<div class="form-group{{ $errors->has('date_manufacture') ? 'has-error' : '' }}">
    {{ Form::label('date_manufacture', trans('product.lbl-date-manufacture'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::date('date_manufacture', isset($product->date_manufacture) ? $product->date_manufacture : old('date_manufacture'), ['class' => 'form-control', 'id' => 'date_manufacture', 'required' => true]) }}
    </div>

    @if ($errors->has('date_manufacture'))
        <span class="help-block">
            <strong>{{ $errors->first('date_manufacture') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('date_expiration') ? 'has-error' : '' }}">
    {{ Form::label('date_expiration', trans('product.lbl-date-expiration'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::date('date_expiration', isset($product->date_expiration) ? $product->date_expiration : old('date_expiration'), ['class' => 'form-control', 'id' => 'date_expiration', 'required' => true]) }}
    </div>

    @if ($errors->has('date_expiration'))
        <span class="help-block">
            <strong>{{ $errors->first('date_expiration') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
    {{ Form::label('description', trans('product.lbl-description'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::textarea('description', isset($product->description) ? $product->description : null, ['class' => 'form-control']) }}
    </div>

    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>
