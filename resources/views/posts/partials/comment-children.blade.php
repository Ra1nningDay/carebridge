@foreach ($comments as $comment)
    <div class="card mb-2 ms-4">
        <div class="card-body">
            <p class="card-text">{{ $comment->content }}</p>
            <p class="text-muted small">Reply by {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y') }}</p>
            
            <!-- Reply button and form -->
            <button class="btn btn-link btn-sm p-0" onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('d-none')">
                Reply
            </button>
            <div id="reply-form-{{ $comment->id }}" class="d-none mt-2">
                <form action="{{ route('posts.comments.store', $comment->post_id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <div class="form-group mb-2">
                        <textarea class="form-control" name="content" rows="2" required placeholder="Write your reply here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit Reply</button>
                </form>
            </div>

            <!-- Recursive call for nested replies -->
            @if ($comment->children)
                @include('posts.partials.comment-children', ['comments' => $comment->children])
            @endif
        </div>
    </div>
@endforeach
