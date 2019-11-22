<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CandidatoService;
use Illuminate\Support\Facades\Validator;

class CandidatoController extends Controller
{
    
    /**
    * @var CandidatoService
    */
    private $candidatoService;

    public function __construct(CandidatoService $candidatoService)
    {
        $this->candidatoService = $candidatoService;
    }

    public function newCandidato(Request $request)
    {
        $validacao =  Validator::make($request->all(), [
            'cpf' => ['required'],
            'endereco' => ['required', 'string'],
            'sexo' => ['required'],
            'telefone' => ['required'],
            'id_user'  => ['required']
        ]);
        
        if ($validacao->fails()) {
            return implode(" ", $validacao->errors()->all());
        }
        
        $response = $this->candidatoService->newCandidato($request['cpf'], $request['sexo'], $request['telefone'],$request['endereco'],$request['id_user']);
        
        if (!$response['success']) {
            return Response()->Json([
                'success'   => false,
                'error'     => $response['error'],
                'message'   => $response['message']
            ],400); 
        }
        
        return Response()->Json([
            'success' => true,
            'message' => $response['message'],
            'data'    => $response['data']
        ],201);

    }

    public function newFormacao(Request $request)
    {

        $response = $this->candidatoService->newformacao($request['formacao']);
        
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

    public function getCurriculo(Request $request)
    {
        $response = $this->candidatoService->getCurriculo($request['id_candidato']);
        
        if (!$response['success']) {
            return Response()->Json([
                'success'   => false,
                'error'     => $response['error']
            ],400); 
        }
        
        return Response()->Json([
            'success' => true,
            'data' => $response['data']
        ],200); 
    }
}
