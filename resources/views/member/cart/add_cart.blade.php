@if (!in_array($product->id, $productIdCats))
    {{ Form::hidden('productId', $product->id, ['class' => 'cart-product']) }}
    <a href="javascript:void(0)" data-text="{{ trans('common.lbl-add-cart') }}" class="my-cart-b add-cart col-md-6">{{ trans('common.lbl-add-cart') }}</a>
    <div class="input-group number-cart col-md-6">
        <span class="input-group-btn">
            <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="number-product">
                <span class="glyphicon glyphicon-minus"></span>
            </button>
        </span>
        <input type="text" name="number-product" class="form-control input-number" value="1" min="1" max="100" text-align="center">
        <span class="input-group-btn">
            <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="number-product">
                <span class="glyphicon glyphicon-plus"></span>
            </button>
        </span>
    </div>
@endif
