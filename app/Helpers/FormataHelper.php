<?php

/**
 * Classe de utilidades para o sistema
 * @version 1
 * @author Pedro <pero.phnb@gmail.com>
 */

namespace App\Helpers;
//Exemplo - {{ \App\Helpers\CustomHelper::fooBar() }}


class FormataHelper {

    /**
	 * Transforma o numero em float
	 * 
	 * 
	 * @param unknown $num
	 * @return number
	 */
	public static function tofloat($num){
		$dotPos = strrpos($num, '.');
		$commaPos = strrpos($num, ',');
		$sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
		((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
		if (!$sep) 
		{
			return floatval(preg_replace("/[^0-9]/", "", $num));
		}
		return floatval(
				preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
				preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
		);
    }
    /**
	 * Formata um número de acordo com o padrão
	 * monetário estabelecido.
	 *
	 * @param  $number             - o numero que será formatado
	 * @param  $decimals[optional] - quantas casas decimais terá
	 * @param  $thousand[optional] - se usará separador de milhar
	 * @return string
	 * @access public
	 */
	public static function formataValor($number, $decimals = false, $dec_point = false, $thousand = false){
		// transforma o valor para float
		$number = self::tofloat($number);
		// verifica se é um número válido
		if ( $number === false ){
			return false;
        }
		// formata o número
		return (string) number_format(
				$number,
				$decimals  === false ? '2'  : $decimals,
				$dec_point === false ? ','  : $dec_point,
				$thousand  === false ? '.'  : $thousand
		);
    }

}