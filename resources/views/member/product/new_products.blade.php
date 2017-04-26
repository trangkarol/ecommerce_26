<h3>{{ trans('member.title-new-product') }}</h3>
@foreach ($new_products as $product)
    <div class="recent-grids">
        <div class="recent-left">
            <a href="{{ action('Member\ProductController@show', $product->id) }}"><img class="img-responsive" src="{{ $product->path_image }}" alt=""></a>
        </div>
        <div class="recent-right">
            <h6 class="best2"><a href="{{ action('Member\ProductController@show', $product->id) }}">{{ $product->name }} </a></h6>
            @include('member.product.rating')
            <span class=" price-in1">{{ $product->price_format }}</span>
        </div>
        <div class="clearfix"> </div>
    </div>
@endforeach
