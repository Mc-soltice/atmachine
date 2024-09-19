<?php
namespace App\Http\Service;

use App\Http\Repositories\AuthentificationRepository;
use App\Models\User;

class AuthentificationService
{

    protected $authentificationRepository;

    public function __construct(AuthentificationRepository $authentificationRepository)
    {
        $this->authentificationRepository = $authentificationRepository;
    }

    public function register($request){
        $data = [];
        $data["email"] = $request->email;
        $data["password"] = $request->password;
        $data["last_name"] = $request->last_name;
        $data["first_name"] = $request->first_name;
        $user = $this->authentificationRepository->register($data);
        return $user;
    }

    
    public function loginAdminUser($request)
    {
        // Récupérer les données d'authentification
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        // Appel au dépôt pour tenter l'authentification
        $user = $this->authentificationRepository->loginAdminUser($data);
    
        // Vérifier si l'utilisateur est authentifié
        if ($user) {
            // Retourner l'utilisateur authentifié
            return $user;
        } else {
            // Si la connexion échoue, retourner une erreur
            return null; // Laissez la gestion de l'erreur au contrôleur
        }
    }
    

 
    


    // public function getAllUsers()
    // {
    //     return $this->authentificationRepository->getAll();
    // }

    // public function createUser(array $data)
    // {
    //     return $this->authentificationRepository->create($data);
    // }

    // public function getUserById($id)
    // {
    //     return $this->authentificationRepository->find($id);
    // }

    // public function updateUser($id, array $data)
    // {
    //     return $this->authentificationRepository->update($id, $data);
    // }

    // public function deleteUser($id)
    // {
    //     return $this->authentificationRepository->delete($id);
    // }
}   
