<?php
    if(isset($_POST['nome_escola']) && isset($_POST['email_escola']) && isset($_POST['senha_escola']) && isset($_POST['qtd_aluno_escola']) && isset($_POST['limite_redacao_por_aluno'])){
        include './../connection.php';

        $nome_escola = mysqli_real_escape_string($conn, $_POST['nome_escola']);
        $email_escola = mysqli_real_escape_string($conn, $_POST['email_escola']);
        $senha_escola = mysqli_real_escape_string($conn, $_POST['senha_escola']);
        $qtd_aluno_escola = mysqli_real_escape_string($conn, $_POST['qtd_aluno_escola']);
        $limite_redacao_por_aluno = mysqli_real_escape_string($conn, $_POST['limite_redacao_por_aluno']);
        
        //verificando se essa escola não exite na base dedados
        $sql_verifica_escola = "SELECT * FROM escola WHERE nome_escola = '$nome_escola' AND email_escola = '$email_escola'";
        $sql_verifica_escola_result = mysqli_query($conn, $sql_verifica_escola);
        if($sql_verifica_escola_result){
            $row_verifica_escola = mysqli_num_rows($sql_verifica_escola_result);
            if($row_verifica_escola == 1){
                echo 'Essa escola já existe na base de dados.';
                header('Location: ./escolas_cadastradas.php');
            }else{
                //realiza o insert
                $sql_insert_escola = "INSERT INTO escola(nome_escola, email_escola, senha_escola, qtd_aluno_escola, limite_redacao_aluno)VALUES('$nome_escola', '$email_escola', '$senha_escola', $qtd_aluno_escola, $limite_redacao_por_aluno)";
                $sql_insert_escola_result = mysqli_query($conn, $sql_insert_escola);
                if($sql_insert_escola_result){
                    echo 'Escola cadastrada na base de dados com sucesso.';
                    header('Location: ./escolas_cadastradas.php');
                }else{
                    echo 'Erro ao inserir escola na base de dados.';
                }
            }
        }else{
            echo 'Falha na query select escola';
        }
    }else{
        echo 'Preencha todos os campos.';
    }
?>