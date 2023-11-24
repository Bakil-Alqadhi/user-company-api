<?php 
namespace App\Repositories\Api\V1;

use App\Interfaces\Api\V1\UserRepositoryInterface;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;

class UserRepository implements UserRepositoryInterface  {

    public function getAllUsers(){

        // return UserResource::collection(User::all());
        return User::orderBy('created_at', 'desc')->paginate(3);
    }

    public function storeUser($data){
        $user = User::create($data);
        return new UserResource($user);
    }

    public function getUserById($user) {
        return new UserResource($user);
    }

    public function updateUser($data, $user) {

        $user->fill($data);
        $user->save();
        return new userResource($user);
        
    }

}