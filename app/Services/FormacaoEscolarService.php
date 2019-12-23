<?php

namespace App\Services;


use App\Models\FormacaoEscolar;
use Illuminate\Support\Facades\DB;

class FormacaoEscolarService
{

    /**
     *  @var Formacao
     */
    private $formacaoService;


    public function __construct(FormacaoEscolar $formacaoService)
    {

        $this->formacaoService = $formacaoService;
    }


    /**
     * @author Caio César
     * @date 22/11/2019
     * @return nova formação
     */
    public function newFormacao(array $dados): array
    {
        try{
            DB::beginTransaction();

            foreach ($dados as $formacao){
                $this->formacaoService->create([
                    'curso'          => $formacao['curso'],
                    'instituicao'    => $formacao['instituicao'],
                    'data_inicio'    => $formacao['inicio'],
                    'data_conclusao' => $formacao['conclusao'],
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


}
