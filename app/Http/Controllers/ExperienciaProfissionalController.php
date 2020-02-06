<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExperienciaProfissionalService;
use Illuminate\Support\Facades\Validator;

class ExperienciaProfissionalController extends Controller
{

    /**
    * @var ExperienciaProfissionalService
    */
    private $experienciaProfissionalService;

    public function __construct(ExperienciaProfissionalService $experienciaProfissionalService)
    {
        $this->experienciaProfissionalService = $experienciaProfissionalService;
    }

    public function newExperienciaProfissional(Request $request)
    {
//        print_r($request->all());exit();
        $response = $this->experienciaProfissionalService->newExperienciaProfissional($request['experiencia']);

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
