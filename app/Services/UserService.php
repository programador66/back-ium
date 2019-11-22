<?php

namespace App\Services;

use App\FormacaoEscolar;
use App\User;
use Error;

class UserService
{
    /**
     *  @var User
     */
    private $userService;

    /**
     *  @var FormacaoEscolar
     */
    private $formacaoEscolar;

    public function __construct(User $userService, FormacaoEscolar $formacaoEscolar)
    {
        $this->userService = $userService;
        $this->formacaoEscolar = $formacaoEscolar;
    }

    /**
     * @author Caio César
     * @date 01/11/2019
     * @return Usuarios
     */
    public function getUser()
    {
        return $this->userService->all();
    }

    /**
     * @author Caio César
     * @date 01/11/2019
     * @return novo usuario
     */
    public function newUser(String $email, String $password, String $name, String $tipo_usuario)
    {   
        try{

            $user =  User::create([
                'email'        => $email,
                'name'         => $name,
                'password'     => \Hash::make($password),
                'tipo_usuario' => $tipo_usuario
            ]);
            
            $user->token = $user->createToken($user->email)->accessToken;
            
            if (!$user){
                throw new \Error('Erro ao inserir o usuario!');
            }

            return [
                'success' => true,
                'message' => ' Usuario cadastrado com sucesso!',
                'data'    => $user
            ];

        } catch (\Throwable $exception) {

            return [
                'success' => false,
                'error'   => $exception->getMessage()   
            ];
        }

    }
    

}
 