<?php
    session_start();
    if(!isset($_SESSION['email_adm'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../connection.php';
        //$arquivo_redacao;
        $id_escola = mysqli_real_escape_string($conn, $_GET['id_escola']);
        echo $id_escola;

        $sql_delete_escola = "DELETE FROM  escola WHERE id_escola = $id_escola";
        $sql_delete_escola_result = mysqli_query($conn, $sql_delete_escola);
        if($sql_delete_escola_result){
            $sql_delete_aluno_bd = "DELETE FROM aluno WHERE id_escola = $id_escola";
            $sql_delete_aluno_bd_result = mysqli_query($conn, $sql_delete_aluno_bd);
            if($sql_delete_aluno_bd_result){
                echo 'Escola excluida da plataforma com sucesso.';
                header('Location: ./escolas_cadastradas.php');
            }else{
                echo 'Erro ao deletar essa escola da plataforma.';
            }
            echo 'Escola excluida da plataforma com sucesso.';
            header('Location: ./escolas_cadastradas.php');
        }else{
            echo 'Falha ao excluir essa escola da base de dados.';
            header('Location: ./escolas_cadastradas.php');
        }
    }
?>