<?php
	
	function cotacoes1(){
		$html_font = file_get_contents('https://financeone.com.br');

		$get_box1 = explode("<div class='stocks lessContent'>", $html_font);
		$get_box2 = explode("<button type='button' id='moreCurrency'>Mais</button>", $get_box1[1]);
		$moedas_box = $get_box2[0];
		$moedas_box = explode('<div>', $moedas_box);

		$moedas = array('moedas' => array());

		for ($i=1; $i < count($moedas_box); $i++) { 
			//img-moeda
			$get_flag = explode('src="', $moedas_box[$i]);
			$get_flag = explode('">', $get_flag[1]);

			//nome-moeda
			$get_name = explode('<p><b>', $moedas_box[$i]);
			$get_name = explode("</b></p>", $get_name[1]);

			//valor-moeda
			$get_value = explode('<p>', $get_name[1]);
			$get_value = explode('</p>', $get_value[1]);
			
			if(is_numeric($get_value[0][2])){
				$aux = $get_value[0];
			}else{
				$aux = 'R$0,00';
			}
			
			array_push($moedas['moedas'], array(
				'bandeira' => $get_flag[0],
				'nome' => $get_name[0],
				'valor' => $aux
			));
		}
	
		
		$json_str = json_encode($moedas);
		return($json_str);

	}
	/*
	function cotacoes2(){

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
			array_push($moedas['moedas'], array(
				'nome' => $get_name[0],
				'valor' => 'R$'.number_format((float)$get_value[1], 2, '.', '')
			));
		}

		$json_str = json_encode($moedas);
		return($json_str);
	}

	*/
	print(cotacoes1());
?>
