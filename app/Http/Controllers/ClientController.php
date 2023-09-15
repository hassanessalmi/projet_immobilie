<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function index()
    {
        $user = auth()->user(); // Get the currently logged-in user
    
    // Check if the user is an admin
    if ($user->is_admin === 1) {
        // If the user is an admin, retrieve all clients
        $clients = Client::all();
    } else {
        // If the user is not an admin, retrieve clients with the same commercial value as the user's ID
        $clients = Client::where('commercial', $user->id)->get();
    }
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:clients',
            'tele' => 'required',
        ]);

        $client = new Client($validatedData);
        $client->commercial = Auth::user()->id;
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client created successfully');
    }


    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'tele' => 'required',
           
        ]);

        $client->update($validatedData);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully');
    }
}
