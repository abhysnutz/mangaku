<ul class="comments">
    @foreach ($comments as $comment)
        <li class="clearfix">
            <div id="container-comment-{{ $comment->id }}" class="post-comments">
                <p class="meta">
                    {{ $comment->name ?? '-' }}
                    <i style="float: right;">
                        <a class="reply" href="#" data-comment="{{ $comment->id }}" data-comic="{{ $chapter->comic->id }}" data-chapter="{{ $chapter->id ?? NULL}}"><small>Reply</small></a>
                    </i>
                </p>
                <p>
                    {{ $comment->comment ?? null }}
                </p>
            </div>
        </li>
        @include('frontend.comment', ['comments' => $comment->replies])
    @endforeach
</ul>