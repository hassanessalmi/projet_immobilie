@extends('layouts.app')
@section('content')

    
            
<h1 class="mt-4"></h1>
                     
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Nombre residence</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a  class="btn btn-light btn-sm" href="#">{{ $residenceCount }}</a>
                <div class="small text-white"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Nombre Appartement</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="btn btn-light btn-sm" href="#"> {{ $apartmentCount }}</a>
                <div class="small text-white"></div>
            </div>
        </div>
        
    </div>
    
<div class="col-xl-3 col-md-6">
<div class="card bg-success text-white mb-4">
<div class="card-body">
    <h6 class="card-title">Nombre total d'utilisateurs</h6>
</div>
<div class="card-footer d-flex align-items-center justify-content-between">
    <a class="btn btn-light btn-sm" href="#">{{ $userCount }}</a>
</div>  
</div>
</div>
 <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Total des commandes</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a  class="btn btn-light btn-sm" href="#">{{ $ordersCount }}</a>
                <div class="small text-white"></div>
            </div>
        </div>
    </div>
 
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Nombre d'appartements vendus par résidence
            </div>
            <div class="card-body"><!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Create a canvas element for the line chart -->
<canvas id="residenceApartmentChart" width="400" height="400"></canvas>
<script>
// Filtrer les données pour inclure uniquement les appartements vendus ("solde")
var soldeApartmentsData = @json($apartmentsPerResidence);

// Extraire les noms de résidence pour les appartements vendus ("solde")
var residenceNames = soldeApartmentsData.map(function(apartment) {
return apartment.ResidenceName;
});

// Extraire le nombre d'appartements vendus ("solde") par résidence
var apartmentCounts = soldeApartmentsData.map(function(apartment) {
return apartment.ApartmentCount;
});

// Data for the line chart
var data = {
labels: residenceNames,
datasets: [{
label: 'Nombre d\'appartements vendus par résidence',
data: apartmentCounts,
fill: false,
borderColor: 'rgba(75, 192, 192, 1)',
borderWidth: 2,
pointRadius: 5,
pointBackgroundColor: 'rgba(75, 192, 192, 1)',
}]
};

// Get the canvas element
var ctx = document.getElementById('residenceApartmentChart').getContext('2d');

// Create the line chart
var apartmentChart = new Chart(ctx, {
type: 'line',
data: data,
options: {
scales: {
y: {
beginAtZero: true,
},
},
},
});
</script>


</div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                status des apartments
            </div>
            <div class="card-body">

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Create a canvas element for the chart -->
    <canvas id="apartmentStatusChart" width="300" height="180"></canvas>

            <script>
                // Data for the chart
                var data = {
                    labels: ['Vendu', 'Disponible', 'Réservé'],
                    datasets: [{
                        data: [{{ $soldApartmentsCount }}, {{ $availableApartmentsCount }}, {{ $ReservedApartmentsCount }}],
                        backgroundColor: ['red', 'green', 'yellow'],
                    }]
                };

                // Get the canvas element
                var ctx = document.getElementById('apartmentStatusChart').getContext('2d');

                // Create the chart (e.g., a pie chart)
                var apartmentStatusChart = new Chart(ctx, {
                    type: 'pie', // You can change the chart type (e.g., 'bar') as needed
                    data: data,
                    options: {
                        // Customize chart options as needed
                    }
                });
            </script>
</div>
        </div>
    </div>
</div>





<div class="card mb-4 "  style="max-width: 900px">
<div class="card-header">
<i class="fas fa-chart-bar me-1"></i>
Dernière réservation
</div>
<div class="container"> <!-- Ajout de la balise container pour organiser le formulaire -->
<form method="GET" action="{{ route('dashboard') }}" id="filter-form">
@csrf
<label for="filter">Filtrer par :</label>
<select name="filter" id="maListe">
<option value="day" {{ old('filter') == 'day' ? 'selected' : '' }}>Dernier jour</option>
<option value="month" {{ old('filter') == 'month' ? 'selected' : '' }}>Dernier mois</option>
<option value="year" {{ old('filter') == 'year' ? 'selected' : '' }}>Dernière année</option>
</select>

<button type="submit" class="btn btn-primary btn-sm ms-2">Filtrer</button>
</form>


<div class="card-body">            
<table class="table table-bordered table-striped table-hover" id="data-table">
<!-- ... Votre tableau de réservations ici ... -->
<thead>
<tr>
<th scope="col">#</th>

<th scope="col">Appartement</th>
<th scope="col">Résidence</th>
<th scope="col">Commercial</th>
<th scope="col">Prix final</th>
<th scope="col">Date</th>
</tr>
</thead>
<tbody>
@foreach ($orders as $order)
<tr>
<th scope="row">{{ $order->id }}</th>
<td>{{ $order->apartment->ApartmentsNumber }}</td>
<td>{{ $order->apartment->residence->ResidenceName }}</td>
<td>{{ $order->commerciall->firstName }}</td>
<td>{{ $order->finalPrice }}</td>
<td>{{ $order->created_at }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
// Récupérer la valeur du sélecteur depuis le stockage local
var maListe = document.getElementById("maListe");
var savedValue = localStorage.getItem("selectedValue");
if (savedValue) {
maListe.value = savedValue;
}

// Écouter le changement du sélecteur
maListe.addEventListener("change", function () {
// Sauvegarder la valeur sélectionnée dans le stockage local
localStorage.setItem("selectedValue", this.value);
});
</script>







                @endsection    
           
