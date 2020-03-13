<?php
    include './../connection.php';
    session_start();
    if(!isset($_SESSION['email_escola']) && !isset($_SESSION['id_escola']) && !isset($_SESSION['nome_escola'])){
        header('./../../html/login.html');
    }else{
        $nome_escola = mysqli_real_escape_string($conn, $_POST['nome_escola']);
        $email_escola = mysqli_real_escape_string($conn, $_POST['email_escola']);
        $senha_escola = mysqli_real_escape_string($conn, $_POST['senha_escola']);
        //$qtd_aluno_escola = mysqli_real_escape_string($conn, $_POST['qtd_aluno_escola']);

        $sql_update_escola_profile = "UPDATE escola SET nome_escola = '$nome_escola', email_escola = '$email_escola', senha_escola = '$senha_escola' WHERE id_escola = '{$_SESSION['id_escola']}'";
        $sql_update_escola_profile_result = mysqli_query($conn, $sql_update_escola_profile);
        if($sql_update_escola_profile_result){
            header('Location: ./escola_profile.php');
        }else{
            echo 'Erro ao atualizar os dados desta escola na base de dados.';
        }
    }
?>