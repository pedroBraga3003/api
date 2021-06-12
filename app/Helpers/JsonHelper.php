<?php

/**
 * Classe para retornar dados json
 * @author Pedro <pedro.phnb@gmail.com>
 */

namespace App\Helpers;
class JsonHelper {
    /**
     * Listar convenios
     *
     * @return void
     */
    public static function convenios(){
        $json = file_get_contents( public_path("/json/convenios.json") );
        return json_decode($json, true);
    }
    /**
     * Listar institucoes
     *
     * @return void
     */
    public static function institucoes(){
        $json = file_get_contents( public_path("/json/instituicoes.json") );
        return json_decode($json, true);
    }
    /**
     * Listar taxas institucoes
     *
     * @return void
     */
    public static function taxasInstitucoes(){
        $json = file_get_contents( public_path("/json/taxas_instituicoes.json") );
        return json_decode($json, true);
    }

}