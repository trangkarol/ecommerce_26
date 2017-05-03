<li class="sub-comment wirte-comment">
    <div class="comment-main-level">
        <!-- Avatar -->
        <div class="comment-avatar"><img src="{{ Auth::check() ? Auth::user()->path_avatar : url(config('setting.path.show'), config('setting.images.avatar')) }}" alt=""></div>
        <!-- Contenedor del Comentario -->
        <div class="comment-box">
            {{ Form::hidden('parent_id', isset($parentId) ? $parentId : 0, ['class' => 'parentId']) }}
            <div class="comment-head">
                <h6 class="comment-name"><a href="#">{{ Auth::check() ? Auth::user()->name : trans('comment.lbl-requirment') }}</a></h6>
                <span>{{ date('Y/m/d H:i') }}</span>
                @if (isset($subCategory)) <i class="fa fa-window-close close-box" aria-hidden="true"></i> @endif
            </div>
            <div class="comment-content">
                {{ Form::textarea('content', null, ['class' => 'form-control content-comment', 'placeholder' => trans('comment.lbl-wirte-comment')]) }}
            </div>
            <div class="col-md-offset-8">
                @php $idButton = ''; @endphp
                @if (!Auth::check())
                    @php $idButton = 'message'; @endphp
                @endif
                {{ Form::button('Post', ['type' => 'button', 'class' => 'btn btn-success post-comment', 'id' => $idButton]) }}
            </div>
        </div>
    </div>
</li>
