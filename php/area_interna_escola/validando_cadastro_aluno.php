<?php
    include './../connection.php';
    session_start();
    if(!isset($_SESSION['email_escola']) && !isset($_SESSION['id_escola']) && !isset($_SESSION['nome_escola'])){
        header('./../../html/login.html');
    }else{
        if(!empty($_POST['student_name']) && !empty($_POST['student_email']) && !empty($_POST['student_password'])){
            $student_name = $_POST['student_name'];
            $student_email = $_POST['student_email'];
            $student_password = $_POST['student_password'];
            $limite_redacao_aluno;
    
            //verificando se o email já existe na base de dados
            $sql_verificando_email = "SELECT * FROM aluno WHERE email_aluno = '{$student_email}' AND nome_aluno = '{$student_name}'";
            $sql_verificando_email_result = mysqli_query($conn, $sql_verificando_email);
            //verificando se query funcionou corretamente
            if($sql_verificando_email_result){
                //verificando se existe algum usuário com este mesmo email no banco de dados
                $row = mysqli_num_rows($sql_verificando_email_result);
                if($row >= 1){
                    echo 'Este email já está em uso.';
                    header('Location: ./cadastro_aluno.php');
                }else{
                    //selecionando o limite de redação do aluno
                    $sql_limite_redacao = "SELECT * FROM escola WHERE id_escola = '{$_SESSION['id_escola']}'";
                    $sql_limite_redacao_result = mysqli_query($conn, $sql_limite_redacao);
                    if($sql_limite_redacao_result){
                        while($row_limite = mysqli_fetch_array($sql_limite_redacao_result)){
                            $limite_redacao_aluno = $row_limite['limite_redacao_aluno'];
                        }
                        //cadastrando aluno na base de dados
                        $sql_inserindo_aluno = "INSERT INTO aluno(nome_aluno, email_aluno, senha_aluno, nome_escola, id_escola, limite_redacoes)VALUES('$student_name','$student_email','$student_password', '{$_SESSION['nome_escola']}', '{$_SESSION['id_escola']}', $limite_redacao_aluno)";
                        $sql_inserindo_aluno_result = mysqli_query($conn, $sql_inserindo_aluno);
                        //verificando se a query está funcionando correntamente
                        if($sql_inserindo_aluno_result){
                            echo 'Aluno cadastrado com sucesso.';
                            header('Location: ./meus_alunos.php');
                        }else{
                            echo 'Erro ao cadastrar aluno na base de dados.';
                        }
                    }else{
                        echo 'Erro ao selecionar limite de redação do aluno.';
                    }
                }
            }else{
                echo 'Erro na query: email';
            }
        }else{
            echo 'Preencha todos os campos';
            header('Location: ./cadastro_aluno.php');
        }
    }
?>