<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#comment-facebook">{{ trans('comment.lbl-comment-facebook') }}</a></li>
    <li><a data-toggle="tab" href="#comment">{{ trans('comment.lbl-comment') }}</a></li>
</ul>

<div class="tab-content">
    <div id="comment-facebook" class="tab-pane fade in active">
        <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#{{ action('Member\ProductController@show', $product->id) }}" data-numposts="5"></div>
    </div>
    <div id="comment" class="tab-pane fade">
        @include('member.comment.comment')
    </div>
</div>
