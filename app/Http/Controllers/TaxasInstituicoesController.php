<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TaxasInstituicoesController extends Controller
{
    /**
     * Buscar taxasinstituicoes
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $rules = [
            'valor_emprestimo' => 'required',
        ];
        $validacao = Validator::make($request->all(), $rules);
        if($validacao->fails()){
            return retorno('O campo Valor emprestimo é obrigatorio', 400);
        }
        $taxasInstituicoes = [];
        $instituicoes = [];
        $convenios = [];
        $simulacoes = [];
        $taxasInstituicoes = \App\Helpers\JsonHelper::taxasInstitucoes();
        if(!empty($request->instituicoes)){
            $instituicoes = $request->instituicoes;
        }
        if(!empty($request->convenios)){
            $convenios = $request->convenios;
        }
        if(!empty($taxasInstituicoes)){
            if( empty($convenios) && empty($instituicoes)){
                foreach($taxasInstituicoes as $k => $taxa){
                    $simulacao = [];
                    $simulacao['taxa'] = $taxa['taxaJuros'];
                    $simulacao['parcelas'] = $taxa['parcelas'];
                    $simulacao['valor_parcela'] =  calcularValorParcela($request->valor_emprestimo, $taxa['coeficiente']);
                    $simulacao['convenio'] = $taxa['convenio'];
                    $simulacoes[$taxa['instituicao']][] = $simulacao;
                }
            }else{
                $instituicoesConvenios = [];
                if(!empty($instituicoes)){
                    foreach($instituicoes as $k => $instituicao){
                        $convenioInstituicoes[]['instituicao'] =  $instituicao['chave'];
                    }
                }
                if(!empty($convenioInstituicoes) && !empty($convenios)){
                    foreach($convenioInstituicoes as $k => $item){
                        $convenioInstituicoes[$k]['convenios']  = $convenios;
                    }
                }else{
                    $convenioInstituicoes[]['convenios'] = $convenios;
                }
                if(!empty($convenioInstituicoes)){
                    foreach($convenioInstituicoes as $k => $item){
                        if(!empty($item['instituicao'])){
                            if(empty($item['convenios'])){
                                foreach($taxasInstituicoes as $k => $taxa){
                                    if($item['instituicao'] == $taxa['instituicao']){
                                        $simulacao = [];
                                        $simulacao['taxa'] = $taxa['taxaJuros'];
                                        $simulacao['parcelas'] = $taxa['parcelas'];
                                        $simulacao['valor_parcela'] =  calcularValorParcela($request->valor_emprestimo, $taxa['coeficiente']);
                                        $simulacao['convenio'] = $taxa['convenio'];
                                        $simulacoes[$taxa['instituicao']][] = $simulacao;
                                    }
                                }
                            }else{
                                foreach($item['convenios'] as $i => $convenio){
                                    foreach($taxasInstituicoes as $k => $taxa){
                                        if($convenio['chave'] == $taxa['convenio'] && $item['instituicao'] == $taxa['instituicao']){
                                            $simulacao = [];
                                            $simulacao['taxa'] = $taxa['taxaJuros'];
                                            $simulacao['parcelas'] = $taxa['parcelas'];
                                            $simulacao['valor_parcela'] =  calcularValorParcela($request->valor_emprestimo, $taxa['coeficiente']);
                                            $simulacao['convenio'] = $taxa['convenio'];
                                            $simulacoes[$taxa['instituicao']][] = $simulacao;
                                        }
                                    }
                                }
                            }
                        }else{
                            if(!empty($item['convenios'])){
                                foreach($item['convenios'] as $i => $convenio){
                                    foreach($taxasInstituicoes as $k => $taxa){
                                        if($convenio['chave'] == $taxa['convenio']){
                                            $simulacao = [];
                                            $simulacao['taxa'] = $taxa['taxaJuros'];
                                            $simulacao['parcelas'] = $taxa['parcelas'];
                                            $simulacao['valor_parcela'] =  calcularValorParcela($request->valor_emprestimo, $taxa['coeficiente']);
                                            $simulacao['convenio'] = $taxa['convenio'];
                                            $simulacoes[$taxa['instituicao']][] = $simulacao;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return retorno($simulacoes);
    }
}
