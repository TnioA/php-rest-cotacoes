<?php

	function cotacoes(){

		$html_font = file_get_contents('https://www.msn.com/pt-br/dinheiro/cotacao-do-dolar');
		
		$get_box1 = explode('<div class="mjrcurrncsrow mjcurrncs-data">', $html_font);
		$get_box2 = explode('<div class="ad" id="currncs-ad">', $get_box1[1]);
		$moedas_box = $get_box2[0];
		$moedas_box = explode('<div class="mcrow">', $moedas_box);

		//echo(count($moedas_box));

		$moedas = array('moedas' => array());

		
		for ($i=1; $i < count($moedas_box); $i++) { 
			//nome-moeda
			$get_name = explode('<span class="cnvrsncol">', $moedas_box[$i]);
			$get_name = explode(")'>", $get_name[0]);
			$get_name = explode('</p></span>', $get_name[1]);

			//valor-moeda
			$get_value = explode('<span class="pricecol">', $moedas_box[$i]);
			$get_value = explode('</p></span>', $get_value[1]);
			$get_value = explode('">', $get_value[0]);
			
			//tratamento
			$get_value[1] = str_replace(',', '.', $get_value[1]);

			if(strpos($get_name[0], 'Estados Unidos')){
				$get_flag = 'usa';
			}
			if(strpos($get_name[0], 'Europa')){
				$get_flag = 'european_union';
			}
			if(strpos($get_name[0], 'Argentina')){
				$get_flag = 'argentina';
			}
			if(strpos($get_name[0], 'Reino Unido')){
				$get_flag = 'united_kingdom';
			}
			if(strpos($get_name[0], 'México')){
				$get_flag = 'mexico';
			}
			if(strpos($get_name[0], 'Chile')){
				$get_flag = 'chile';
			}
			if(strpos($get_name[0], 'Uruguai')){
				$get_flag = 'uruguay';
			}
			if(strpos($get_name[0], 'Japão')){
				$get_flag = 'japan';
			}
			if(strpos($get_name[0], 'China')){
				$get_flag = 'china';
			}
			if(strpos($get_name[0], 'Suíça')){
				$get_flag = 'switzerland';
			}
			if(strpos($get_name[0], 'África do Sul')){
				$get_flag = 'south_africa';
			}
			if(strpos($get_name[0], 'Austrália')){
				$get_flag = 'australia';
			}
			if(strpos($get_name[0], 'Canadá')){
				$get_flag = 'canada';
			}
			if(strpos($get_name[0], 'Cingapura')){
				$get_flag = 'singapore';
			}

			array_push($moedas['moedas'], array(
				'bandeira' => 'http://restcotacoes.herokuapp.com/icons/'.$get_flag.'.ico',
				'nome' => $get_name[0],
				'valor' => 'R$'.number_format((float)$get_value[1], 2, '.', '')
			));
		}

		$json_str = json_encode($moedas);
		return($json_str);
	}

	print(cotacoes());
?>
