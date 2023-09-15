@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Notifications</h1>
        <ul>
            @foreach($notifications as $notification)
                <li>{{ $notification->data['message'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection