<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Http\Resources\ClienteCollection;
use App\Http\Resources\ClienteResource;
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
        return new ClienteCollection(Cliente::all());
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
        return new ClienteResource(Cliente::findOrFail($request['id']));
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
