@extends('layouts.app')

@section('content')
<div class="container">
    <h1> <i>Liste des Orders</i></h1>
    <form method="GET" action="{{ route('orders.index') }}" class="d-flex align-items-center">
        <div class="form-group">
            
            <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"  placeholder="recherch par Jeton">
        </div>
        <button type="submit" class="btn btn-primary">recherch</button>
    </form>


   
</div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Jeton</th>
                    <th scope="col">Résidence</th>
                    <th scope="col">Appartement</th>
                    <th scope="col">Commercial</th>
                 
                    <th scope="col">Prix final</th>
                    <th scope="col">Détails</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->client->token}} </td>
                        <td>{{ $reservation->apartment->residence->ResidenceName }}</td>
                        <td>{{ $reservation->apartment->ApartmentsNumber }}</td>
                        <td>{{ $reservation->commerciall->firstName}}</td>

                       
                        <td>{{ $reservation->finalPrice }}</td>
                        <td><a href="{{ route('orders.show', $reservation->id) }}">Détails</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 <!-- Pagination -->
 <nav aria-label="Page navigation" class="pagination-container">
    <ul class="pagination justify-content-center">
        @if ($reservations->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo; Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $reservations->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Précédent</span>
                </a>
            </li>
        @endif
        
        @for ($i = 1; $i <= $reservations->lastPage(); $i++)
            <li class="page-item {{ $i == $reservations->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $reservations->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        
        @if ($reservations->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $reservations->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">Suivant &raquo;</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">Next &raquo;</span>
            </li>
        @endif
    </ul>
</nav>
<!-- End Pagination -->
@endsection
