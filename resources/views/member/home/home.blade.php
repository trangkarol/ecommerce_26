@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-home') }}
@endsection
<!-- banner -->
@section('banner')
    @include('member.block.banner_slider')
@endsection
<!-- content of page -->
@section('content')
    <!-- hot product -->
    <div class="cnt-main">
        @include('member.home.product_hot')
    </div>
    <!-- product new-->
    <div class="cnt-main">
        @include('member.home.product_new')
    </div>
    <!-- product -->
@endsection
