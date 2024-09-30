<!-- In resources/views/messages/edit_draft.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Draft Message</h1>

        <form action="{{ route('messages.update_draft', $message->message_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="to">To:</label>
                <input type="email" id="to" name="to" class="form-control" value="{{ $message->recipients->first()->to }}" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" class="form-control" value="{{ $message->subject }}" required>
            </div>
            <div class="form-group">
                <label for="no_mk">Kategori:</label>
                <input type="text" id="no_mk" name="no_mk" class="form-control" value="{{ $message->no_mk }}" required>
            </div>

            <div class="form-group">
                <label for="editor">Message:</label>
                <textarea id="message_text" name="message_text" class="form-control" required>{{ $message->message_text }}</textarea>
            </div>

            <div class="form-group">
                <label for="document">Attach Document:</label>
                <input type="file" id="document" name="document" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Draft Message</button>
        </form>
    </div>
@endsection
