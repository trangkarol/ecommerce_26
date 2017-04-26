@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-detail-suggest') }}
@endsection
<!-- banner -->
@section('banner')
    @include('member.block.banner')
@endsection
<!-- content of page -->
@section('content')
<div class="sidebar">
    @include('member.product.viewed_product')
</div>
<div class="content">
    <div class="cnt-main">
        <div class="s_hdr">
               <h2>{{ trans('member.lbl-your-cart') }} (<span id="total-number-cart">{{ Session::has('yourCart') ? $productCats->sum('number_order') : 0 }}</span>)</h2>
            </div>
        <div class="single-wl3">
            <div class="text1-nav">
                @if (!is_null($productCats))
                    @foreach ($productCats as $product)
                        <div class="cart-detail cart-header">
                            {{ Form::hidden('productId', isset($product->id) ? $product->id : 0, ['class' => 'cart-product']) }}
                            <div class="close1"> </div>
                            <div class="cart-sec simpleCart_shelfItem">
                                <div class="cart-item cyc">
                                    <img src="{{ $product->path_image }}" class="img-responsive" alt="">
                                </div>
                                <div class="cart-item-info">
                                    <h3><a href="{{ action('Member\ProductController@show', $product->id) }}">{{ $product->name }}</a></h3>
                                    <div class="delivery">
                                        <p>{{ trans('product.lbl-price') }} : {{ $product->price_format }}</p>
                                        <div class="clearfix"></div>
                                        <p>{{ trans('product.lbl-made-in') }} : {{ $product->made_in }}</p>
                                        <div class="clearfix"></div>
                                        <p>{{ trans('product.lbl-number') }} : {{ $product->number_order }}</p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if (Session::has('yourCart'))
                    <div class="row">
                        {{ Form::open(['action' => 'Member\OrderController@store', 'class' => 'form-order']) }}
                            {!! Form::button(trans('common.button.order'), ['class' => 'btn btn-success col-md-offset-8', 'id' => Auth::check() ? 'order' : 'message', 'type' => 'button']) !!}
                        {{ Form::close() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
     <div class="clear"></div>
</div>
 <div class="clear"></div>
 <div class="cnt-main">
    <div class="s_hdr">
        <h2>{{ trans('member.lbl-order') }}</h2>
    </div>
    <div class="text1-nav">
        <div class="table-responsive">
            @include('member.cart.your_order')
        </div>
    </div>
 </div>
@endsection
