@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create your own post now</h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="editor">Message</label>
                    <textarea id="post" name="message_text" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="post_image">Image</label>
                    <input type="file" id="post_image" name="post_image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>

<div class="col-lg-12 grid-margin  mt-4" id="post-list">
    <!-- Posting akan dimuat di sini oleh AJAX -->
</div>

@endsection

@section('jspage')
<script>
    function loadPosts() {
    $.ajax({
    url: "{{ route('posts.list') }}?t=" + new Date().getTime(),
    method: 'GET',
    success: function(posts) {
        $('#post-list').empty();
        posts.forEach(function(post) {
            $('#post-list').append(`
                <div class="col-md-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body border-solid border">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center py-4">
                                    <img src="{{ asset('/assets/images/faces/face28.jpg') }}" alt="Profile" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <h5 class="card-title mb-0">${post.sender}</h5>
                                        <small class="text-muted post-time" data-create-date="${post.created_at}">${post.formatted_date}</small>
                                    </div>
                                </div>
                                <div class="nav-item nav-profile dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                                        &#x22EE; <!-- Simbol tiga titik -->
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                        <a class="dropdown-item" href="{{ url('post') }}/${post.post_id}/edit">
                                            <i class="ti-pencil-alt text-primary"></i> Update
                                        </a>
                                        <form action="{{ url('post') }}/${post.post_id}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item delete-btn" data-post-id="${post.post_id}">
                                                <i class="ti-trash text-danger"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            ${post.post_image ? `<img src="{{ asset('storage/') }}/${post.post_image}" class="img-fluid mb-3" alt="Image">` : ''}
                            <p class="card-text">${post.message_text}</p>
                        </div>
                    </div>
                </div>
            `);
        });
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
});

}
    $(document).ready(function() {
        loadPosts();
        setInterval(loadPosts, 20000);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updatePostTimes() {
            const postTimes = document.querySelectorAll('.post-time');
            postTimes.forEach(function(postTime) {
                const createDate = new Date(postTime.getAttribute('data-create-date'));
                const currentTime = new Date();
                const diffTime = Math.abs(currentTime - createDate);
                const diffMinutes = Math.floor(diffTime / (1000 * 60));
                const diffHours = Math.floor(diffTime / (1000 * 60 * 60));
                const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

                let formattedTime;

                if (diffMinutes < 60) {
                    formattedTime = ${diffMinutes} menit yang lalu;
                } else if (diffHours < 24) {
                    formattedTime = ${diffHours} jam yang lalu;
                } else {
                    formattedTime = ${diffDays} hari yang lalu;
                }

                const formattedDate = createDate.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });

                const formattedTimeWithDate = ${formattedTime} - ${formattedDate};

                postTime.textContent = formattedTimeWithDate;
            });
        }

        // Perbarui waktu setiap 60 detik
        setInterval(updatePostTimes, 60000);

        // Jalankan segera setelah halaman dimuat
        updatePostTimes();
    });
</script>
@endsection

