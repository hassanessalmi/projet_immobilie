@extends('layouts.app')

@section('content')
 <div class="container">
        <h2>Modifier la résidence</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('residences.update', $residence->ResidenceID) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="ResidenceName" class="form-label">Nom de la résidence:</label>
                <input type="text" name="ResidenceName" id="ResidenceName" class="form-control" value="{{ $residence->ResidenceName }}">
            </div>
            
            <div class="mb-3">
                <label for="ResidenceNumber" class="form-label">Numéro de résidence:</label>
                <input type="text" name="ResidenceNumber" id="ResidenceNumber" class="form-control" value="{{ $residence->ResidenceNumber }}">
            </div>
            
            <!-- Add more form fields here -->

            <button type="submit" class="btn btn-primary">MÀJ</button>
        </form>
    </div>
@endsection
