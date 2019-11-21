<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    /**
    * @var UserService
    */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function newUser(Request $request)
    {
        $validacao =  Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        if ($validacao->fails()) {
            return implode(" ", $validacao->errors()->all());
        }
        
        $response = $this->userService->newUser($request['email'], $request['password'], $request['name'], 'C');
        
        if (!$response['success']) {
            return Response()->Json([
                'success' => false,
                'error' => $response['error']
            ],500); 
        }
        
        return Response()->Json([
            'success' => true,
            'message' => $response['message'],
            'data'    => $response['data']
        ],201);

    }

    public function  getUser()
    {
       $response =  $this->userService->getUser();
       
       return Response()->Json([
            'success' => true,
            'data' => $response
       ],200);
    }

    public function login(Request $request)
    {
        
        $validacao =  Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);
        
        if ($validacao->fails()) {
            return Response()->Json([
                'validate' => true,
                'data' => $validacao->errors()
            ],200); 
        }  

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'] ])) {
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;
            
            return Response()->Json([
                'success' => true,
                'data'    => $user  
            ],200) ;

        } else {

            return Response()->Json([
                'success' => false,
                'message' => 'Usuário ou senha inválido!'
           ],400);
        }
    }
}
