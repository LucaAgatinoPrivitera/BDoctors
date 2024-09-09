<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function index()
    {
        $sponsorships = Sponsorship::all();
        return view('doctors.sponsorships.index', compact('sponsorships'));
    }

    public function chooseSponsorship()
    {
      $sponsorships = Sponsorship::all();
      return view('sponsorships.choose', compact('sponsorships'));
    }


    public function create()
    {
      $sponsorships = Sponsorship::all(); // Recupera tutte le sponsorizzazioni
    return view('doctors.sponsorships.create', compact('sponsorships')); // Passa le sponsorizzazioni alla vista
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        Sponsorship::create($request->all());

        return redirect()->route('doctors.sponsorships.index')->with('success', 'Sponsorship created successfully.');
    }

    public function show(Sponsorship $sponsorship)
    {
        return view('doctors.sponsorships.show', compact('sponsorship'));
    }

    public function edit(Sponsorship $sponsorship)
    {
        return view('doctors.sponsorships.edit', compact('sponsorship'));
    }

    public function update(Request $request, Sponsorship $sponsorship)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        $sponsorship->update($request->all());

        return redirect()->route('doctors.sponsorships.index')->with('success', 'Sponsorship updated successfully.');
    }

    public function destroy(Sponsorship $sponsorship)
    {
        $sponsorship->delete();

        return redirect()->route('sponsorships.index')->with('success', 'Sponsorship deleted successfully.');
    }
}