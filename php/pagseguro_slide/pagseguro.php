<?php

$pedido = $_POST["idPedido"];

$data['token'] ='3f215335-8b15-48e5-b352-9abc3d5e20c45b71dd50412c963b6a5694fa368f53e5faee-0976-4bea-b211-3bc540b68073';
$data['email'] = 'k219594@dac.unicamp.br';
$data['currency'] = 'BRL';
$data['itemId1'] = '1';
$data['itemQuantity1'] = '1';
$data['itemDescription1'] = 'Produto de Teste'.$pedido;
$data['itemAmount1'] = '299.00';

$url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

$data = http_build_query($data);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$xml= curl_exec($curl);

if($xml == 'Unauthorized'){
    $return = 'Não Autorizado';
    echo $return;
    exit;
    }


curl_close($curl);

$xml= simplexml_load_string($xml);
if(count($xml -> error) > 0){
    $return = 'Dados Inválidos '.$xml ->error-> message;
    echo $return;
    exit;
    }
echo $xml -> code;
?>