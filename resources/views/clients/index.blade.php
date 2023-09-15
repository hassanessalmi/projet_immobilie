@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Clients</h1>
    <a class="btn btn-primary" href="{{ route('clients.create') }}">Créer un nouveau client</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jeton</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Commercial</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->token }}</td>
                    <td>{{ $client->firstName }}</td>
                    <td>{{ $client->lastName }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->tele }}</td>
                    <td>{{ $client->user->firstName . ' ' . $client->user->lastName }}</td>
                    <td>
                        @if(auth()->user()->is_admin === 1 || auth()->user()->id === $client->commercial)
                        <a class="btn btn-primary btn-sm" href="{{ route('clients.edit', $client->id) }}"><i class="fa-solid fa-user-pen"></i></a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ms-2"><i class="fa-solid fa-user-slash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
