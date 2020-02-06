<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CertificadoService;


class CertificadoController extends Controller
{

    /**
    * @var CertificadoService
    */
    private $certificadoService;

    public function __construct(CertificadoService $certificadoService)
    {
        $this->certificadoService = $certificadoService;
    }

    public function newCertificado(Request $request)
    {
//        print_r($request->all());exit();
        $response = $this->certificadoService->newCertificado($request['certificacao']);

        if (!$response['success']) {
            return Response()->Json([
                'success'   => false,
                'error'     => $response['error'],
                'message'   => $response['message']
            ],400);
        }

        return Response()->Json([
            'success' => true,
            'message' => $response['message']
        ],201);

    }

}
