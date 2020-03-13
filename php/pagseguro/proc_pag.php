<?php
    include './config.php';
    include './../connection.php';

    $Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    $DadosArray["email"] = EMAIL_PAGSEGURO;
    $DadosArray["token"] = TOKEN_PAGSEGURO;

    $DadosArray["paymentMode"] = "default";
    $DadosArray["paymentMethod"] = $Dados['paymentMethod'];
    
    $DadosArray["receiverEmail"] = $Dados['receiverEmail'];
    $DadosArray["currency"] = $Dados['currency'];
    $DadosArray["extraAmount"] = $Dados['extraAmount'];

    $query_car = "SELECT * FROM tipos_planos tp INNER JOIN carrinho car ON tp.id_tipo_plano = car.identificador_compra WHERE identificador_carrinho = {$Dados['reference']}";
    $query_car_result = mysqli_query($conn, $query_car);

   
    $cont_item = 1;
    
    //$total_venda = number_format($Dados['amount'], 2, '.', '');

    $DadosArray["itemId{$cont_item}"] = $Dados['id_plano'];
    $DadosArray["itemDescription{$cont_item}"] = $Dados['nome_plano'];

    $DadosArray["itemAmount{$cont_item}"] = $Dados['amount'];
    $DadosArray["itemQuantity{$cont_item}"] = 1;

    $DadosArray["notificationURL"] = $Dados['notificationURL'];
    $DadosArray["reference"] = $Dados['reference'];
    $DadosArray["senderName"] = $Dados['senderName'];
    $DadosArray["senderCPF"] = $Dados['senderCPF'];
    $DadosArray["senderAreaCode"] = $Dados['senderAreaCode'];
    $DadosArray["senderPhone"] = $Dados['senderPhone'];
    $DadosArray["senderEmail"] = $Dados['senderEmail'];
    $DadosArray["senderHash"] = $Dados['hashCartao'];
    $DadosArray["shippingAddressRequired"] = $Dados['shippingAddressRequired'];
    if($Dados['paymentMethod'] == 'creditCard'){
    $DadosArray["creditCardToken"] = $Dados['creditCardToken'];
    $DadosArray["installmentQuantity"] = $Dados['installmentQuantity'];
    $DadosArray["installmentValue"] = $Dados['installmentValue'];
    $DadosArray["noInterestInstallmentQuantity"] = $Dados['noInterestInstallmentQuantity'];
    $DadosArray["creditCardHolderName"] = $Dados['creditCardHolderName'];
    $DadosArray["creditCardHolderCPF"] = $Dados['creditCardHolderCPF'];
    $DadosArray["creditCardHolderBirthDate"] = $Dados['creditCardHolderBirthDate'];
    $DadosArray["creditCardHolderAreaCode"] = $Dados['senderAreaCode'];
    $DadosArray["creditCardHolderPhone"] = $Dados['senderPhone'];
    $DadosArray["billingAddressStreet"] = $Dados['billingAddressStreet'];
    $DadosArray["billingAddressNumber"] = $Dados['billingAddressNumber'];
    $DadosArray["billingAddressComplement"] = $Dados['billingAddressComplement'];
    $DadosArray["billingAddressDistrict"] = $Dados['billingAddressDistrict'];
    $DadosArray["billingAddressPostalCode"] = $Dados['billingAddressPostalCode'];
    $DadosArray["billingAddressCity"] = $Dados['billingAddressCity'];
    $DadosArray["billingAddressState"] = $Dados['billingAddressState'];
    $DadosArray["billingAddressCountry"] = $Dados['billingAddressCountry'];
    }elseif($Dados['paymentMethod'] == 'boleto'){

    }elseif($Dados['paymentMethod'] == 'eft'){
        $DadosArray["bankName"] = $Dados['bankName'];
    }
    $buildQuery = http_build_query($DadosArray);
    $url = URL_PAGSEGURO . "transactions";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);
    $retorno = curl_exec($curl);
    curl_close($curl);
    $xml = simplexml_load_string($retorno); 

    $tipo_pagamento = $xml->paymentMethod->type;
    $codigo_transacao = $xml->code;
    $status_pagamento = $xml->status;
    $carrinho_id = $xml->reference;
    $link_boleto = $xml->paymentLink;
    $link_deb_online = $xml->paymentLink;

    if($xml->paymentMethod->type == 1){
        $result_cadastrar = "INSERT INTO pagamento(tipo_pagamento, cod_transacao, status_pagamento, identificador_carrinho, data_compra) VALUES ($tipo_pagamento, '$codigo_transacao', $status_pagamento, $carrinho_id, NOW())";
        
    }elseif($xml->paymentMethod->type == 2){
        $result_cadastrar = "INSERT INTO pagamento(tipo_pagamento, cod_transacao, status_pagamento, link_boleto, identificador_carrinho, data_compra) VALUES ($tipo_pagamento, '$codigo_transacao', $status_pagamento, '$link_boleto', $carrinho_id, NOW())";
        
    }elseif($xml->paymentMethod->type ==3){
        $result_cadastrar = "INSERT INTO pagamento(tipo_pagamento, cod_transacao, status_pagamento, link_deb_online, identificador_carrinho, data_compra) VALUES ($tipo_pagamento, '$codigo_transacao', $status_pagamento, '$link_deb_online', $carrinho_id, NOW())";
        
    }
      
    $result_cadastrar_result = mysqli_query($conn, $result_cadastrar);

    $retorna = ['erro' => true, 'dados' => $xml, 'DadosArray' => $DadosArray];
    header('Content-Type: application/json');
    echo json_encode($retorna);
?>