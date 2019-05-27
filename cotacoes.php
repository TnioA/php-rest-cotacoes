<?php

	function cotacoes(){

		$html_font = file_get_contents('https://www.msn.com/pt-br/dinheiro/cotacao-do-dolar');
		$html_bitcoin = file_get_contents('https://financeone.com.br/moedas/cotacoes-do-real-e-outras-moedas/');


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
		
		/*
		
		//dolar
		$recdolar = explode('<p><b>D&oacute;lar</b></p>', $html_font);
		$recdolar = explode('</p>', $recdolar[1]);
		$recdolar = explode('<p>',  $recdolar[0]);

		//euro
		$receuro = explode('<p><b>Euro</b></p>', $html_font);
		$receuro = explode('</p>', $receuro[1]);
		$receuro = explode('<p>',  $receuro[0]);

		//libra
		$reclibra = explode('<p><b>Libra</b></p>', $html_font);
		$reclibra = explode('</p>', $reclibra[1]);
		$reclibra = explode('<p>',  $reclibra[0]);

		//peso
		$recpeso = explode('<p><b>Peso</b></p>', $html_font);
		$recpeso = explode('</p>', $recpeso[1]);
		$recpeso = explode('<p>',  $recpeso[0]);
		
		

		//bitcoin
		$recbitcoin = explode('<p><b>Bitcoin</b></p>', $html_bitcoin);
		$recbitcoin = explode('</p>', $recbitcoin[1]);
		$recbitcoin = explode('<p>',  $recbitcoin[0]);


		array_push($moedas['moedas'], array(
			'nome' => 'Bitcoin',
			'valor' => $recbitcoin[1]
		));
		
		

		//litecoin
		$reclitecoin = explode('<p><b>Litecoin</b></p>', $html_font);
		$reclitecoin = explode('</p>', $reclitecoin[1]);
		$reclitecoin = explode('<p>',  $reclitecoin[0]);

		//ripple
		$recripple = explode('<p><b>Ripple</b></p>', $html_font);
		$recripple = explode('</p>', $recripple[1]);
		$recripple = explode('<p>',  $recripple[0]);

		//ethereun
		$recethereum = explode('<p><b>Ethereum</b></p>', $html_font);
		$recethereum = explode('</p>', $recethereum[1]);
		$recethereum = explode('<p>',  $recethereum[0]);

		*/

		$json_str = json_encode($moedas);
		return($json_str);
	}


	print(cotacoes());
?>
