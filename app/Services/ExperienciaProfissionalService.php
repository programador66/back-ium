<?php

namespace App\Services;

use App\Models\ExperienciaProfissional;
use Illuminate\Support\Facades\DB;

class ExperienciaProfissionalService
{

    /**
     *  @var Formacao
     */
    private $formacaoService;


    public function __construct(ExperienciaProfissional $formacaoService)
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

            foreach ($dados as $experiencia){
                $this->formacaoService->create([
                    'cargo'       => $experiencia['cargo'],
                    'empresa'     => $experiencia['empresa'],
                    'data_inicio' => $experiencia['inicio'],
                    'data_saida'  => $experiencia['saida'],
                    'candidato_id'=> $experiencia['id_user']
                ]);
            }

            DB::commit();
            return [
                'success' => true,
                'message' => 'Experiencia cadastrada com sucesso!'
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
