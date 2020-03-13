<?php
    session_start();
    if(!isset($_SESSION['email_adm'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../../connection.php';

        $nome_corretor = mysqli_real_escape_string($conn, $_POST['nome_corretor']);
        $email_corretor = mysqli_real_escape_string($conn, $_POST['email_corretor']);
        $senha_corretor = mysqli_real_escape_string($conn, $_POST['senha_corretor']);
        $cpf_corretor = mysqli_real_escape_string($conn, $_POST['cpf_corretor']);
        
        //verificar se este corretor já não existe na base de dados
        $sql_verifica_corretor = "SELECT * FROM dados_corretor WHERE cpf_corretor = '$cpf_corretor' AND nome_corretor = '$nome_corretor'";
        $sql_verifica_corretor_result = mysqli_query($conn, $sql_verifica_corretor);
        if($sql_verifica_corretor_result){
            $row_verifica_corretor = mysqli_num_rows($sql_verifica_corretor_result);
            if($row_verifica_corretor == 1){
                echo 'Este corretor já está cadastrado na base de dados.';
                header('Location: ./../novo_corretor.php');
            }else{
                //cadastrar corretor na base de dados
                $sql_insert_corretor = "INSERT INTO dados_corretor(nome_corretor, email_corretor, senha_corretor, cpf_corretor, qtd_red_corrigidas)VALUES('$nome_corretor', '$email_corretor', '$senha_corretor', '$cpf_corretor', 0)";
                $sql_insert_corretor_result = mysqli_query($conn, $sql_insert_corretor);
                if($sql_insert_corretor_result){
                    echo 'Corretor cadastrado com sucesso na base de dados.';
                    header('Location: ./../corretores_cadastrados.php');
                }else{
                    echo 'Erro ao cadastrar corretor na base de dados.';
                    header('Location: ./../novo_corretor.php');
                }
            }
        }else{
            echo 'Erro ao verificar o corretor na base de dados.';
        }
    }
?>