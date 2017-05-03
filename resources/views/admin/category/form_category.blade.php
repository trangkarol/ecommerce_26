<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('name', trans('category.lbl-name'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::text('name', isset($category->name) ? $category->name : old('name'), ['class' => 'form-control', 'id' => 'name', 'required' => true, 'autofocus' => true]) }}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('type_category') ? 'has-error' : '' }}">
    {{ Form::label('type_category', trans('category.lbl-type-category'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::select('type_category', $typeCategory, isset($category->type_category) ? $category->type_category : old('type_category'), ['class' => 'form-control', 'id' => 'type_category']) }}

        @if ($errors->has('type_category'))
            <span class="help-block">
                <strong>{{ $errors->first('type_category') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group @if (isset($category)) {{ $category->type_category == 0 ? 'div-parent-category' : '' }} @endif ">
    {{ Form::label('category', trans('category.lbl-category'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::select('category', $parentCategory, isset($product->category->parent_id) ? $product->category->parent_id : old('category'), ['class' => 'form-control', 'id' => 'category']) }}
    </div>
</div>
