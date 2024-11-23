<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Afficher le formulaire de connexion.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Gérer la tentative de connexion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validation des données d'entrée
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Essayer de se connecter avec les informations fournies
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Récupérer l'utilisateur connecté
            $user = Auth::user();

            // Vérifier si l'utilisateur est approuvé
            if ($user->status === 'pending') {
                // Si l'utilisateur est en attente, on le déconnecte immédiatement
                Auth::logout();
                return redirect()->route('home.home')->with('error', 'Votre compte est en attente d\'approbation.');
            }

            
            return redirect()->intended('home.home');
        }

        // Si l'authentification échoue
        return redirect()->route('login')->with('error', 'Identifiants invalides.');
    }

    /**
     * Gérer la déconnexion de l'utilisateur.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout(); // Déconnecter l'utilisateur
        return redirect()->route('login'); // Rediriger vers la page de connexion
    }
}