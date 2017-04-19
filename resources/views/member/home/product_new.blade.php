<div class="container">
    <h2 class="tittle">{{ trans('member.title-new-product') }}</h2>
    <div class="arrivals-grids">
        @foreach ($productNews as $product)
            <div class="col-md-3 arrival-grid simpleCart_shelfItem">
                <div class="grid-arr">
                    <div  class="grid-arrival">
                        <figure>
                            <a href="#" class="new-gri" data-toggle="modal" data-target="#myModal1">
                                <div class="grid-img">
                                    <img  src="{{ $product->path_image }}" class="img-responsive" alt="">
                                </div>
                            </a>
                        </figure>
                    </div>
                    <div class="ribben2">
                        <p>{{ trans('common.lbl-new') }}</p>
                    </div>
                    <div class="block">
                        <div class="starbox small ghosting"> </div>
                    </div>
                    <div class="women">
                        <h6><a href="single.html">{{ $product->name }}</a></h6>
                        <span class="size">{{ $product->made_in }}</span>
                        <p ><em class="item_price">{{ $product->price }}</em> <strong>{{ trans('common.lbl-vnd') }}</strong></p>
                        <a href="#" data-text="{{ trans('common.lbl-add-cart') }}" class="my-cart-b item_add">{{ trans('common.lbl-add-cart') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="clearfix"></div>
    </div>
</div>
