<?php
	require 'vendor/autoload.php';

	use GuzzleHttp\Client;

	$client = new GuzzleHttp\Client();

	//Chama a página
	$response = $client->get('http://www.guiatrabalhista.com.br/guia/salario_minimo.htm');

	//Pega o content
	$body = (string) $response->getBody()->getContents();

	//Lê a tabela e a coluna tr
	preg_match_all('/<table.*?>(.*?)<\/table>/si', $body, $table);
	preg_match_all('/<tr.*?>(.*?)<\/tr>/si', $table[0][0], $tr);



	//Varre a coluna tr para pegar o td
	$y=0;
	for($i=1;$i<count($tr[0]);$i++){
		
		preg_match_all('/<td.*?>(.*?)<\/td>/si', $tr[0][$i], $td);
		//monta o array
		$salario[$y]['vigencia']     = trim(strip_tags($td[0][0]));
		$salario[$y]['valor_mensal'] = trim(strip_tags($td[0][1]));
		$y++;

	}

	//Printa o array
	echo "<pre>";
	print_r($salario);
	echo "</pre>";


?>