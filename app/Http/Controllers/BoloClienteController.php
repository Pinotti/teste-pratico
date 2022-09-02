<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoloClienteCollection;
use App\Models\BoloCliente;
use Exception;
use Illuminate\Http\Request;

class BoloClienteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = variaveisInsert();

        try {
            BoloCliente::create($request->all());
        } catch (Exception $e) {
            $dados = setVariaveisErro($e->getMessage());
        }

        return returnDefault($dados['sucesso'], $dados['mensagem'], array(), $dados['status']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
