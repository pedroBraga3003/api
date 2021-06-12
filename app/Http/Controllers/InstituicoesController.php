<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstituicoesController extends Controller
{
    /**
     * Buscar instituicoes
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        return \App\Helpers\JsonHelper::institucoes();
    }
}
