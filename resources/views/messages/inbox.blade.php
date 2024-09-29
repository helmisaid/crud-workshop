@extends('layouts.app')

@section('content')
<h1>Inbox</h1>
<table>
    <tr>
        <th>Sender</th>
        <th>Subject</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach ($messages as $message)
    <tr>
        <td>{{ $message->sender }}</td>
        <td>{{ $message->subject }}</td>
        <td>{{ $message->message_status }}</td>
        <td>
            <a href="{{ route('messages.show', $message->message_id) }}">View</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
