<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Service\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Service\AuthentificationService;
use App\Http\Requests\Api\RegisterAuthRequest;
use App\Http\Requests\LoginAuthentificationRequest;
use App\Http\Requests\RegisterAuthentificationRequest;

class AuthControler extends Controller
{
    protected $authentificationService;
    protected $userService;


    public function __construct(AuthentificationService $authentificationService, UserService $userService)
    {
        $this->authentificationService = $authentificationService;
        $this->userService = $userService;
    }

    public function createUserAccount(RegisterAuthRequest $request)
    {
        $user = $this->authentificationService->register($request);

        return new UserResource($user);
    }

    public function getUsers()
    {
        return UserResource::collection($this->userService->getAllUsers());
    }

    public function findUser($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function UpdateUser(RegisterAuthRequest $request, $id)
    {
        $user = $this->userService->UpdateUser($request, $id);
        return new UserResource($user);
    }

    public function DeleteUser($id)
    {
        $user = $this->userService->deleteUser($id);
    }

    public function login(LoginAuthentificationRequest $request)
    {
        $user = $this->authentificationService->loginAdminUser($request);
        if ($user) {
            // Si l'authentification réussit, on renvoi un message de suces dans le json
            return response()->json(['succes' => 'Connexion réussie']);
        } else {
            // Si l'authentification échoue, on renvoie une erreur dans le json
            return response()->json(['login' => 'Identifiants incorrects']);
        }
    }
}
