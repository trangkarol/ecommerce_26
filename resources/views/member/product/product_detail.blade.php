@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('product.title-detail-product') }}
@endsection
<!-- banner -->
@section('banner')
    @include('member.block.banner')
@endsection
<!-- content of page -->
@section('content')
<div class="sidebar">
    @include('member.product.related_product')
    @include('member.product.viewed_product')
</div>
<div class="content">
    <div class="cnt-main">
            <div class="single-wl3">
                    <div class="single-grids">
                        <div class="col-md-12 single-grid">
                            <div clas="single-top">
                                <div class="single-left">
                                    {{ Form::hidden('productId', $product->id,['class' => 'btn btn-success btn-agree', 'id' => 'productId', 'type' => 'button']) }}
                                    <div class="flexslider">
                                        <div class="thumb-image"> <img src="{{ $product->path_image }}" data-imagezoom="true" class="img-responsive"> </div>
                                    </div>
                                    <div class="women">
                                        <span>{{ trans('product.lbl-made-in') }} : <strong>{{ $product->made_in }}</strong></span>
                                        <span>{{ trans('product.lbl-number') }} : <strong>{{ $product->number_current }}</strong></span>
                                        <span>{{ trans('product.lbl-date-manufacture') }} : <strong>{{ $product->date_manufacture }}</strong></span>
                                        <span>{{ trans('product.lbl-date-expiration') }} : <strong>{{ $product->date_expiration }}</strong></span>
                                    </div>
                                    @include('member.cart.add_cart')
                                    <div class="description">
                                        <p>
                                            <span>{{ trans('product.lbl-rating') }}</span>
                                        </p>
                                        <input id="input-1" name="input-1" value="" class="rating point" data-min="0" data-max="5" data-step="0.5" data-show-clear="true" data-show-caption="false">
                                    </div>
                                    <div class="input-group col-md-6">
                                        {!! Form::button(trans('common.button.agree'), ['class' => 'btn btn-success', 'id' => Auth::check() ? 'btn-agree' : 'message', 'type' => 'button']) !!}
                                    </div>
                                </div>
                                <div class="single-right simpleCart_shelfItem div-point">
                                    <h4>{{ $product->name }}</h4>
                                    @include('member.product.rating')
                                    <div class="clearfix"> </div>
                                    <p class="price item_price">{{ $product->price_format }}</p>
                                    <div class="description">
                                        <p><span>{{ trans('product.lbl-description') }} : </span> {{ $product->description }}</p>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <!-- like,share -->
                            <div class="fb-like" data-share="true" data-width="450" data-show-faces="true">
                            </div>
                            <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#{{ action('Member\ProductController@show', $product->id) }}" data-numposts="5"></div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="clear"></div>
@endsection
<!-- js used for page -->
@section('contentJs')
    @parent
    <script type="text/javascript">
        var trans = {
            'confirm_rating': "{{ trans('common.msg.confirm-rating') }}",
            'msg_login': "{{ trans('common.msg.not-login') }}",
        };
    </script>
@endsection
