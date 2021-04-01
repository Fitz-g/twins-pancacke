<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
            "remember_me" => "integer",
        ], [
            "email.required" => "L'adresse mail est obligatoire",
            "email.email" => "Veuillez bien entrer l'adresse mails",
            "password.required" => "Le mot de passe est obligatoire"
        ]);

        if ($validator->fails()) {
            Log::info("Tentative de connexion échouée : " . json_encode($request->all()) . '/' . Carbon::now());
            toastr()->warning('Veuillez bien remplir les champs s\'il vous plaît');
            return redirect()-route('login')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = $request->except("_token", "_method");
            $remember = isset($data["remember_me"]); // Vérifie si l'utilisateur à coché "se rappeler de moi"
            $credentials = $request->only("email", "password");

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();

                $user = Auth::user();
                $user->last_connected = Carbon::now();
                $user->save();
                Log::info("Nouvelle Connexion " . json_encode($user));
                toastr()->success("Bienvenue Mme / M " . $user->first_name . ' ' . $user->last_name);
                return redirect()->route('dashboard');
            }
            toastr()->error("Adresse mail ou mot de passe incorrect.");
            Log::error('Erreur de connexion ' . json_encode($request->all()));
            return back()->withErrors([
                'email' => 'Adresse mail ou mot de passe incorrect.',
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            toastr()->error('Une erreur est survenue.');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        Log::info("Utilisateur déconnecté.");
        toastr()->success("Vous êtes déconnecté");
        return redirect()->route('login');
    }
}
