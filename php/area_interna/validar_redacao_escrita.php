<?php

include './../connection.php';
session_start();

function retiraAcentos($string){
    $acentos  =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ:?\/*|<>';
    $sem_acentos  =  'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------';
    $string = strtr($string, utf8_decode($acentos), $sem_acentos);
    $string = str_replace(" ","-",$string);
    return utf8_decode($string);
}

if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
    echo 'Sessões não existem';
    header('Location: ./../../html/login.html');
}else{
    if(!empty($_POST['texto_redacao'])){
        $texto_redacao = mysqli_real_escape_string($conn, $_POST['texto_redacao']);
        $tipo_redacao = mysqli_real_escape_string($conn, $_GET['tipo_redacao']);
        $tema_redacao = mysqli_real_escape_string($conn, $_GET['tema_redacao']);
        $modelo_redacao = mysqli_real_escape_string($conn, $_GET['modelo_redacao']);
        $tema_redacao_sem_acento = retiraAcentos(utf8_decode($tema_redacao));

        echo $tema_redacao;
    
        //variáveis aparte
        $limite_de_envio;
        $qtd_redacoes_enviada = 0;
        $new_qtd = 0;
    
        //echo $tema_redacao;
        //echo $modelo_redacao;
        //echo $tipo_redacao;
        
        $sql_select_limite_redacoes = "SELECT * FROM aluno WHERE id_aluno = '{$_SESSION['id_aluno']}'";
        $sql_select_limite_redacoes_result = mysqli_query($conn, $sql_select_limite_redacoes);
    
        $sql_qtd_redacoes_enviadas = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = '{$_SESSION['id_aluno']}'";
        $sql_qtd_redacoes_enviadas_result = mysqli_query($conn, $sql_qtd_redacoes_enviadas);

        //capturando a quantidade de redações enviadas pelo aluno e verificando se está dentro do limite do plano
        $sql_select_qtd_red_env = "SELECT * FROM redacoes_enviadas WHERE id_aluno_redacao = '{$_SESSION['id_aluno']}'";
        $sql_select_qtd_red_env_result = mysqli_query($conn, $sql_select_qtd_red_env);

        if($sql_select_limite_redacoes_result && $sql_qtd_redacoes_enviadas_result && $sql_select_qtd_red_env_result){
            while($row_limite_redacao = mysqli_fetch_array($sql_select_limite_redacoes_result)){
                $limite_de_envio = $row_limite_redacao['limite_redacoes'];
            }
    
            $qtd_red_env = mysqli_num_rows($sql_select_qtd_red_env_result);
            $qtd_red_escrita_env = mysqli_num_rows($sql_qtd_redacoes_enviadas_result);
            $qtd_redacao_enviada = $qtd_red_env + $qtd_red_escrita_env;

            if($qtd_redacoes_enviada >= $limite_de_envio){
                header('Location: ./../../html/aviso_limite_redacoes.html');
            }else{
                $new_qtd += $qtd_redacoes_enviada + 1;
                $texto_redacao_ql = nl2br($texto_redacao);
                $sql_insert_redacao_escrita = "INSERT INTO redacoes_escritas(nome_aluno, caminho_redacao, universidade_redacao, tema_redacao, tema_sem_acento, nome_corretor, id_corretor, id_aluno_redacao, status_corrigida, numero_redacoes_enviadas, tipo_redacao,texto_redacao_escrita, redacao_alterada)VALUES
                ('{$_SESSION['nome_aluno']}', 'vazio', '$modelo_redacao', '$tema_redacao', '$tema_redacao_sem_acento', 'aguardando', 0, '{$_SESSION['id_aluno']}', 0, $new_qtd, 2, '$texto_redacao_ql', '')";
                if($sql_insert_redacao_escrita_result = mysqli_query($conn, $sql_insert_redacao_escrita)){
                    //echo 'Redação Enviada Para Correção.';
                    header('Location: ./oldRed.php');
                }else{
                    echo 'Erro ao inserir redação na base de dados.';
                }
            }
        }else{
            echo 'Falha ao selecionar limite de redações que podem ser enviadas.';
        }
    }else{
        echo '  <div class="painel">
                    <label>Digite sua redação antes de enviá-la</label>
                    <button><a href="./temas.php">Temas Disponíveis</button>
                </div>';
    }
}

?>

<style type="text/css">
    *{
        margin: 0px;
        padding: 0px;
    }

    html, body{
        font-family: Arial;
    }

    div.painel{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
    }

    div.painel > label{
        font-weight: bold;
        font-size: 30px;
    }

    div.painel > button{
        border: none;
        border-radius: 3px;
        padding: 10px;
        width: 200px;
        margin: 20px;
        background-color: #379c69;
        transition-duration: 0.4s;
    }

    div.painel > button:hover{
        opacity: 0.9;
        cursor: pointer;
    }

    div.painel > button > a{
        text-decoration: none;
        font-size: 20px;
        color: #ffffff;
    }
</style>