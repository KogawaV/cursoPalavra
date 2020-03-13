<?php
    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../connection.php';

        $nome_aluno = mysqli_real_escape_string($conn, $_POST['nome_aluno']);
        $email_aluno = mysqli_real_escape_string($conn, $_POST['email_aluno']);
        $senha_aluno = mysqli_real_escape_string($conn, $_POST['senha_aluno']);

        echo $nome_aluno.'<br>'.$email_aluno.'<br>'.$senha_aluno;
        while($row_profile = mysqli_fetch_array($sql_upgrade_profile_result)){
            
        }
        $sql_upgrade_profile = "UPDATE aluno SET nome_aluno = '$nome_aluno', email_aluno = '$email_aluno', senha_aluno = '$senha_aluno' WHERE id_aluno = '{$_SESSION['id_aluno']}'";
        $sql_upgrade_profile_result = mysqli_query($conn, $sql_upgrade_profile);
        if($sql_upgrade_profile_result){
            echo '<br>Dados atualizados com sucesso.';
            header('Location: ./profile.php');
        }else{
            echo '<br>Erro ao atualizar dados do aluno.';
            header('Location: ./profile.php');
        }
    }
?>