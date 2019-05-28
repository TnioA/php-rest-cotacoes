<?php
	
	function cotacoes(){
		
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

	print(cotacoes());
?>
