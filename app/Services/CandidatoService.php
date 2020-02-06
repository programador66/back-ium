<?php

namespace App\Services;

use App\Models\Candidato;
use App\Models\User;
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
     * @date 05/12/2019
     * @return att candidato
     */
    public function candidato(String $cpf, String $sexo, String $telefone, String $endereco,$id_user): array
    {

        $user = $this->userService->findOrFail($id_user);

        $candidato =  [
            'cpf'        => $cpf,
            'sexo'       => $sexo,
            'telefone'   => $telefone,
            'endereco'   => $endereco,
            'user_id'    => $user->id
        ];

        $att = $this->candidatoService
            ->where('user_id', $user->id)
            ->get();

        $response = (collect($att)->count() == 0) ? self::newCandidato($candidato) : self::updateCandidato($candidato);


        return $response;

    }

    /**
     * @author Caio César
     * @date 05/12/2019
     * @return att candidato
     */
    public function updateCandidato($candidato): array
    {
        try{

            $candidatoUpdate = $this->candidatoService->find($candidato['user_id']);

            $candidatoUpdate->cpf = $candidato['cpf'];
            $candidatoUpdate->endereco = $candidato['endereco'];
            $candidatoUpdate->telefone = $candidato['telefone'];
            $candidatoUpdate->sexo = $candidato['sexo'];
            $candidatoUpdate->save();

            return [
                'success' => true,
                'message' => 'Usuario atualizado com sucesso!',
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
     * @date 21/11/2019
     * @return novo candidato
     */
    public function newCandidato($candidato): array
    {
        try{


            $response = $this->candidatoService->create($candidato);


            return [
                'success' => true,
                'message' => 'Usuario cadastrado com sucesso!',
                'data'    => $response
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
     * @date 22/11/2019
     * @return  candidato
     */
    public function getCurriculo(int $id_candidato): array
    {
        try{

            $response = $this->candidatoService->findOrFail($id_candidato)
                ->with(['formacaoEscolar','certificados','experienciaProfissional'])
                ->get();

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
