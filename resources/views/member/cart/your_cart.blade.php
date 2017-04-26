<li class="cart box_1 {{ Session::has('yourCart') ? 'show-cart-detail' :  '' }}" id="div-your-cart">
    <a href="{{ action('Member\OrderController@index') }}" class="lbl-cart">
        <h3> <div class="total">
            <span class="">{{ Session::has('yourCart') ? number_format($productCats->sum('total_price'), 3, ',', ',') . ' ' . trans('common.lbl-vnd') : 0 }}</span> (<span id="" class="">{{ Session::has('yourCart') ? $productCats->sum('number_order') : 0 }}</span> items)</div>
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        </h3>
    </a>
    <div class="clearfix"> </div>
    <div class="yourCart">
        @if (Session::has('yourCart'))
            <ul>
                @foreach ($productCats as $product)
                    <li>
                        <a href="{{ action('Member\ProductController@show', $product->id) }}">{{ $product->name }}</a>
                        <span class="your-cart-price">{{ $product->number_order }}</span>
                        <span class="your-cart-price">{{ number_format($product->total_price, 3, ',', ',') . ' ' . trans('common.lbl-vnd') }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{ action('Member\OrderController@index') }}">{{ trans('common.lbl-detail') }}</a>
    </div>
</li>
