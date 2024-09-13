<?php
namespace App\Http\Service;

use App\Http\Repositories\AuthentificationRepository;
use App\Http\Repositories\UserRepository;
use App\Models\User;

class UserService
{

    protected $authentificationRepository;
    protected $userRepository;

    public function __construct(AuthentificationRepository $authentificationRepository, UserRepository $userRepository)
    {
        $this->authentificationRepository = $authentificationRepository;
        $this->userRepository = $userRepository;
    }

    public function getAuthentificatedUser(){
        return $this->userRepository->getAuthentificatedUser();
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
