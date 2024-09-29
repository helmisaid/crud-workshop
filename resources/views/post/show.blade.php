@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin mt-4" id="post-detail">
    <!-- Navigation Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="javascript:history.back()" class="btn btn-secondary">
            <i class="ti-arrow-left"></i> Kembali
        </a>
    </div>

    <h2 class="card-title my-2">Detail Post</h2>

    <div class="col-md-12 mb-4">
        <div class="card h-100">
            <div class="card-body border-solid border-rounded">

                <!-- Post Header -->
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center py-4">
                        <img src="{{ asset('/assets/images/faces/face28.jpg') }}" alt="Profile" class="rounded-circle me-2" width="40" height="40">
                        <div>
                            <h5 class="card-title mb-0">{{ $post->sender }}</h5>
                            <small class="text-muted post-time" data-create-date="{{ $post->create_date }}">
                                {{ $post->create_date ? $post->create_date->format('d M Y H:i') : 'Unknown Date' }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Post Image -->
                @if($post->post_image)
                    <img src="{{ asset('storage/' . $post->post_image) }}" class="img-fluid mb-3" alt="Image">
                @endif

                <!-- Post Message -->
                <p class="card-text">{!! $post->message_text !!}</p>

                <!-- Like Button and Count -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn btn-light like-btn me-2" data-post-id="{{ $post->post_id }}">
                        <i class="ti-thumb-up"></i> Like
                    </button>
                    <span class="like-count" id="like-count-{{ $post->post_id }}">{{ $post->like_count ?? 0 }} Likes</span>
                </div>

                <!-- Comments Section -->
                <div class="comments-section mt-4">
                    <h6>Komentar:</h6>
                    <div class="comments-list" id="comments-list-{{ $post->post_id }}">
                        <!-- Display Comments -->
                        @foreach($post->comments as $comment)
                            <div class="comment mb-3 p-3 border rounded bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="me-2">{{ $comment->user->username }}</strong>
                                    <small class="text-muted">{{ $comment->create_date ? \Carbon\Carbon::parse($comment->create_date)->format('d M Y H:i') : 'Unknown Date' }}</small>
                                </div>
                                <p class="mt-2">{{ $comment->comment_text }}</p>
                                @if($comment->comment_image)
                                    <img src="{{ asset('storage/' . $comment->comment_image) }}" class="img-fluid mb-2 rounded" alt="Comment Image">
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Comment Form -->
                    <form action="{{ route('comments.store', $post->post_id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="comment_text" class="form-control" placeholder="Tulis komentar..." required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" name="comment_image" class="form-control" accept="image/*">
                        </div>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection

@section('jspage')
<script>
    function loadComments(postId) {
    $.ajax({
        url: `/posts/${postId}/comments?t=` + new Date().getTime(), // Prevent caching
        method: 'GET',
        success: function(comments) {
            const commentsList = $(`#comments-list-${postId}`);
            commentsList.empty(); // Clear existing comments

            comments.forEach(function(comment) {
                commentsList.append(`
                    <div class="comment mb-2">
                        <strong>${comment.user.username}</strong> <!-- Use username from the related user -->
                        <small class="text-muted">${new Date(comment.create_date).toLocaleString()}</small>
                        <p>${comment.comment_text}</p>
                        ${comment.comment_image ? `<img src="{{ asset('storage/') }}/${comment.comment_image}" class="img-fluid mb-2" alt="Comment Image">` : ''}
                    </div>
                `);
            });
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
}

// Automatically load comments for each post every 5 seconds
$('.comments-list').each(function() {
    const postId = $(this).attr('id').split('-')[2]; // Extract post ID from the comments list ID
    loadComments(postId); // Initial load
    setInterval(function() {
        loadComments(postId);
    }, 5000); // 5000 milliseconds = 5 seconds
});


</script>
@endsection
