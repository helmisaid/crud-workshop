@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create a post</h4>
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="editor">Postingan</label>
                    <textarea id="post" name="message_text" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="post_image">Gambar</label>
                    <input type="file" id="post_image" name="post_image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

<div class="col-lg-12 grid-margin stretch-card mt-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Postingan</h4>

            @if($posts->count() > 0)
                <div class="row">
                    @foreach($posts as $post)
    <div class="col-md-12 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="card-title">
                        {{ $post->sender }}
                        <span>
                            <small class="text-muted">{{ $post->formatted_date }}</small>
                        </span>
                    </h5>
                    <!-- Logo Tiga Titik -->
                    <div class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            &#x22EE; <!-- Simbol tiga titik -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('post.edit', $post->post_id) }}">
                                <i class="ti-pencil-alt text-primary"></i> Update
                            </a>
                            <form action="{{ route('post.destroy', $post->post_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item">
                                    <i class="ti-trash text-danger"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

                @if($post->post_image)
                    <img src="{{ asset('storage/' . $post->post_image) }}" class="img-fluid mb-3" alt="Image">
                @endif
                <p class="card-text">{!! $post->message_text !!}</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Dibuat pada: {{ $post->create_date }}</small>
            </div>
        </div>
    </div>
@endforeach

                </div>
            @else
                <p>Tidak ada postingan tersedia.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('jspage')
@endsection
