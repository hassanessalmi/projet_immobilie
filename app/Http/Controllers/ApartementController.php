<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Apartement;
use App\Models\Residence;

class ApartementController extends Controller
{
    public function index(Request $request)
    {
        $residenceID = $request->input('residence_id');
        $search = $request->input('search');
        $status = $request->input('status');
    
        $query = Apartement::query();
    
        if ($residenceID) {
            $query->where('ResidenceID', $residenceID);
        }
    
        if ($search) {
            $query->where('ApartmentsNumber', 'LIKE', '%' . $search . '%');
        }
    
        if ($status) {
            $query->where('Status', $status);
        }
    
        $apartments = $query->paginate(6); // Number of apartments per page
    
        return view('apartments.index', compact('apartments', 'residenceID'));
    }
    

    
    
    public function show(Apartement $apartment)
    {
        return view('apartments.show', compact('apartment'));
    }

    public function create()
    {
        if (Gate::denies('is-admin')) {
            abort(403, 'Unauthorized');
        }
        $residences = Residence::all();
        return view('apartments.create', compact('residences'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('is-admin')) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'ApartmentsNumber' => 'required',
            'SizeParSquareMeter' => 'max:255',
            'PriceParSquareMeter' => 'required',
            'TotalPrice' => 'required',
            'Status' => 'required|in:Available,Sold,Reserved',
            'ResidenceID' => 'required|exists:residences,ResidenceID'
        ]);
        
        $apartment = new Apartement();
        $apartment->ApartmentsNumber = $request->input('ApartmentsNumber');
        $apartment->SizeParSquareMeter = $request->input('SizeParSquareMeter');
        $apartment->PriceParSquareMeter = $request->input('PriceParSquareMeter');
        $apartment->TotalPrice = $request->input('TotalPrice');
        $apartment->Status = $request->input('Status');
        $apartment->ResidenceID = $request->input('ResidenceID');
        $apartment->save();
        return redirect()->route('apartments.index')->with('success', 'Apartment created successfully.');
    }

    public function edit(Apartement $apartment)
    {
        if (Gate::denies('is-admin')) {
            abort(403, 'Unauthorized');
        }
        $residences = Residence::all();
        return view('apartments.edit', compact('apartment', 'residences'));
    }

    public function update(Request $request, Apartement $apartment)
    {
        $request->validate([
            'ApartmentsNumber' => 'required',
            'SizeParSquareMeter' => 'max:255',
            'PriceParSquareMeter' => 'required',
            'TotalPrice' => 'required',
            'Status' => 'required|in:Available,Sold,Reserved',
            'ResidenceID' => 'required|exists:residences,ResidenceID'
        ]);
        $apartment->ApartmentsNumber = $request->input('ApartmentsNumber');
    $apartment->SizeParSquareMeter = $request->input('SizeParSquareMeter');
    $apartment->PriceParSquareMeter = $request->input('PriceParSquareMeter');
    $apartment->TotalPrice = $request->input('TotalPrice');
    $apartment->Status = $request->input('Status');
    $apartment->ResidenceID = $request->input('ResidenceID');
    
    $apartment->save();
        return redirect()->route('apartments.index')->with('success', 'Apartment updated successfully.');
    }

    public function destroy(Apartement $apartment)
    {
        if (Gate::denies('is-admin')) {
            abort(403, 'Unauthorized');
        }
        $apartment->delete();
        return redirect()->route('apartments.index')->with('success', 'Apartment deleted successfully.');
    }
}
