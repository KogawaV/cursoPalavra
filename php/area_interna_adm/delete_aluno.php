<?php
    session_start();
    if(!isset($_SESSION['email_adm'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../connection.php';
        //$arquivo_redacao;
        $id_aluno = mysqli_real_escape_string($conn, $_GET['id_aluno']);
        echo $id_aluno;

        $sql_delete_aluno = "DELETE FROM aluno WHERE id_aluno = $id_aluno";
        $sql_delete_aluno_result = mysqli_query($conn, $sql_delete_aluno);
        if($sql_delete_aluno_result){
            $sql_delete_redacao_bd = "DELETE FROM redacoes_enviadas WHERE id_aluno_redacao = $id_aluno";
            $sql_delete_redacao_bd_result = mysqli_query($conn, $sql_delete_redacao_bd);
            if($sql_delete_redacao_bd_result){
                echo 'Redação excluida da plataforma com sucesso.';
                header('Location: ./alunos_cadastrados.php');
            }else{
                echo 'Erro ao deletar redação da plataforma.';
            }
            echo 'Aluno excluido da plataforma com sucesso.';
            header('Location: ./alunos_cadastrados.php');
        }else{
            echo 'Falha ao excluir este aluno da base de dados.';
            header('Location: ./alunos_cadastrados.php');
        }
    }
?>