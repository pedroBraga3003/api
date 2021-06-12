<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConveniosController extends Controller
{
    /**
     * Buscar convenios
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        return \App\Helpers\JsonHelper::convenios();
    }
}
