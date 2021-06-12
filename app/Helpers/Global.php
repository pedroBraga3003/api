<?php

use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as HttpFoundation;

if(!function_exists('retorno')) {
    function retorno($dados = [], $statusCode = 200, $mensagem = null, $error = null, array $headers = [], $options = 0){
        $retorno = [];
        $retorno['statusCode'] = $statusCode;
        $retorno['data'] = $dados;
        if(!empty($mensagem)){
            $message = $mensagem;
        }else{
            $message = HttpFoundation::$statusTexts[$statusCode];
        }
        $retorno['message'] = $message;
        if(!empty($error)){
            $retorno['error'] = $error;
        }
        return Response::json($retorno, $statusCode, [], JSON_PRETTY_PRINT);
    }
}

/**
 * https://stackoverflow.com/questions/20771239/how-to-display-a-readable-array-laravel
 * 
 */
if(!function_exists('debugLaravel')) {
    function debugLaravel($var){
        array_map(function($var) { 
            print_r($var); 
            // var_dump($x); 
        }, func_get_args()); 
        die;

        // echo '<pre>';
        // die(var_dump($variable));
        // echo '</pre>';
    }
}
if(!function_exists('calcularValorParcela')) {
    function calcularValorParcela($valor_emprestimo,$valor_coeficiente){
        return \App\Helpers\FormataHelper::formataValor($valor_emprestimo * $valor_coeficiente,false, '.');
    }
}