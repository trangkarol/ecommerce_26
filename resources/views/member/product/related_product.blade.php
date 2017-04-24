 <div class="s-main">
    <div class="s_hdr">
        <h2>{{ trans('product.lbl-related-product') }}</h2>
    </div>
    <div class="text1-nav">
        @foreach ($relatedProducts as $product)
            <div class="recent-grids">
                <div class="recent-left">
                    <a href="{{ action('Member\ProductController@show', $product->id) }}"><img class="img-responsive " src="{{ $product->path_image }}" alt=""></a>
                </div>
                <div class="recent-right">
                    <h6 class="best2"><a href="{{ action('Member\ProductController@show', $product->id) }}">{{ $product->name }} </a></h6>
                    <div class="block">
                        <div class="small ghosting"> <span class="stars">{{ $product->avg_rating }}</span> </div>
                    </div>
                    <div class="clearfix"> </div>
                    <span class=" price-in1">{{ $product->price_format }}</span>
                </div>
                <div class="clearfix"> </div>
            </div>
        @endforeach
    </div>
</div>
