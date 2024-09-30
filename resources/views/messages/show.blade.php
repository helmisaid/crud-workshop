<!-- In resources/views/messages/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Message Details') }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="message_id" class="col-md-4 col-form-label text-md-right">{{ __('Message ID') }}</label>

                            <div class="col-md-6">
                                <input id="message_id" type="text" class="form-control" name="message_id" value="{{ $message->message_id }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sender" class="col-md-4 col-form-label text-md-right">{{ __('Sender') }}</label>

                            <div class="col-md-6">
                                <input id="sender" type="text" class="form-control" name="sender" value="{{ $message->sender }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>

                            <div class="col-md-6">
                                <input id="subject" type="text" class="form-control" name="subject" value="{{ $message->subject }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message_text" class="col-md-4 col-form-label text-md-right">{{ __('Message Text') }}</label>

                            <div class="col-md-6">
                                <textarea id="message_text" class="form-control" name="message_text" readonly>{{ $message->message_text }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="recipients" class="col-md-4 col-form-label text-md-right">{{ __('Recipients') }}</label>

                            <div class="col-md-6">
                                <ul>
                                    @foreach($message->recipients as $recipient)
                                        <li>{{ $recipient->to }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <input id="category" type="text" class="form-control" name="category" value="{{ $message->no_mk }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="documents" class="col-md-4 col-form-label text-md-right">{{ __('Documents') }}</label>

                            <div class="col-md-6">
                                <ul>
                                    @if($message->documents->isEmpty())
                                        <li>No documents attached.</li>
                                    @else
                                        @foreach($message->documents as $document)
                                            <li>
                                                {{ $document->file }}
                                                <a href="{{ route('download.document', $document->file) }}" class="btn btn-sm btn-primary">Download</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
