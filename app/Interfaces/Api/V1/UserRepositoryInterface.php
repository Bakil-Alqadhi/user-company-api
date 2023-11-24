<?php 

namespace App\Interfaces\Api\V1;

interface UserRepositoryInterface  {
    public function getAllUsers();
    public function storeUser($data);
    public function getUserById($user);
    public function updateUser($data, $user);
}