<?php

include './../connection.php';

if(!empty($_POST['email']) && !empty($_POST['password'])){
    //echo 'Todos os campos preenchidos';
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $id_aluno;
    $nome_aluno;
    $id_corretor;
    $nome_corretor;
    $id_escola;
    $nome_escola;

    $acesso;

    //verificando se o email e senha existem na base de dados
    $sql_verificar_conta = "SELECT * FROM aluno WHERE email_aluno = '$email' AND senha_aluno = '$password'";
    $sql_verificar_conta_result = mysqli_query($conn, $sql_verificar_conta);
    //verificando se a query está funcionando
    if($sql_verificar_conta_result){
        //echo 'Query funcionando.';
        //verificando se este email e senha existem
        $row = mysqli_num_rows($sql_verificar_conta_result);
        if($row == 1){
            while($dados_student = mysqli_fetch_array($sql_verificar_conta_result)){
                $id_aluno = $dados_student['id_aluno'];
                $nome_aluno = $dados_student['nome_aluno'];
                $acesso = $dados_student['acesso'];
            }

            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['id_aluno'] = $id_aluno;
            $_SESSION['nome_aluno'] = $nome_aluno;

            header('Location: ./../area_interna/index.php');


            /*if($acesso == 1){
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['id_aluno'] = $id_aluno;
                $_SESSION['nome_aluno'] = $nome_aluno;
    
                header('Location: ./../area_interna/index.php');
            }else{
                echo 'Aguardando pagamento.';
            }*/
        }else{
            //CASO O LOGIN DE ALUNO TENHA DADO ERRADO VAI TENTAR LOGAR COMO ADM, E SÓ VAI ENTRAR CASO ALGUÉM ACERTE O EMAIL E SENHA DA SUA RESPECTIVA CONTA
            $sql_verificar_conta_adm = "SELECT * FROM dados_adm WHERE email_adm = '$email' AND senha_adm = '$password'";
            $sql_verificar_conta_adm_result = mysqli_query($conn, $sql_verificar_conta_adm);
            if($sql_verificar_conta_adm_result){
                $row_adm = mysqli_num_rows($sql_verificar_conta_adm_result);
                if($row_adm == 1){
                    session_start();
                    $_SESSION['email_adm'] = $email;

                    header('Location: ./../area_interna_adm/index.php');
                }else{
                    $sql_verifica_corretor = "SELECT * FROM dados_corretor WHERE email_corretor = '$email' AND senha_corretor = '$password'";
                    $sql_verifica_corretor_result = mysqli_query($conn, $sql_verifica_corretor);
                    if($sql_verifica_corretor_result){
                        $row_corretor = mysqli_num_rows($sql_verifica_corretor_result);
                        if($row_corretor == 1){
                            while($row_corretor = mysqli_fetch_array($sql_verifica_corretor_result)){
                                $id_corretor = $row_corretor['id_corretor'];
                                $nome_corretor = $row_corretor['nome_corretor'];
                            }
                            session_start();
                            $_SESSION['email_corretor'] = $email;
                            $_SESSION['id_corretor'] = $id_corretor;
                            $_SESSION['nome_corretor'] = $nome_corretor;

                            header('Location: ./../area_interna_corretor/index_corretor.php');
                        }else{
                            $sql_verifica_escola = "SELECT * FROM escola WHERE email_escola = '$email' AND senha_escola = '$password'";
                            $sql_verifica_escola_result = mysqli_query($conn, $sql_verifica_escola);
                            if($sql_verifica_escola_result){
                                $row_escola = mysqli_num_rows($sql_verifica_escola_result);
                                if($row_escola == 1){
                                    while($row_escola = mysqli_fetch_array($sql_verifica_escola_result)){
                                        $id_escola = $row_escola['id_escola'];
                                        $nome_escola = $row_escola['nome_escola'];
                                    }
                                    session_start();
                                    $_SESSION['id_escola'] = $id_escola;
                                    $_SESSION['nome_escola'] = $nome_escola;
                                    $_SESSION['email_escola'] = $email;

                                    header('Location: ./../area_interna_escola/escola_profile.php');
                                }else{
                                    echo 'Email ou senha incorretos.';
                                    header('Location: ./../../html/login.html');
                                }
                            }else{
                                echo 'Erro ao selecionar a escola';
                            }
                        }
                    }else{
                        echo 'Erro ao selecionar dados do corretor.';
                    }
                }
            }else{
                echo 'Erro na query de verificação de login do ADM.';
            }
        }
    }else{
        echo 'Query não funcionou.';
    }
}else{
    echo 'Preencha todos os campos.';
    header('Location: ./../../html/login.html');
}

?>