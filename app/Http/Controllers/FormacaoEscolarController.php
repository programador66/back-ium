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

    public function newFormacao(Request $request)
    {
//        print_r($request['formacao']);exit();
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

}
