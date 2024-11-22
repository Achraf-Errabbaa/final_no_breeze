<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserPendingApproval;  // Optionnel, si vous souhaitez envoyer un e-mail de confirmation

class RegisterController extends Controller
{
    /**
     * Afficher le formulaire d'inscription.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Gérer l'inscription d'un utilisateur.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validation des données de l'utilisateur
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Création de l'utilisateur avec un statut "pending" (en attente)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'pending', // Utilisateur en attente d'approbation
        ]);

        // Event pour signaler l'inscription
        event(new Registered($user));

        // Envoi d'un e-mail (optionnel) à l'utilisateur pour lui signaler que son compte est en attente
        // Si vous avez créé une classe Mailable pour cela, vous pouvez l'utiliser ici
        // Mail::to($user->email)->send(new UserPendingApproval($user));

        // Redirige vers la page de connexion avec un message de statut
        return redirect()->route('home.home')->with('status', 'Votre compte est en attente d\'approbation.');
    }

    /**
     * Gérer l'authentification d'un utilisateur après l'inscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Si l'utilisateur est en attente d'approbation, il ne peut pas se connecter
        if ($user->status === 'pending') {
            auth()->logout(); // Déconnexion de l'utilisateur
            return redirect()->route('login')->with('error', 'Votre compte est en attente d\'approbation.');
        }

        // Si l'utilisateur est approuvé, redirige vers la page d'accueil ou la destination prévue
        return redirect()->intended('/home'); // Remplacez '/home' par la route appropriée
    }

    /**
     * Vérifie les informations de connexion pour permettre l'authentification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validation des données de connexion
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Tenter de se connecter avec les informations fournies
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();

            // Vérifier si l'utilisateur est approuvé
            if ($user->status === 'pending') {
                auth()->logout(); // Déconnecter immédiatement
                return redirect()->route('login')->with('error', 'Votre compte est en attente d\'approbation.');
            }

            // L'utilisateur est authentifié et approuvé
            return redirect()->intended('/home'); // Remplacez '/home' par la route appropriée
        }

        // Si l'authentification échoue
        return redirect()->route('login')->with('error', 'Identifiants invalides.');
    }
}
    