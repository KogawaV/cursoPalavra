<?php
include './../connection.php';
$pedido = $_POST["idPedido"];
$nome_plano;
$valor_plano;
$limite_redacao;
$cpf = $_POST['cpf'];
$id_aluno;
$id_carrinho;

$sql_select_dados = "SELECT * FROM tipos_planos WHERE id_tipo_plano = $pedido";
$sql_select_dados_result = mysqli_query($conn, $sql_select_dados);

while($row = mysqli_fetch_array($sql_select_dados_result)){
    $nome_plano = $row['nome_plano'];
    $valor_plano = $row['preco'];
    $limite_redacao = $row['limite_redacao_por_aluno'];
}

$sql_update_aluno = "UPDATE aluno SET tipo_plano = $pedido, limite_redacoes = $limite_redacao where cpf_aluno = '$cpf'";
$sql_update_aluno_result = mysqli_query($conn, $sql_update_aluno);

$sql_select_id_aluno = "SELECT * FROM aluno WHERE cpf_aluno = '$cpf'";
$sql_select_id_aluno_result = mysqli_query($conn, $sql_select_id_aluno);

while($row = mysqli_fetch_array($sql_select_id_aluno_result)){
    $id_aluno = $row['id_aluno'];
}

$data_compra = "NOW()";
$sql_insert_carrinho = "INSERT INTO carrinho(identificador_compra, id_aluno, valor_venda, qtd_plano, data_compra)VALUES($pedido, $id_aluno, $valor_plano, 1, $data_compra)";
$sql_insert_carrinho_result = mysqli_query($conn, $sql_insert_carrinho);

$sql_select_id_carrinho = "SELECT * FROM carrinho WHERE data_compra = $data_compra";
$sql_select_id_carrinho_result = mysqli_query($conn, $sql_select_id_carrinho);

while($row = mysqli_fetch_array($sql_select_id_carrinho_result)){
    $id_carrinho = $row['identificador_carrinho'];
}

$data['token'] ='DACE7F9605CF413B83DB02551FA03843';
$data['email'] = 'walterdallaprofissional@gmail.com';
$data['currency'] = 'BRL';
$data['itemId1'] = $pedido;
$data['itemQuantity1'] = '1';
$data['itemDescription1'] = $nome_plano;
$data['itemAmount1'] = $valor_plano;
$data['reference'] = $id_carrinho;
//$data['receiverEmail'] = 'http://localhost/Redacao/cursoPalavra/php/pagseguro_slide/notificacao.php';

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';

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