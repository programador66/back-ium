<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FormacaoEscolarService;
use Illuminate\Support\Facades\Validator;

class FormacaoEscolarController extends Controller
{

    /**
    * @var FormacaoEscolarService
    */
    private $formacaoEscolarService;

    public function __construct(FormacaoEscolarService $formacaoEscolarService)
    {
        $this->formacaoEscolarService = $formacaoEscolarService;
    }

    /*
     * @author Caio César Lacerda
     * @controller cria nova formação
     * @date 11/02/2020
     */
    public function newFormacao(Request $request)
    {

        $response = $this->formacaoEscolarService->newformacao($request['formacao']);

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

    /*
     * @author Caio César Lacerda
     * @controller Atualiza formação
     * @date 11/02/2020
     */
    public function updateFormacao(Request $request)
    {

        $response = $this->formacaoEscolarService->updateformacao($request['formacao']);

        if (!$response['success']) {
            return Response()->Json([
                'success'   => false,
                'error'     => $response['error'],
                'message'   => $response['message']
            ],200);
        }

        return Response()->Json([
            'success' => true,
            'message' => $response['message']
        ],201);

    }

    /*
     * @author Caio César Lacerda
     * @controller Atualiza formação
     * @date 11/02/2020
     */
    public function deleteFormacao(Request $request)
    {

        $response = $this->formacaoEscolarService->deleteformacao($request['id']);

        if (!$response['success']) {
            return Response()->Json([
                'success'   => false,
                'error'     => $response['error'],
                'message'   => $response['message']
            ],200);
        }

        return Response()->Json([
            'success' => true,
            'message' => $response['message']
        ],201);

    }
}
