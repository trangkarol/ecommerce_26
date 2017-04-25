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
        <div class="single-wl3">
            <div class="container">
                <div class="single-grids">
                    <div class="col-md-9 single-grid">
                        <div clas="single-top">
                            <div class="single-left">
                                <div class="flexslider">
                                    <div class="thumb-image"> <img src="{{ $productSuggest->path_images }}" data-imagezoom="true" class="img-responsive"> </div>
                                </div>
                                <div class="women">
                                    <span>{{ trans('product.lbl-made-in') }} : {{ $productSuggest->made_in }}</span>
                                    <span>{{ trans('product.lbl-date-manufacture') }} : {{ $productSuggest->date_manufacture }}</span>
                                    <span>{{ trans('product.lbl-date-expiration') }} : {{ $productSuggest->date_expiration }}</span>
                                </div>
                                @if (!$productSuggest->is_accept)
                                    <div class="color-quality">
                                        <h6><a href="{{ action('Member\SuggestProductController@edit', $productSuggest->id) }}">{{ trans('common.button.edit') }}</a></h6>
                                    </div>
                                @endif
                            </div>
                            <div class="single-right simpleCart_shelfItem">
                                <h4>{{ $productSuggest->product_name }}</h4>
                                <p class="price item_price">{{ $productSuggest->price_format }}</p>
                                <div class="description">
                                    <p><span>{{ trans('product.lbl-description') }} : </span> {{ $productSuggest->description }}</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
@endsection
