<?php 
namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Requests;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Requests;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAuthentificatedUser()
    {
        return Auth::user();
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