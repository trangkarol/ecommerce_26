@foreach ($products as $product)
    <div class="col-md-4 arrival-grid simpleCart_shelfItem">
        <div class="grid-arr">
            <div  class="grid-arrival">
                <figure>
                    <a href="{{ action('Member\ProductController@show', $product->id) }}" class="new-gri" data-toggle="modal" data-target="#myModal1">
                        <div class="grid-img">
                            <img  src="{{ $product->path_image }}" class="img-responsive img-product" alt="">
                        </div>
                    </a>
                </figure>
            </div>
            @include('member.product.rating')
            <div class="women">
                <h6><a href="{{ action('Member\ProductController@show', $product->id) }}">{{ $product->name }}</a></h6>
                <span class="size">{{ $product->made_in }}</span>
                <p ><em class="item_price">{{ $product->price_format }}</em></p>
            </div>
            @include('member.cart.add_cart')
        </div>
    </div>
@endforeach
<div class="clearfix"> </div>
@if (isset($products))
    {{ $products->links() }}
@endif
