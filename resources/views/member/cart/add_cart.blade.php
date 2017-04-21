@if (!in_array($product->id, $productIdCats))
    {{ Form::hidden('productId', $product->id, ['class' => 'cart-product']) }}
    <a href="javascript:void(0)" data-text="{{ trans('common.lbl-add-cart') }}" class="my-cart-b add-cart">{{ trans('common.lbl-add-cart') }}</a>
    {{ Form::number('number', config('setting.default_cart'), ['class' => 'number-product form-group col-md-3']) }}
@endif
