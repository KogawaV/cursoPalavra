<?php
    session_start();
    if(!isset($_SESSION['email_corretor']) && !isset($_SESSION['id_corretor']) && !isset($_SESSION['nome_corretor'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../connection.php';

        $tipo_redacao = mysqli_real_escape_string($conn, $_GET['tipo_redacao']);
        //variáveis em comum
        $id_aluno = mysqli_real_escape_string($conn, $_GET['id_aluno']);
        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
        $status_corrigida = mysqli_real_escape_string($conn, $_GET['status_corrigida']);
        $nome_corretor_banco = mysqli_real_escape_string($conn, $_GET['nome_corretor']);

        if($tipo_redacao == 1){
            $caminho_redacao = mysqli_real_escape_string($conn, $_GET['caminho_redacao']);

            if($status_corrigida == 0 && $nome_corretor_banco == 'aguardando' && isset($caminho_redacao)){//verificando se o caminho da redação foi iniciado;
                $sql_update_status_correcao_red = "UPDATE redacoes_enviadas SET id_corretor = {$_SESSION['id_corretor']}, nome_corretor = '{$_SESSION['nome_corretor']}', status_corrigida = 2 WHERE id_red = $id_redacao";
                if($sql_update_status_correcao_red_result = mysqli_query($conn, $sql_update_status_correcao_red)){
                    //echo '<iframe src="./../area_interna/'.$caminho_redacao.'" width="700" height="780" style="border: none; float: left;"></iframe>';
                    header('Location: ./minhas_correcoes.php');
                }else{
                    echo 'Falha ao autenticar a correção desta redação.';
                }
            }else{
                echo 'Essa redação já está sendo corrigida por outro corretor.';
                header('Location: ./area_redacoes.php');
            }
        }else if($tipo_redacao == 2){
            if($status_corrigida == 0 && $nome_corretor_banco == 'aguardando'){
            $sql_update_status_correcao_red = "UPDATE redacoes_escritas SET id_corretor = {$_SESSION['id_corretor']}, nome_corretor = '{$_SESSION['nome_corretor']}', status_corrigida = 2 WHERE id_red = $id_redacao";
            if($sql_update_status_correcao_red_result = mysqli_query($conn, $sql_update_status_correcao_red)){
                header('Location: ./minhas_correcoes.php');
            }
            }else{
                echo '  <div class="painel-nada-bd">
                            <h2>Outro Corretor Acabou de Pegar Essa Redaçã Para Corrigir</h2>
                            <button class="btn-novo-tema"><a href="./area_redacoes.php">Voltar para área de redações</a></button>
                        </div>
                    ';
            }
        }else{
            echo 'Erro ao enviar redação.';
        }

        /*$status_corrigida;
        $id_redacao = $_GET['id_red'];
        $caminho_redacao = $_GET['caminho_red'];
        $status_corrigida = $_GET['status_corrigida'];
        $nome_corretor = $_GET['nome_corretor'];*/
        
        /*echo 'Email do corretor: '.$_SESSION['email_corretor'];
        echo '<br>Id do corretor: '.$_SESSION['id_corretor'];
        echo '<br>Nome do corretor: '.$_SESSION['nome_corretor'];
        echo '<br>Status corrigida: '.$status_corrigida;
        echo '<br>Nome do corretor: '.$nome_corretor;
        echo '<br>Id da redação: '.$id_redacao;

        echo '<br>Path redação: '.$caminho_redacao;
        echo '<br>Id da redação: '.$id_redacao;*/
        //echo $id_redacao;
        //echo $caminho_redacao;
        
        //verificar se já não existe um corretor para redação escolhida
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .painel-nada-bd{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .btn-novo-tema{
            background-color: #379c69;
            padding: 8px;
            border:none;
            border-radius: 3px;
            margin: 10px 0px;
            width: 25%;
        }

        .btn-novo-tema > a{
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            font-size: 15px;
        }
    </style>
</head>
<body>
    
</body>
</html>