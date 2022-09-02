<?php

namespace App\Http\Controllers;

use App\Jobs\EnviarEmail;
use App\Models\Bolo;
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
            $boloCliente = BoloCliente::create($request->all());
            $bolo = Bolo::find($boloCliente->bolo_id);
            if($bolo->quantidade > 0) {
                EnviarEmail::dispatch($bolo);
            }
        } catch (Exception $e) {
            $dados = setVariaveisErro($e->getMessage());
        }

        return returnDefault($dados['sucesso'], $dados['mensagem'], array(), $dados['status']);
    }

}
