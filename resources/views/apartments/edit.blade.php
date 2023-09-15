@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier l'appartement</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('apartments.update', $apartment->ApartmentsID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="ApartmentsNumber" class="form-label">Numéro d'appartement:</label>
                <input type="text" name="ApartmentsNumber" id="ApartmentsNumber" value="{{ $apartment->ApartmentsNumber }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="SizeParSquareMeter" class="form-label">Taille (m²) :</label>
                <input type="number" name="SizeParSquareMeter" id="SizeParSquareMeter" value="{{ $apartment->SizeParSquareMeter }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="PriceParSquareMeter" class="form-label">Prix ​​au m²:</label>
                <input type="number" step="0.01" name="PriceParSquareMeter" id="PriceParSquareMeter" value="{{ $apartment->PriceParSquareMeter }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="TotalPrice" class="form-label">Prix ​​total:</label>
                <input type="number" step="0.01" name="TotalPrice" id="TotalPrice" value="{{ $apartment->TotalPrice }}" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="Status" class="form-label">Statut:</label>
                <select name="Status" id="Status" class="form-control">
                    <option value="Available" {{ $apartment->Status == 'Available' ? 'selected' : '' }}>Disponible</option>
                    <option value="Sold" {{ $apartment->Status == 'Sold' ? 'selected' : '' }}>Vendu</option>
                    <option value="Reserved" {{ $apartment->Status == 'Reserved' ? 'selected' : '' }}>Réservé</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="ResidenceID" class="form-label">Residence:</label>
                <select name="ResidenceID" id="ResidenceID" class="form-control">
                    @foreach($residences as $residence)
                        <option value="{{ $residence->ResidenceID }}" {{ $apartment->ResidenceID == $residence->ResidenceID ? 'selected' : '' }}>{{ $residence->ResidenceName }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">MÀJ</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sizeInput = document.getElementById('SizeParSquareMeter');
            const priceInput = document.getElementById('PriceParSquareMeter');
            const totalPriceInput = document.getElementById('TotalPrice');

            sizeInput.addEventListener('input', updateTotalPrice);
            priceInput.addEventListener('input', updateTotalPrice);

            function updateTotalPrice() {
                const size = parseFloat(sizeInput.value);
                const price = parseFloat(priceInput.value);
                const totalPrice = size * price;
                totalPriceInput.value = totalPrice.toFixed(2);
            }

            // Trigger the input event on page load to calculate initial Total Price
            updateTotalPrice();
        });
    </script>
@endsection
