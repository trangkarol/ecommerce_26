{{ Form::label('category', trans('product.lbl-subcatelory'), ['class' => 'col-md-4 control-label']) }}
<div class="col-md-6">
    {{ Form::select('subCategory', isset($subCategory) ? $subCategory : config('setting.defaul_select'), isset($sub_id) ? $sub_id : old('subCategory'), ['class' => 'form-control', 'id' => 'subCategory']) }}
</div>
