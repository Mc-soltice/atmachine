<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Requests;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAuthentificatedUser()
    {
        return Auth::user();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function getAllUsers(){
        return User::orderBy('id', 'desc')->get();
    }
    
    public function findById($id){
        return User::findOrFail($id);
    }

    public function findByEmail($email){
        return User::where('email', $email)->first();
    }

    public function UpdateUser( $id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);
        return $user;
    }


    public function delete($id)
    {
        $user = $this->findById($id);
                // Vérifier si l'utilisateur existe
        if (!$user) {
            return false;
        }else{
            $user->delete();
            return true;
        }
    }
}
// public function delete($id)
// {
//     try {
//         // Rechercher l'utilisateur par ID
//         $user = $this->findById($id);
        
//         // Vérifier si l'utilisateur existe
//         if (!$user) {
//             return "Utilisateur avec l'ID $id non trouvé.";
//         }

//         // Tenter de supprimer l'utilisateur
//         $user->delete();
        
//         // Retourner un message de succès
//         return "Utilisateur avec l'ID $id a été supprimé avec succès.";
//     } catch (\Exception $e) {
//         // Gérer les exceptions et retourner un message d'erreur
//         return "Une erreur est survenue lors de la suppression de l'utilisateur : " . $e->getMessage();
//     }
// }
