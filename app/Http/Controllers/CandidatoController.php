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
        // $validacao =  Validator::make($request->all(), [
        //     'name' => ['required'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
        
        // if ($validacao->fails()) {
        //     return implode(" ", $validacao->errors()->all());
        // }
        
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

    
}
