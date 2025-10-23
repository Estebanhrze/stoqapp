<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
class RegisteredUserController extends Controller
{
    /**
     * Mostrar formulario de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Procesar registro.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name'     => $request->string('name'),
            'email'    => $request->string('email'),
            'password' => Hash::make($request->string('password')),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // 👇 Redirige a /products (RouteServiceProvider::HOME)
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
