<?php
    session_start();
    include './../connection.php';
    session_start();
    if(!isset($_SESSION['email_escola']) && !isset($_SESSION['id_escola']) && !isset($_SESSION['nome_escola'])){
        header('./../../html/login.html');
    }else{
        $id_aluno = mysqli_real_escape_string($conn, $_GET['id_aluno']);
        echo $id_aluno;

        $sql_delete_aluno = "DELETE FROM aluno WHERE id_aluno = $id_aluno";
        $sql_delete_aluno_result = mysqli_query($conn, $sql_delete_aluno);
        if($sql_delete_aluno_result){
            $sql_delete_redacao_bd = "DELETE FROM redacoes_enviadas WHERE id_aluno_redacao = $id_aluno";
            $sql_delete_redacao_bd_result = mysqli_query($conn, $sql_delete_redacao_bd);
            if($sql_delete_redacao_bd_result){
                echo 'Redação excluida da plataforma com sucesso.';
                header('Location: ./meus_alunos.php');
            }else{
                echo 'Erro ao deletar redação da plataforma.';
            }
            echo 'Aluno excluido da plataforma com sucesso.';
            header('Location: ./meus_alunos.php');
        }else{
            echo 'Falha ao excluir este aluno da base de dados.';
            header('Location: ./meus_alunos.php');
        }
    }
?>