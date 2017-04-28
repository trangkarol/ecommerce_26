<div class="row">
    <div class="comments-container">
        <ul id="comments-list" class="comments-list">
            @include('member.comment.comment_box')
            @foreach ($product->comment as $comment)
            <li class="parent-comment">
                <div class="comment-main-level">
                    <!-- Avatar -->
                    <div class="comment-avatar"><img src="{{ $comment->user->path_avatar }}" alt=""></div>
                    <!-- Contenedor del Comentario -->
                    <div class="comment-box">
                        {{ Form::hidden('parent_id', $comment->id, ['class' => 'parentId']) }}
                        <div class="comment-head">
                            <h6 class="comment-name by-author"><a href="#">{{ $comment->user->name }}</a></h6>
                            <span>{{ $comment->created_at }}</span>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                            <i class="fa fa-reply reply-comment"></i>
                        </div>
                        <div class="comment-content">
                            {!! $comment->content !!}
                        </div>
                    </div>
                </div>
                <!-- Respuestas de los comentarios -->
                <ul class="comments-list reply-list">
                    @foreach ($comment->subComment as $subComment)
                    <li>
                        <!-- Avatar -->
                        <div class="comment-avatar"><img src="{{ $subComment->user->path_avatar }}" alt=""></div>
                        <!-- Contenedor del Comentario -->
                        <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name"><a href="#">{{ $subComment->user->name }}</a></h6>
                                <span>{{ $subComment->created_at }}</span>
                            </div>
                            <div class="comment-content">
                                {!! $subComment ->content !!}
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    </div>
</div>
