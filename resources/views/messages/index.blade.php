@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Messages</h1>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="messagesTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="inbox-tab" data-toggle="tab" href="#inbox" role="tab" aria-controls="inbox" aria-selected="true">Inbox</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sent-tab" data-toggle="tab" href="#sent" role="tab" aria-controls="sent" aria-selected="false">Sent Mail</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="draft-tab" data-toggle="tab" href="#draft" role="tab" aria-controls="draft" aria-selected="false">Draft</a>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="messagesTabContent">
        <!-- Inbox -->
        <div class="tab-pane fade show active" id="inbox" role="tabpanel" aria-labelledby="inbox-tab">
            <h3>Inbox</h3>
            @if($inboxMessages->isEmpty())
                <p>No inbox messages.</p>
            @else
                <ul>
                    @foreach($inboxMessages as $message)
                        <li>
                            <strong>{{ $message->SUBJECT }}</strong> - {{ $message->SENDER }}
                            {{-- <a href="{{ route('messages.show', $message->MESSAGE_ID) }}">View</a> --}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Sent Mail -->
        <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">
            <h3>Sent Mail</h3>
            @if($sentMessages->isEmpty())
                <p>No sent messages.</p>
            @else
                <ul>
                    @foreach($sentMessages as $message)
                        <li>
                            <strong>{{ $message->SUBJECT }}</strong> - Sent to {{ $message->RECIPIENT }}
                            {{-- <a href="{{ route('messages.show', $message->MESSAGE_ID) }}">View</a> --}}
                        </li>
                    @endforeach
                </ul>
            @endif

            <!-- Form to send a new message -->
            <h3>Send New Message</h3>

<form action="{{ route('messages.send') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="to">To:</label>
        <input type="email" id="to" name="to" class="form-control" placeholder="Recipient's email" required>
    </div>
    <div class="form-group">
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required>
    </div>
    <div class="form-group">
        <label for="no_mk">Kategori:</label>
        <input type="text" id="no_mk" name="no_mk" class="form-control" placeholder="Kategori" required>
    </div>

    <div class="form-group">
        <label for="editor">Message:</label>
        <textarea id="message_text" name="message_text" class="form-control" placeholder="Write your message here" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Send Message</button>
</form>


        </div>

        <!-- Draft -->
        <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="draft-tab">
            <h3>Draft</h3>
            @if($draftMessages->isEmpty())
                <p>No draft messages.</p>
            @else
                <ul>
                    @foreach($draftMessages as $message)
                        <li>
                            <strong>{{ $message->SUBJECT }}</strong>
                            {{-- <a href="{{ route('messages.show', $message->message_id) }}">View</a> --}}

                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
