<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\InstituicoesController;
Route::get('instituicoes', [InstituicoesController::class, 'index']);

use App\Http\Controllers\ConveniosController;
Route::get('convenios', [ConveniosController::class, 'index']);

use App\Http\Controllers\TaxasInstituicoesController;
Route::post('taxas-instituicoes', [TaxasInstituicoesController::class, 'index']);