<?php

namespace App\Services;


use App\FormacaoEscolar;
use Illuminate\Support\Facades\DB;

class ExperienciaProfissionalService
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
    public function newExperienciaProfissional(array $dados): array
    {   
        try{
            DB::beginTransaction();

            foreach ($dados as $formacao){
                $this->formacaoService->create([
                    'cargo'          => $formacao['cargo'],
                    'empresa'    => $formacao['empresa'],
                    'data_inicio'    => $formacao['data_inicio'],
                    'data_saida' => $formacao['data_saida'],
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
 