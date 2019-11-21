<?php

namespace App\Services;

use App\Candidato;
use App\User;
use Error;

class CandidatoService
{
    /**
     *  @var Candidato
     */
    private $candidatoService;

    /**
     *  @var Candidato
     */
    private $userService;

    

    public function __construct(User $userService, Candidato $candidatoService)
    {
        $this->userService = $userService;
        $this->candidatoService = $candidatoService;
    }


    /**
     * @author Caio César
     * @date 01/11/2019
     * @return novo candidato
     */
    public function newCandidato(String $cpf, String $sexo, String $telefone, String $endereco,$id_user): array
    {   
        try{

            $user = $this->userService->findOrFail($id_user);
           
            $candidato =  $this->candidatoService->create([
                'cpf'        => $cpf,
                'sexo'       => $sexo,
                'telefone'   => $telefone,
                'endereco'   => $endereco,
                'user_id'    => $user->id
            ]);
            
            return [
                'success' => true,
                'message' => 'Usuario cadastrado com sucesso!',
                'data'    => $candidato
            ];

        } catch (\Throwable $exception) {

            return [
                'success' => false,
                'error'   => $exception->getMessage(),
                'message' => 'Erro ao inserir os dados do usuário'   
            ];
        }

    }
    
   

}
 