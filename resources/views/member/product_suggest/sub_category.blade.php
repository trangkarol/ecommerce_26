{{ Form::label('sub_category_id', trans('product.lbl-subcatelory'), ['class' => 'col-md-4 control-label']) }}
<div class="col-md-8">
    {{ Form::select('sub_category_id', isset($subCategory) ? $subCategory : config('setting.defaul_select'), isset($subId) ? $subId : old('subCategory'), ['class' => 'form-control', 'id' => 'subCategory']) }}
</div>
