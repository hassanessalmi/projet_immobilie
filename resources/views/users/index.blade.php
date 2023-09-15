@extends('layouts.app')

@section('content')
 <div class="container">
        <h2>Liste Commercial</h2>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->firstName }}</td>
                        <td>{{ $user->lastName }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(auth()->user()->is_admin === 1 && $user->is_admin !== 1)
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-user-pen"></i></a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
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
