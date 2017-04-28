<li class="sub-comment wirte-comment">
    <div class="comment-main-level">
        <!-- Avatar -->
        <div class="comment-avatar"><img src="{{ Auth::check() ? Auth::user()->path_avatar : ''}}" alt=""></div>
        <!-- Contenedor del Comentario -->
        <div class="comment-box">
            {{ Form::hidden('parent_id', isset($parentId) ? $parentId : 0, ['class' => 'parentId']) }}
            <div class="comment-head">
                <h6 class="comment-name"><a href="#">{{ Auth::check() ? Auth::user()->name : 'You must login to comment for this product.'}}</a></h6>
                <span>{{ date('Y/m/d H:i') }}</span>
                @if (isset($subCategory)) <i class="fa fa-window-close close-box" aria-hidden="true"></i> @endif
            </div>
            <div class="comment-content">
                {{ Form::textarea('content', null, ['class' => 'form-control content-comment', 'placeholder' => 'Wirte comment.....']) }}
            </div>
            <div class="col-md-offset-8">
                @php $id = ''; @endphp
                @if (!Auth::check())
                    @php $id = 'message'; @endphp
                @endif
                {{ Form::button('Post', ['type' => 'button', 'class' => 'btn btn-success post-comment', 'id' => $id ]) }}
            </div>
        </div>
    </div>
</li>
