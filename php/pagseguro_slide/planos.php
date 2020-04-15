<?php
    include './../connection.php';

    $id_plano_url = $_GET['id_plano'];
    
    $sql_select_dados = "SELECT * FROM tipos_planos WHERE id_tipo_plano = $id_plano_url";
    $sql_select_dados_result = mysqli_query($conn, $sql_select_dados);

    while($row = mysqli_fetch_array($sql_select_dados_result)){
        $nome_plano = $row['nome_plano'];
        $valor_plano = $row['preco'];
        $limite_redacao = $row['limite_redacao_por_aluno'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Planos</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="../Login_v17/images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/animsition/css/animsition.min.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/select2/select2.min.css">	
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/css/util.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/css/main.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script>
            function enviaPagseguro(){
                $.post('pagseguro.php',{idPedido: document.getElementById("plano").value, cpf: document.getElementById("cpf").value},function(data){
                $('#code').val(data);
                $('#comprar').submit();
                })
            }
        </script>
        <style>
                th{
                    border: 1px solid black;
                    text-align: center;
                    background-color: #F5F5F5;
                    font-size: 15px;
                    width: 300px;
                }
                td{
                    border: 1px solid black;
                    height: 70px;
                }
                p{
                    font-size: 25px;
                }
            </style>
    </head>
    <body >
        <form class="cadastro100-form validate-form" id="comprar" action="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
            <input type="hidden" name="code" id="code" value="2" />  
            <input type="hidden" name="plano" id="plano" value="<?php echo $id_plano_url ?>"/>
            <input type="hidden" name="cpf" id="cpf" value="<?php echo $_GET["cpf"]?>"/>   

            <p>Plano Escolhido: <?php echo utf8_encode($nome_plano);?> </p>
            <p>Valor do plano: <?php echo $valor_plano;?> </p>
            <p>Limite de Redações do plano: <?php echo $limite_redacao;?> </p>

            <button class="btnConfirmarPlano" onclick="enviaPagseguro()">Confirmar Plano</button>
        </form>
        <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
    </body>
</html>
<script>
</script>

<style>
    form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: center;
    }

    form input{
        margin: 10px 0px;
        width: 50%;
        margin: 5px 0px;
        text-align: left;
    }

    form button{
        border: none;
        border-radius: 3px;
        background-color: #83ca6c;
        color: #FFFFFF;
        width: 30%;
    }
</style>
