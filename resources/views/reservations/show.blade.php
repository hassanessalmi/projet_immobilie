@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Détails de la réservation</h1>
    <table class="table">
        <tr>
            <th>ID :</th>
            <td>{{ $reservation->id }}</td>
        </tr>
        <tr>
            <th>Jeton:</th>
            <td>{{ $reservation->client->token }} </td>
        </tr>
        <tr>
            <th>Résidence</th>
            <td>{{ $reservation->apartment->residence->ResidenceName }}</td>
        </tr>
        <tr>
            <th>Appartement :</th>
            <td>{{ $reservation->apartment->ApartmentsNumber }}</td>
        </tr>
        <tr>
            <th>Client :</th>
            <td>{{ $reservation->client->firstName }} {{ $reservation->client->lastName }}</td>
        </tr>
        <tr>
            <th>Statut :</th>
            <td> @if  ($reservation->apartment->Status === 'Sold')
                                    <span class="badge bg-danger">Vendu</span>
                                @elseif ($reservation->apartment->Status === 'Reserved')
                                    <span class="badge bg-warning">Réservé</span>
                                @endif</td>
        </tr>
        <tr>
            <th>Prix final :</th>
            <td>{{ $reservation->finalPrice }}</td>
        </tr>
        <tr>
            <th>Détails :</th>
            <td>{{ $reservation->Details}}</td>
        </tr>
    </table>
<!-- Boutons "Supprimer" et "Éditer" -->
@if(auth()->user()->is_admin === 1 || auth()->user()->id === $reservation->commercial)
<div class="btn-group" role="group">
        <a href="{{ route('orders.edit', $reservation->id) }}" class="btn btn-primary btn-sm ms-2"><i class="fa-regular fa-pen-to-square"></i></a>
        <form action="{{ route('orders.destroy', $reservation->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm ms-2"><i class="fa-solid fa-trash-can"></i></button>
        </form>
    </div>
@endif


</div>

@endsection

