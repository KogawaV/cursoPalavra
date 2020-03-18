<?php

include './../connection.php';

$notificationCode = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationCode"]);
echo $notificationCode;

$data['token'] = '0CE1D9CF08844ED487955888F10D56F7';
$data['email'] = 'k219594@dac.unicamp.br';

$data = http_build_query($data);

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$data;

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$xml = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($xml);

$reference = $xml->reference;
$status = $xml->status;
$id_aluno;



if($reference && $status){

    $sql_select_id_aluno = "SELECT * FROM carrinho WHERE identificador_carrinho = $reference";
    $sql_select_id_aluno_result = mysqli_query($conn, $sql_select_id_aluno);
    
    while($row = mysqli_fetch_array($sql_select_id_aluno_result)){
        $id_aluno = $row['id_aluno'];
    }

    $sql_update_acesso = "UPDATE aluno SET acesso = $status WHERE id_aluno = $id_aluno";

}

?>