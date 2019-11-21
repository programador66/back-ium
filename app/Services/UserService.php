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
    

    
    /**
     * @author Caio César
     * @date 11/11/2019
     * @return nova formação escolar
     */
    public function formacaoEscolar(String $cpf, String $curso, String $instituicao, String $data_inicio, String $data_conclusao): array
    { 
        try {

            $fk_user = $this->userService
                ->where('cpf',$cpf)
                ->get();

            dd($fk_user);    

            $formacaoCreated = $this->formacaoEscolar->create([
                'cpf'             => $cpf,
                'curso'           => $curso,
                'instituicao'     => $instituicao,
                'data_inicio'     => $data_inicio,
                'data_conclusao'  => $data_conclusao,
                'candidato_id'    => 1
            ]);

            return []; 
        } catch (\Throwable $exception) {
            return [
                'success' => false,
                'error'   => $exception->getMessage()  
            ]; 
        }
      
    }    

}
 