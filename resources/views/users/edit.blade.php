@extends('layouts.app')

@section('content')
<div class="container">
        <h2>Modifier Commercial</h2>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="firstName" class="form-label">Prénom</label>
                <input type="text" name="firstName" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" value="{{ old('firstName', $user->firstName) }}" required>
                @if ($errors->has('firstName'))
                    <div class="invalid-feedback">
                        {{ $errors->first('firstName') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Nom</label>
                <input type="text" name="lastName" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" value="{{ old('lastName', $user->lastName) }}" required>
                @if ($errors->has('lastName'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lastName') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $user->email) }}" required>
                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">MÀJ Commercial</button>
        </form>
    </div>
@endsection
