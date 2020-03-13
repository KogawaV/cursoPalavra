<?php

    include './config.php';
    include './../connection.php';

    $notificationCode = preg_replace('/[^[:alnum:]-]/','', $_POST["notificationCode"]);

    $data["email"] = EMAIL_PAGSEGURO;
    $data["token"] = TOKEN_PAGSEGURO;

    $data = http_build_query($data);

    echo $data;

    $url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$data;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    $xml = curl_exec($curl);
    curl_close($curl);

    $xml = simplexml_load_string($xml);

    $reference = $xml->reference;
    $status = $xml->status;
    $cod_trans = $xml->code;

    if($reference && $status && $cod_trans){
        $query_consulta = "SELECT * FROM pagamento WHERE cod_transacao = :cod_trans";
        $consulta = $conn->prepare($query_consulta);
        $consulta->bindParam(':cod_trans', $xml->code, PDO::PARAM_STR);
        $run = $consulta->execute();
        $rs = $consulta->fetch(PDO::FETCH_ASSOC);

        if($rs){
            $query_update = "UPDATE pagamento SET status_pagamento = :status_pag WHERE cod_transacao = :cod_trans";
            $atualizar = $conn->prepare($query_update);
            $atualizar->bindParam(':status_pag', $status, PDO::PARAM_INT);
            $atualizar->bindParam(':cod_trans', $xml->code, PDO::PARAM_STR);
            $atualizar->execute();

            $id_aluno;

            if($status == 3){
                $sql_pega_id_aluno = "SELECT * FROM pagamento p INNER JOIN carrinho c ON p.identificador_carrinho = c.identificador_carrinho WHERE p.cod_transacao = $cod_trans";
                $sql_pega_id_aluno_result = mysqli_query($conn, $sql_pega_id_aluno);
                while($row = mysqli_fetch_array($sql_pega_id_aluno_result)){
                    $id_aluno = $row['id_aluno'];
                }

                $update_status_pagamento_aluno = "UPDATE aluno SET acesso = 1 WHERE id_aluno = $id_aluno";
                $update_status_pagamento_aluno_result = mysqli_query($conn, $update_status_pagamento_aluno);
            }
        }
    }

?>