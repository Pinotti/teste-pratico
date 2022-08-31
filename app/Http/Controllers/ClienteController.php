<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Cliente::orderBy('nome')->get();
        $sucesso = true;
        $mensagem = 'Busca realizada com sucesso';
        
        return response([
            'succes' => $sucesso,
            'message' => $mensagem,
            'response' => $dados
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        $dados = variaveisInsert();

        try {
            Cliente::create($request->all());
        } catch (Exception $e) {
            $dados = setVariaveisErro($e->getMessage());
        }

        return returnDefault($dados['sucesso'], $dados['mensagem'], array(), $dados['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $dados = variaveisGet();
            $dados['registros'] = Cliente::find($request['id']);

            if (!$dados['registros']) {
                $dados = setVariaveisNaoEncontrado();
                $dados['registros'] = array();
            }
        } catch (Exception $e) {
            $dados = setVariaveisErro($e->getMessage());
        }

        return returnDefault($dados['sucesso'], $dados['mensagem'], $dados['registros'], $dados['status']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request)
    {
        try {
            $dados = setVariaveisNaoEncontrado();
            $cliente = Cliente::find($request->input('id'));
            if ($cliente) {
                $cliente->update($request->all());
                $dados = variaveisUpdate();
            }
        } catch (Exception $e) {
            $dados = setVariaveisErro($e->getMessage());
        }

        return returnDefault($dados['sucesso'], $dados['mensagem'], array(), $dados['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $dados = setVariaveisNaoEncontrado();
            $cliente = Cliente::find($request->id);
            if ($cliente) {
                $cliente->delete();
                $dados = variaveisDelete();
            }
        } catch (Exception $e) {
            $dados = setVariaveisErro($e->getMessage());
        }

        return returnDefault($dados['sucesso'], $dados['mensagem'], array(), $dados['status']);
    }
}
