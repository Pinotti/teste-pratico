<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoloRequest;
use App\Http\Resources\BoloCollection;
use App\Http\Resources\BoloResource;
use App\Jobs\EnviarEmail;
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
        return new BoloCollection(Bolo::all());
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
        return new BoloResource(Bolo::findOrFail($request['id']));
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
                if ($request->quantidade > 0) {
                    EnviarEmail::dispatch($bolo);
                }                
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
