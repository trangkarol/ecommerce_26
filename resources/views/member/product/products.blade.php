@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-product-detail') }}
@endsection
<!-- banner -->
@section('banner')
    @include('member.block.banner')
@endsection
<!-- content of page -->
@section('content')
<div class="sidebar">
    @include('member.product.category')
    @include('member.product.viewed_product')
</div>
<div class="content">
    @include ('member.product.search')
    <div class="cnt-main" id="div-result-product">
        @include ('member.product.result_product')
    </div>
</div>
<div class="clear"></div>
</div>
@endsection
<!-- js used for page -->
@section('contentJs')
    @parent
    {{ Html::script('/member/js/common.js') }}
@endsection

