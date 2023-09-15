@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des appartements</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                <!-- Search Bar and Filters -->
                <form id="searchForm" action="{{ route('apartments.index') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Recherche par numéro d'appartement">
                    </div>
                    <select name="status" class="form-select form-select-sm ms-2">
                        <option value="">Tous les statuts</option>
                        <option value="Available">Disponible</option>
                        <option value="Sold">Vendu</option>
                        <option value="Reserved">Réservé</option>
                    </select>
                    <input type="hidden" name="residence_id" value="{{ $residenceID }}">
                    <a href="{{ route('apartments.index')  }}" class="btn btn-secondary btn-sm ms-2">Clair</a>
                </form>
                
            </div>
            
            <div class="col-md-6 mb-4 text-end">
                @if(auth()->user()->is_admin === 1)
                    <a href="{{ route('apartments.create') }}" class="btn btn-primary"><div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div></a>
                @endif
            </div>
        </div>

       
        <div class="row">
            @foreach($apartments as $apartment)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header no-border"><h5 class="card-title">Numéro d'appartement: {{ $apartment->ApartmentsNumber }}</h5></div>
                        <div class="card-body">
                            <p class="card-text">
                                @if ($apartment->residence)
                                Nom de la résidence: {{ $apartment->residence->ResidenceName }}<br>
                                @endif
                                Taille (m²): {{ $apartment->SizeParSquareMeter }}<br>
                                Prix ​​au m²: {{ $apartment->PriceParSquareMeter }}<br>
                                Prix ​​total: {{ $apartment->TotalPrice }}<br>
                                Statut:
                                @if ($apartment->Status === 'Available')
                                    <span class="badge bg-success">Disponible</span>
                                @elseif ($apartment->Status === 'Sold')
                                    <span class="badge bg-danger">Vendu</span>
                                @elseif ($apartment->Status === 'Reserved')
                                    <span class="badge bg-warning">Réservé</span>
                                @else
                                    {{ $apartment->Status }}
                                @endif
                                <!-- Add more card text here -->
                            </p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('apartments.show', ['apartment' => $apartment->ApartmentsID]) }}" class="btn btn-primary">Afficher</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Pagination -->
    <nav aria-label="Page navigation" class="pagination-container">
        <ul class="pagination justify-content-center">
            @if ($apartments->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&laquo; Précédent</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $apartments->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Précédent</span>
                    </a>
                </li>
            @endif
            
            @for ($i = 1; $i <= $apartments->lastPage(); $i++)
                <li class="page-item {{ $i == $apartments->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $apartments->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            
            @if ($apartments->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $apartments->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">Suivant &raquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">Suivant &raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
    <!-- End Pagination -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#searchForm select, #searchForm input').on('change', function () {
            $('#searchForm').submit();
        });
    });
</script>

@endsection
