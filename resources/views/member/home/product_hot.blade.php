<div class="container">
    <h2 class="tittle">{{ trans('member.title-hot-product') }}</h2>
    <div class="arrivals-grids">
        @foreach ($product_hots as $product)
            <div class="col-md-3 arrival-grid simpleCart_shelfItem">
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
                    <div class="ribben1">
                        <p>{{ trans('common.lbl-hot') }}</p>
                    </div>
                    <div class="block">
                        <div class="small ghosting"> <span class="stars">{{ $product->avg_rating }}</span> </div>
                    </div>
                    <div class="women">
                        <h6><a href="{{ action('Member\ProductController@show', $product->id) }}">{{ $product->name }}</a></h6>
                        <span class="size">{{ $product->made_in }}</span>
                        <p ><em class="item_price">{{ $product->price_format }}</em></p>
                    </div>
                    @include('member.cart.add_cart')
                </div>
            </div>
        @endforeach
        <div class="clearfix"></div>
    </div>
</div>
