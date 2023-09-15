@extends('layouts.app')

@section('content')
<h1>Liste des résidences</h1>
<div class="container">
    <div class="row">
        <div class="col-md-6 mb-4">
            <!-- Search Bar -->
            <form id="searchForm" action="{{ route('residences.index') }}" method="GET" class="d-flex align-items-center">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Recherche par nom de résidence">
                </div>
                <a href="{{ route('residences.index') }}" class="btn btn-secondary btn-sm ms-2">Clair</a>
            </form>
        </div>
        <div class="col-md-6 mb-4 text-end">
            @if(auth()->user()->is_admin === 1)
            <a href="{{ route('residences.create') }}" class="btn btn-primary"><div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div></a>
            @endif
        </div>
    </div>
    <div class="row">
        @foreach($residences as $residence)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header no-border">
                        <h5 class="card-title">{{ $residence->ResidenceName }}</h5>
                    </div>
                    <div class="card-body">
                        
                        <p class="card-text">
                            <strong> Numéro de résidence: </strong>{{ $residence->ResidenceNumber }}<br>
                           <strong> Nombre d'appartements: </strong> {{ $residence->apartments_count }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('apartments.index', ['residence_id' => $residence->ResidenceID]) }}" class="btn btn-primary">Voir les appartements</a>
                       
                                <a href="{{ route('residences.show', ['residence' => $residence->ResidenceID]) }}" class="btn btn-secondary">Afficher</a>
                           
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
        @if ($residences->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo; Précédent</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $residences->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Précédent</span>
                </a>
            </li>
        @endif
        
        @for ($i = 1; $i <= $residences->lastPage(); $i++)
            <li class="page-item {{ $i == $residences->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $residences->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        
        @if ($residences->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $residences->nextPageUrl() }}" aria-label="Next">
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
        $('#searchForm input').on('change', function () {
            $('#searchForm').submit();
        });
    });
</script>
    
@endsection
