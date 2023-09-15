@extends('layouts.app')

@section('content')
<div class="container">
        <h2>Créer une résidence</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{ route('residences.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="ResidenceName" class="form-label">Nom de la résidence:</label>
                <input type="text" name="ResidenceName" id="ResidenceName" class="form-control">
            </div>
            <div class="mb-3">
                <label for="ResidenceNumber" class="form-label">Numéro de résidence:</label>
                <input type="text" name="ResidenceNumber" id="ResidenceNumber" class="form-control">
            </div>
            <!-- Add more form fields here -->

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
@endsection
