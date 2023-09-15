@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Éditer la réservation</h1>
        <form action="{{ route('orders.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="client_id">Client :</label>
                <select name="client_id" id="client_id" class="form-control" required>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $reservation->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->firstName }} {{ $client->lastName }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="Apartments_ID">Appartement :</label>
                <select name="Apartments_ID" id="Apartments_ID" class="form-control" required>
                    @foreach($apartments as $apartment)
                        <option value="{{ $apartment->ApartmentsID }}" {{ $reservation->Apartments_ID == $apartment->ApartmentsID ? 'selected' : '' }}>
                            {{ $apartment->ApartmentsNumber }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Statut :</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Reserved" {{ $reservation->status == 'Reserved' ? 'selected' : '' }}>Réservé</option>
                    <option value="Sold" {{ $reservation->status == 'Sold' ? 'selected' : '' }}>Vendu</option>
                </select>
            </div>

            <div class="form-group">
                <label for="final_price">Prix final :</label>
                <input type="number" name="final_price" id="final_price" class="form-control" value="{{ $reservation->final_price }}" required>
            </div>

            <div class="form-group">
                <label for="size">Détails :</label>
                <textarea name="size" id="size" class="form-control" rows="3"  required>{{ $reservation->size }}</textarea>
            </div>
        
                
            <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> Mettre à jour</button>
            <a href="{{ route('orders.index')}}" class="btn btn-primary">return</a>
        </form>
    </div>
@endsection
