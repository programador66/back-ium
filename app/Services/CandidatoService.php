<?php

namespace App\Services;

use App\Candidato;
use App\FormacaoEscolar;
use App\User;
use Error;
use Illuminate\Support\Facades\DB;

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

    /**
     *  @var Formacao
     */
    private $formacaoService;


    public function __construct(User $userService, Candidato $candidatoService, FormacaoEscolar $formacaoService)
    {
        $this->userService = $userService;
        $this->candidatoService = $candidatoService;
        $this->formacaoService = $formacaoService;
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
    
    /**
     * @author Caio César
     * @date 01/11/2019
     * @return novo candidato
     */
    public function newFormacao(array $dados): array
    {   
        try{
            DB::beginTransaction();

            foreach ($dados as $formacao){
                $this->formacaoService->create([
                    'curso'          => $formacao['curso'],
                    'instituicao'    => $formacao['instituicao'],
                    'data_inicio'    => $formacao['data_inicio'],
                    'data_conclusao' => $formacao['data_conclusao'],
                    'candidato_id'   => $formacao['id_user']
                ]);
            }
            
            DB::commit();
            return [
                'success' => true,
                'message' => 'formações cadastrado com sucesso!'
            ];

        } catch (\Throwable $exception) {
            DB::rollBack();
            return [
                'success' => false,
                'error'   => $exception->getMessage(),
                'message' => 'Erro ao inserir os dados do usuário'   
            ];
        }

    }


    /**
     * @author Caio César
     * @date 01/11/2019
     * @return  candidato
     */
    public function getCurriculo(): array
    {   
        try{
            
            $response = $this->candidatoService->find(1)->with('formacaoEscolar')->get();
            
            return [
                'success' => true,
                'data' => $response
            ];

        } catch (\Throwable $exception) {
            
            return [
                'success' => false,
                'error'   => $exception->getMessage(), 
            ];
        }

    }

}
 