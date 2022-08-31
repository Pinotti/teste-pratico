<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoloRequest;
use App\Models\Bolo;
use Exception;
use Illuminate\Http\Request;

class BoloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Bolo::orderBy('nome')->get();
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
     * @param  \App\Http\Requests\BoloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoloRequest $request)
    {
        $dados = variaveisInsert();

        try {
            Bolo::create($request->all());
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
            $dados['registros'] = Bolo::find($request['id']);

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
     * @param  \App\Http\Requests\BoloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(BoloRequest $request)
    {
        try {
            $dados = setVariaveisNaoEncontrado();
            $bolo = Bolo::find($request->input('id'));
            if ($bolo) {
                $bolo->update($request->all());
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
            $bolo = Bolo::find($request->id);
            if ($bolo) {
                $bolo->delete();
                $dados = variaveisDelete();
            }
        } catch (Exception $e) {
            $dados = setVariaveisErro($e->getMessage());
        }

        return returnDefault($dados['sucesso'], $dados['mensagem'], array(), $dados['status']);
    }
}
