<?php

//Necessário testar em dominio com SSL
define("URL", "https://cursopalavraplat.com.br/php/pagseguro/");

$sandbox = true;
if($sandbox){
    define("EMAIL_PAGSEGURO", "k219594@dac.unicamp.br");
    define("TOKEN_PAGSEGURO", "0CE1D9CF08844ED487955888F10D56F7");
    define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
    define("EMAIL_LOJA","k219594@dac.unicamp.br");//email de suporte de pós venda
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO","https://cursopalavraplat.com.br/php/pagseguro/notificacao.php");
    define("PAIS_CARTAO", "BRA");
}else{
    define("EMAIL_PAGSEGURO", "Seu e-mail no PagSeguro");
    define("TOKEN_PAGSEGURO", "Seu token no PagSeguro");
    define("URL_PAGSEGURO", "https://ws.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
    define("EMAIL_LOJA","k219594@dac.unicamp.br");//email de suporte de pós venda
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO","https://sualoja.com.br/notifica.html");
    define("PAIS_CARTAO", "BRA");
}