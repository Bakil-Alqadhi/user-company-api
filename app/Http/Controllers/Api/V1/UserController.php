<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Interfaces\Api\V1\UserRepositoryInterface;
use App\Http\Requests\Api\V1\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\Helper;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    public function index(){
        return response()->json(
            [
                'data' => $this->userRepository->getAllUsers()
            ],
            200
        );
    } 

    
    public function store(UserRequest $request) 
    {
        $data = $request->only([
            'first_name',
            'last_name',
            'phone_number'
        ]);

        $data['avatar'] = Helper::handleLogo($request->file('avatar'));
        return response()->json(
            [
                'data' => $this->userRepository->storeUser($data)
            ],
            201
        );
        
    }

    public function show(User $user) 
    {
        return response()->json(
            [
                'data' => $this->userRepository->getUserById($user)
            ],
            200
        );

    }

    public function update(UserRequest $request, User $user)
    {
        try {
                $data = $request->validated();
                if($request->hasFile('avatar')){

                    $data['avatar'] = Helper::handleLogo($request->file('avatar'));
                } 

                return response()->json(
                    [
                        'message' => "User's data updated successfully",
                        'data' => $this->userRepository->updateUser($data, $user)
                    ],
                    200
                );
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(User $user)
    {
        try{
            // Delete the user
            $user->delete();

            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);   
        }
    }
}
