<?php

	function cotacoes(){
		$html_font = file_get_contents('https://financeone.com.br/moedas/cotacoes-do-real-e-outras-moedas/');

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
		$recbitcoin = explode('<p><b>Bitcoin</b></p>', $html_font);
		$recbitcoin = explode('</p>', $recbitcoin[1]);
		$recbitcoin = explode('<p>',  $recbitcoin[0]);

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


		$moedas = array('moedas' => array(
			array(
				'nome' => 'Dolar',
				'valor' => $recdolar[1]
			),
			array(
				'nome' => 'Euro',
				'valor' => $receuro[1]
			),
			array(
				'nome' => 'Libra',
				'valor' => $reclibra[1]
			),
			array(
				'nome' => 'Peso',
				'valor' => $recpeso[1]
			),
			array(
				'nome' => 'Bitcoin',
				'valor' => $recbitcoin[1]
			),
			array(
				'nome' => 'Litecoin',
				'valor' => $reclitecoin[1]
			),
			array(
				'nome' => 'Ripple',
				'valor' => $recripple[1]
			),
			array(
				'nome' => 'Ethereum',
				'valor' => $recethereum[1]
			)
		));

		$json_str = json_encode($moedas);
		return($json_str);
	}


	print(cotacoes());
?>
