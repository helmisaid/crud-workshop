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

<!-- Modal Edit Post -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPostForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="post_id" id="editPostId">
                    <div class="mb-3">
                        <label for="editMessage" class="form-label">Message</label>
                        <textarea class="form-control" id="editMessage" name="message_text"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editPostImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="editPostImage" name="post_image">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Post</button>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="col-lg-12 grid-margin mt-4" id="post-list">
    <!-- Posting akan dimuat di sini oleh AJAX -->
</div>

@endsection

@section('jspage')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // Fungsi untuk memuat postingan dari server
    // Fungsi untuk memuat postingan dari server

    function loadPosts() {
    $.ajax({
        url: "{{ route('posts.list') }}?t=" + new Date().getTime(),
        method: 'GET',
        success: function(posts) {
            $('#post-list').empty();
            posts.forEach(function(post) {
                let likeButtonClass = post.user_liked ? 'liked' : 'unliked';
                let likeButtonText = post.user_liked ? 'Unlike' : 'Like';

                let dropdownMenu = `
                <div class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                        &#x22EE; <!-- Simbol tiga titik -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ url('post') }}/${post.post_id}">
                            <i class="ti-eye text-info"></i> Detail
                        </a>
                        ${post.create_by === '{{ auth()->id() }}' ? `
                            <a class="dropdown-item edit-btn" data-post-id="${post.post_id}">
                                <i class="ti-pencil-alt text-primary"></i> Update
                            </a>
                            <form action="{{ url('post') }}/${post.post_id}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item delete-btn" data-post-id="${post.post_id}">
                                    <i class="ti-trash text-danger"></i> Delete
                                </button>
                            </form>
                        ` : ''}
                    </div>
                </div>`;

                // Menyiapkan komentar
                let commentsHtml = post.comments.length > 0 ? post.comments.map(comment => `
                    <div class="comment">
                        <strong>${comment.user_name}</strong>: ${comment.comment_text}
                    </div>
                `).join('') : '<div>Tidak ada komentar</div>';

                $('#post-list').append(`
                    <div class="col-md-12 mb-4">
                        <div class="card h-100">
                            <div class="card-body border-solid border-round">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center py-4">
                                        <img src="{{ asset('/assets/images/faces/face28.jpg') }}" alt="Profile" class="rounded-circle me-2" width="40" height="40">
                                        <div>
                                            <h5 class="card-title mb-0">${post.sender}</h5>
                                            <small class="text-muted post-time" data-create-date="${post.created_at}">${post.formatted_date}</small>
                                        </div>
                                    </div>
                                    ${dropdownMenu}
                                </div>
                                ${post.post_image ? `<img src="{{ asset('storage/') }}/${post.post_image}" class="img-fluid mb-3" alt="Image">` : ''}
                                <p class="card-text">${post.message_text}</p>

                                <div>
                                    <!-- Like Button -->
                                    <form action="${post.user_liked ? '{{ route('post.unlike', '') }}' + '/' + post.post_id : '{{ route('post.like', '') }}' + '/' + post.post_id}" method="POST" class="d-inline like-form">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <span id="like-count-${post.post_id}">${post.likes_count}</span> ${likeButtonText}
                                        </button>
                                    </form>
                                </div>

                                <div class="comments-section mt-3">
                                    <h6>Komentar:</h6>
                                    <div class="comments-list" id="comments-list-${post.post_id}">
                                        ${post.comments.length ? post.comments.map(comment => `
                                            <div class="comment-item">
                                                 ${comment.comment_image ? `<img src="{{ asset('storage/') }}/${comment.comment_image}" class="img-fluid mb-3" alt="Image">` : ''}
                                                <p>${comment.comment_text}</p>
                                                <small class="text-muted">${comment.user.username} - ${comment.create_date}</small>
                                                <hr>
                                            </div>
                                        `).join('') : '<p>Tidak ada komentar.</p>'}
                                    </div>
                                </div>
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



// $(document).on('click', '.edit-btn', function(e) {
//     e.preventDefault(); // Mencegah navigasi default
//     e.stopPropagation(); // Mencegah dropdown menutup

//     var postId = $(this).data('post-id');

//     // Ambil data postingan dari server
//     $.ajax({
//         url: `/post/${postId}`, // Endpoint untuk mendapatkan detail postingan
//         method: 'GET',
//         success: function(post) {
//             $('#editPostId').val(post.post_id);
//             $('#editMessage').val(post.message_text);
//             $('#editPostModal').modal('show'); // Tampilkan modal edit
//         },
//         error: function(xhr, status, error) {
//             console.error("Error fetching post data:", error);
//         }
//     });
// });

// Fungsi untuk memperbarui jumlah like
function updateLikeCount(postId, likesCount) {
    $('#like-count-' + postId).text(`${likesCount} Likes`);
}


$(document).on('click', '.edit-btn', function(e) {
    e.preventDefault(); // Mencegah navigasi default
    e.stopPropagation(); // Mencegah dropdown menutup

    var postId = $(this).data('post-id');

    // Ambil data postingan dari server
    $.ajax({
        url: `/post/${postId}`, // Endpoint untuk mendapatkan detail postingan
        method: 'GET',
        success: function(post) {// Periksa apakah data sudah benar
            $('#editPostId').val(post.post_id);
            $('#editMessage').val(post.message_text);
            $('#editPostModal').modal('show');
        },


        error: function(xhr, status, error) {
            console.error("Error fetching post data:", error);
        }
    });
});

// Pastikan penanganan event lain di dalam dropdown juga melakukan hal yang sama
$(document).on('click', '.delete-btn', function(e) {
    e.stopPropagation(); // Mencegah dropdown menutup saat mengklik tombol delete
});

$(document).ready(function() {
    $('#like-toggle').click(function() {
        const postId = $(this).data('post-id');
        const likeText = $('#like-text');
        const likeCount = $('#like-count');

        if (likeText.text() === "Like") {
            // Mengirim permintaan AJAX untuk menambahkan like
            $.ajax({
                url: `/post/${postId}/like`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Menyertakan token CSRF
                },
                success: function(response) {
                    likeText.text("Unlike");
                    likeCount.text(response.likes_count); // Update jumlah like
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            // Mengirim permintaan AJAX untuk menghapus like
            $.ajax({
                url: `/post/${postId}/unlike`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // Menyertakan token CSRF
                },
                success: function(response) {
                    likeText.text("Like");
                    likeCount.text(response.likes_count); // Update jumlah like
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});






// Terapkan submit form untuk mengupdate postingan
$('#editPostForm').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    var postId = $('#editPostId').val();

    $.ajax({
        url: `/post/${postId}`,
        method: 'PUT',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            // Refresh atau load ulang postingan
            loadPosts();
            $('#editPostModal').modal('hide');
            alert(response.success); // Show success message
        },
        error: function(xhr) {
            console.error("Error updating post:", xhr.responseText);
            alert('Failed to update post.');
        }
    });
});


    // Fungsi untuk memperbarui waktu posting
    function updatePostTimes() {
        const postTimes = document.querySelectorAll('.post-time');
        postTimes.forEach(function(postTime) {
            const createDateStr = postTime.getAttribute('data-create-date');
            const createDate = new Date(createDateStr); // Menggunakan format ISO
            const currentTime = new Date();

            // Cek jika createDate valid
            if (isNaN(createDate.getTime())) {
                console.error('Invalid date format:', createDateStr); // Debugging line
                postTime.textContent = 'Tanggal tidak valid'; // Menangani tanggal tidak valid
                return;
            }

            const diffTime = Math.abs(currentTime - createDate);
            const diffMinutes = Math.floor(diffTime / (1000 * 60));
            const diffHours = Math.floor(diffTime / (1000 * 60 * 60));
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

            let formattedTime;

            if (diffMinutes < 60) {
                formattedTime = `${diffMinutes} menit yang lalu`;
            } else if (diffHours < 24) {
                formattedTime = `${diffHours} jam yang lalu`;
            } else {
                formattedTime = `${diffDays} hari yang lalu`;
            }

            const formattedDate = createDate.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            });

            const formattedTimeWithDate = `${formattedTime} - ${formattedDate}`;

            postTime.textContent = formattedTimeWithDate;
        });
    }

    // Panggil fungsi loadPosts ketika halaman selesai dimuat
    $(document).ready(function() {
        loadPosts();

        // Perbarui waktu setiap 60 detik
        setInterval(updatePostTimes, 50000);

        // Jalankan loadPosts setiap 7 detik
        setInterval(loadPosts, 7000); // 7000 milliseconds = 7 seconds

        // Jalankan segera setelah halaman dimuat
        updatePostTimes();
    });

</script>
@endsection
