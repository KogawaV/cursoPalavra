<?php
    include './../connection.php';
    session_start();
    if(!isset($_SESSION['email_corretor']) && !isset($_SESSION['id_corretor']) && !isset($_SESSION['nome_corretor'])){
        header('./../../html/login.html');
    }else{
        $nome_corretor = mysqli_real_escape_string($conn, $_POST['nome_corretor']);
        $email_corretor = mysqli_real_escape_string($conn, $_POST['email_corretor']);
        $senha_corretor = mysqli_real_escape_string($conn, $_POST['senha_corretor']);

        $sql_update_corretor_profile = "UPDATE dados_corretor SET nome_corretor = '$nome_corretor', email_corretor = '$email_corretor', senha_corretor = '$senha_corretor' WHERE id_corretor = '{$_SESSION['id_corretor']}'";
        $sql_update_corretor_profile_result = mysqli_query($conn, $sql_update_corretor_profile);
        if($sql_update_corretor_profile_result){
            header('Location: ./profile.php');
        }else{
            echo 'Erro ao atualizar os dados desta escola na base de dados.';
        }
    }
?>