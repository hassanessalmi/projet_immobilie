<!-- resources/views/reservations/create.blade.php -->
@extends('layouts.app') 

@section('content')

<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="client_id">Client :</label>
        <select name="client_id" id="client_id" class="form-control" size="5" required>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->token }}-{{$client->lastName}} {{$client->firstName}} </option>
            @endforeach
        </select>

    <input type="hidden" name="Apartments_ID" id="Apartments_ID" class="form-control" value="{{ $apartment->ApartmentsID}}" readonly>
</div>
<div class="form-group">
    <label for="status">Statut :</label>
    <select name="status" id="status" class="form-control" required>
        <option value="Reserved">Réservé</option>
        <option value="Sold">Vendu</option>
        
    </select>
</div>

    <div class="form-group">
        <label for="final_price">Prix final :</label>
        <input type="number" name="final_price" id="final_price" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="size">Details:</label>
        <textarea name="size" id="size" class="form-control" rows="3" required></textarea>
    </div>
    <br>
    <div> 
        <button type="submit" class="btn btn-success btn-sm ms-2">Réserver</button>
    </div>
</form>


<script>
        var select = document.getElementById("client_id");
        var options = select.getElementsByTagName("option");

        // Fonction pour mettre à jour les options du select en fonction de la saisie de l'utilisateur
        function updateOptions() {
            var input = searchInput.value.toUpperCase();
            
            // Afficher toutes les options
            for (var i = 0; i < options.length; i++) {
                options[i].style.display = "";
            }

            // Masquer les options qui ne correspondent pas à la saisie
            for (var i = 0; i < options.length; i++) {
                var option = options[i];
                if (option.textContent.toUpperCase().indexOf(input) === -1) {
                    option.style.display = "none";
                }
            }
        }

        // Créez une entrée de recherche
        var searchInput = document.createElement("input");
        searchInput.setAttribute("type", "text");
        searchInput.setAttribute("placeholder", "Rechercher un client...");
        searchInput.style.width = "100%";

        // Attachez un gestionnaire d'événements "input" à l'entrée de recherche pour mettre à jour les options du select
        searchInput.addEventListener("input", updateOptions);

        // Insérez l'entrée de recherche avant le select
        select.parentNode.insertBefore(searchInput, select);
    </script>




@endsection

