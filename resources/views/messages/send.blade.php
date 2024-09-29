@extends('layouts.app')

@section('content')
<h1>Send Mail</h1>
<form action="{{ route('messages.store') }}" method="POST">
    @csrf
    <input type="text" name="subject" placeholder="Subject">
    <textarea name="message_text" placeholder="Your message"></textarea>
    <button type="submit">Send</button>
</form>
@endsection
