<?php

namespace App\Services;


use App\Models\FormacaoEscolar;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class FormacaoEscolarService
{

    /**
     *  @var Formacao
     */
    private $formacao;


    public function __construct(FormacaoEscolar $formacao)
    {

        $this->formacao = $formacao;
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
                $this->formacao->create([
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

    /**
     * @author Caio César
     * @date 11/02/2019
     * @return array formação
     */
    public function updateFormacao(array $dados): array
    {
        try{
            DB::beginTransaction();

            $updateFormacao = $this->formacao->findOrFail($dados['id_curso']);
            $updateFormacao->curso = $dados['curso'];
            $updateFormacao->instituicao = $dados['instituicao'];
            $updateFormacao->data_inicio = $dados['inicio'];
            $updateFormacao->data_conclusao = $dados['conclusao'];

            $updateFormacao->save();

            DB::commit();
            return [
                'success' => true,
                'message' => 'formação atualizada com sucesso!'
            ];

        } catch (\Throwable $exception) {
            DB::rollBack();
            return [
                'success' => false,
                'error'   => $exception->getMessage(),
                'message' => 'Erro ao atualizar as informações'
            ];
        }

    }

    /**
     * @author Caio César
     * @date 11/02/2019
     * @return  array com exclusão
     */
    public function deleteFormacao($id)
    {
        try{
            DB::beginTransaction();

            $deletaFormacao = $this->formacao->find($id);

            $deletaFormacao->delete();

            DB::commit();
            return [
                'success' => true,
                'message' => 'formação deletada!'
            ];

        } catch (\Throwable $exception) {
            DB::rollBack();
            return [
                'success' => false,
                'error'   => $exception->getMessage(),
                'message' => 'Erro ao deletar informações'
            ];
        }

    }

}
