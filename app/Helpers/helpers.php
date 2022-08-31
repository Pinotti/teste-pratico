<?php

function returnDefault($sucesso, $mensagem, $dados, $status=200)
{
    return response([
            'success' => $sucesso,
            'message' => $mensagem,
            'response' => $dados
        ], $status);
}

function variaveisGet()
{
    $dados['mensagem'] = 'Busca realizada com sucesso';
    $dados['sucesso']  = true;
    $dados['status']   = 200;

    return $dados;
}

function variaveisInsert()
{
    $dados['mensagem'] = 'Dados inseridos com sucesso';
    $dados['sucesso']  = true;
    $dados['status']   = 201;

    return $dados;
}

function variaveisUpdate()
{
    $dados['mensagem'] = 'Dados atualizados com sucesso';
    $dados['sucesso']  = true;
    $dados['status']   = 200;

    return $dados;
}

function variaveisDelete()
{
    $dados['mensagem'] = 'Registro deletado com sucesso';
    $dados['sucesso']  = true;
    $dados['status']   = 200;

    return $dados;
}

function setVariaveisErro($mensagem, $sucesso=false, $status=500)
{
    $dados['mensagem'] = $mensagem;
    $dados['sucesso']  = $sucesso;
    $dados['status']   = $status;
    $dados['registros'] = array();

    return $dados;
}

function setVariaveisNaoEncontrado($mensagem="Registro não encontrado", $sucesso=false, $status=500)
{
    $dados['mensagem'] = $mensagem;
    $dados['sucesso']  = $sucesso;
    $dados['status']   = $status;

    return $dados;
}

?>
