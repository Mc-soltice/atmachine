<?php

namespace App\Http\Repositories;

use App\Models\User;
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


    public function getAllUsers()
    {
        return User::with('bankAccount')->orderBy('id', 'desc')->get();
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
