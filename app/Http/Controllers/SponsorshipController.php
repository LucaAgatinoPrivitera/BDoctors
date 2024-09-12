<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
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
        $sponsorships = Sponsorship::all();

        $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();

        return view('doctors.sponsorships.create', compact('sponsorships', 'doctor'));
    }

    


    public function store(Request $request)
    {         
         $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'sponsorship_id' => 'required|exists:sponsorships,id',
        ]);

        $sponsorship = Sponsorship::findOrFail($request->sponsorship_id);

        $date_start = now();

        $duration = (int) $sponsorship->duration;

        $date_end = $date_start->copy()->addDays($duration);

        $sponsorship->doctors()->attach($request->doctor_id, [
            'name' => $sponsorship->name,
            'price' => $sponsorship->price,
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);

        return redirect()->route('payment.form', ['amount' => $sponsorship->price])
            ->with('Successo', 'Sponsorizzazione associata. Procedere con il pagamento');
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
