<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Requests;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Requests;

class AuthentificationRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function register(array $data)
    {
        return $this->model->create($data);
    }
    public function loginAdminUser(array $data)
    {
        // Tenter de connecter l'utilisateur avec les informations fournies
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            // Si la tentative de connexion est réussie, retourner l'utilisateur authentifié
            return Auth::user();
        }

        // Si l'authentification échoue, retournez un message ou gérez l'erreur
        return null;
    }
    
    public function getAll()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {

        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return true;
    }
}
