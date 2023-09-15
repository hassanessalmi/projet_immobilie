@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier Client</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="firstName" class="form-label">Prénom:</label>
            <input type="text" name="firstName" id="firstName" class="form-control" value="{{ $client->firstName }}">
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Nom:</label>
            <input type="text" name="lastName" id="lastName" class="form-control" value="{{ $client->lastName }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $client->email }}">
        </div>
        <div class="mb-3">
            <label for="tele" class="form-label">Telephone:</label>
            <input type="tel" name="tele" id="tele" class="form-control" value="{{ $client->tele }}">
        </div>
        <!-- Add other form fields here -->
        <button type="submit" class="btn btn-primary">MÀJ Client</button>
    </form>
</div>
@endsection
