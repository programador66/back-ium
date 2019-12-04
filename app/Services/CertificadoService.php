<?php

namespace App\Services;

use App\Models\Candidato;
use App\Models\Certificado;
use Illuminate\Support\Facades\DB;

class CertificadoService
{
    /**
     *  @var Candidato
     */
    private $candidatoService;

    /**
     *  @var Candidato
     */
    private $certificado;

    public function __construct(Certificado $certificado)
    {

        $this->certificado = $certificado;

    }


    /**
     * @author Caio César
     * @date 04/12/2019
     * @return novo certificado
     */
    public function newCertificado(array $dados): array
    {
        try{
            DB::beginTransaction();

            foreach ($dados as $certificado){

                $this->certificado->create([
                    'emissor'       => $certificado['emissor'],
                    'descricao'     => $certificado['descricao'],
                    'data'          => $certificado['data'],
                    'candidato_id'  => $certificado['id_user']
                ]);
            }

            DB::commit();
            return [
                'success' => true,
                'message' => 'certificados cadastrado com sucesso!'
            ];

        } catch (\Throwable $exception) {
            DB::rollBack();
            return [
                'success' => false,
                'error'   => $exception->getMessage(),
                'message' => 'Erro ao inserir os certificados do usuário'
            ];
        }

    }




}
 