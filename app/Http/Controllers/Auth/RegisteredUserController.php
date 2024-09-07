<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $specializations = Specialization::all();
        return view('auth.register',compact('specializations'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        // Name deve essere minimo di 2 caratteri
        'name' => ['required', 'string', 'min:2', 'max:255'],

        // Surname deve essere minimo di 2 caratteri
        'surname' => ['required', 'string', 'min:2', 'max:255'],

        // Address deve essere minimo di 6 caratteri (inclusi spazi)
        'address' => ['required', 'string', 'min:6', 'max:255'],

        // Email deve essere valida e terminare con .com o un altro dominio
        'email' => ['required', 'string', 'email', 'regex:/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/', 'max:255', 'unique:'.User::class],

        // Password con le regole predefinite (puoi personalizzare ulteriormente)
        'password' => ['required', 'confirmed', Rules\Password::defaults()],

        // Specialization
        'specialization' => ['required', 'exists:specializations,id'], // Validazione per specializzazione
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Salva la specializzazione nella sessione per usarla dopo
    session(['specialization' => $request->specialization]);

    

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('doctors.create'));
}

}
