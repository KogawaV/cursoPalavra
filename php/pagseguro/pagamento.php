<?php

include 'config.php';
//session_start();
$url = URL_PAGSEGURO."sessions?email=".EMAIL_PAGSEGURO."&token=".TOKEN_PAGSEGURO;

//http://br2.php.net/manual/pt_BR/function.curl-setopt.php

/*$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);*/

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, true);

$retorno = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($retorno);
echo json_encode($xml);