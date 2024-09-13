<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthentificationRequest;
use App\Http\Requests\RegisterAuthentificationRequest;
use App\Http\Service\AuthentificationService;
use App\Http\Service\UserService;

class AuthControler extends Controller
{
    protected $authentificationService;
    protected $userService;

    public function __construct(AuthentificationService $authentificationService, UserService $userService)
    {
        $this->authentificationService = $authentificationService;
        $this->userService = $userService;
    }

    public function register()
    {
        return view("authentication.sign-up.basic");
    }
    public function signIn()
    {
        return view("authentication.sign-in.basic");
    }

    public function createUserAccount(RegisterAuthentificationRequest $request)
    {
        $user = $this->authentificationService->register($request);

        return view("authentication.sign-in.basic");
    }

    public function dashboard()
    {
        $user = $this->userService->getAuthentificatedUser();

        if($user){
            return view("layouts.light-sidebar", compact("user"));
        }else{
            redirect()->back();
        }
    }

    public function login(LoginAuthentificationRequest $request)
    {
        $user = $this->authentificationService->loginAdminUser($request);

        if ($user) {
            // Si l'authentification réussit, on redirige vers une page (ex: tableau de bord)
            return redirect()->route('dashboard')->with('success', 'Connexion réussie');
        } else {
            // Si l'authentification échoue, on renvoie une erreur
            return back()->withErrors(['login' => 'Identifiants incorrects'])->withInput();
        }
    }
}

