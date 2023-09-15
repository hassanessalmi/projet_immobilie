<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartement;
use App\Models\Client;
use App\Models\Order;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCreatedNotification;



class OrderController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create($apartment_id)
    {
        $apartment = Apartement::find($apartment_id);
        if($apartment->Status =='Sold'){
            return abort(403, 'Accès interdit');
        }
        // Récupérez l'appartement associé à l'ID (vous devrez définir la logique appropriée)
       
         $user = auth()->user(); // Get the currently logged-in user
    
    // Check if the user is an admin
    if ($user->is_admin === 1) {
        // If the user is an admin, retrieve all clients
        $clients = Client::all();
    } else {
        // If the user is not an admin, retrieve clients with the same commercial value as the user's ID
        $clients = Client::where('commercial', $user->id)->get();
    }
        return view('reservations.create', compact('apartment','clients'));
    }
    

  

    public function index(Request $request)
    {
        $user = auth()->user(); // Get the currently logged-in user
    
        $query = Order::query();
        $query->with(['apartment.residence', 'commerciall', 'client']);
    
        // Apply search filter if the 'search' parameter is present in the request
        $search = $request->input('search');
        if (!empty($search)) {
            $query->whereHas('client', function ($subQuery) use ($search) {
                $subQuery->where('token', 'like', '%' . $search . '%');
            });
        }
    
        // Check if the user is an admin
        if ($user->is_admin === 1) {
            // If the user is an admin, retrieve all clients
            $reservations = $query->paginate(20);
        } else {
            // If the user is not an admin, retrieve clients with the same commercial value as the user's ID
            $reservations = $query->where('commercial', $user->id)->paginate(20);
        }
    
        return view('reservations.index', compact('reservations'));
    }
    
    
    public function show($id)
    {
        $reservation = Order::find($id);

        if (!$reservation) {
            return Redirect::route('reservations.index')->with('error', 'Réservation introuvable.');
        }

        return view('reservations.show', compact('reservation'));
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'final_price' => 'required',
            'size' => 'required',
            'status' => 'required|in:Reserved,Sold', // Ajoutez les autres statuts au besoin
        ]);
    
        // Création de la réservation
        $reservation = new Order([
            'clients' => $request->input('client_id'),
            'Details' => $request->input('size'),
            'ApartmentsID' => $request->input('Apartments_ID'),
            'commercial' => Auth::id(),
            'finalPrice' => $request->input('final_price'),
            'status' => $request->input('status'),
        ]);
        
        // Associer l'appartement à la réservation
        $apartment = Apartement::find($request->input('Apartments_ID'));
        $reservation->apartment()->associate($apartment);
    
        $reservation->save();
    
        // Mettre à jour le statut de l'appartement (si nécessaire)
        $apartment->status = $request->input('status');
        $apartment->save();
        
         // Get the admin users
    $adminUsers = User::where('is_admin', 1)->get();

    // Trigger the database notification for each admin user
    foreach ($adminUsers as $adminUser) {
        $adminUser->notify(new OrderCreatedNotification($reservation));
    }
        
        
        
    
        return redirect()->route('orders.index')->with('success', 'Réservation effectuée avec succès.');
    }
    
 
    
    public function update(Request $request, $id)
    {
        $reservation = Order::find($id);
    
        if (!$reservation) {
            return redirect()->route('reservations.index')->with('error', 'Réservation introuvable.');
        }
    
        // Validation des données du formulaire
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:Reserved,Sold',
            'final_price' => 'required',
            'size' => 'required|string', // Vous pouvez ajuster le type en fonction de vos besoins
        ]);
    
        // Mettre à jour les données de la réservation
        $reservation->clients = $request->input('client_id');
       // $reservation->ApartmentsID = $request->input('Apartments_ID');
       
        $reservation->finalPrice = $request->input('final_price');
        $reservation->Details = $request->input('size');
        $apartment = Apartement::find($request->input('Apartments_ID'));
        $reservation->apartment()->associate($apartment);
        $reservation->save();
        $apartment->status = $request->input('status');
        $apartment->save();
    
    
        return redirect()->route('orders.show', $reservation->id)->with('success', 'Réservation mise à jour avec succès.');
    }
    
    public function edit($id)
    {
        $reservation = Order::find($id);
    
        if (!$reservation) {
            return redirect()->route('reservations.index')->with('error', 'Réservation introuvable.');
        }
    
       
    
        if (Auth::user()->is_admin === 1 || Auth::user()->id == $reservation->commercial) {
            $clients = Client::all(); // Assurez-vous d'importer le modèle Client
        $apartments = Apartement::all(); // Assurez-vous d'importer le modèle Apartment
    
        return view('reservations.edit', compact('reservation', 'clients', 'apartments'));
        } else {
            return abort(403, 'Accès interdit');
        }
        
        
       
    }
public function destroy($id)
{
    $reservation = Order::find($id);

    if (!$reservation) {
        return redirect()->route('orders.index')->with('error', 'Réservation introuvable.');
    }

    // Supprimez la réservation
    $reservation->delete();

    return redirect()->route('orders.index')->with('success', 'Réservation supprimée avec succès.');
}
}
