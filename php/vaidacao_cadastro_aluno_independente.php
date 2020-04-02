<?php 
    include './connection.php'; 

    if(isset($_POST['nome_aluno']) && isset($_POST['email_aluno']) && isset($_POST['cpf_aluno']) && isset($_POST['senha_aluno']) && isset($_POST['tipo_plano'])){
        $nome_aluno = mysqli_real_escape_string($conn, $_POST['nome_aluno']);
        $email_aluno = mysqli_real_escape_string($conn, $_POST['email_aluno']);
        $cpf_aluno = mysqli_real_escape_string($conn, $_POST['cpf_aluno']);
        $senha_aluno = mysqli_real_escape_string($conn, $_POST['senha_aluno']);
        $tipo_plano = mysqli_real_escape_string($conn, $_POST['tipo_plano']);

        $id_aluno = 0;
        $id_plano;
        $preco_plano;
        $limite_redacao;

        //verificando se o aluno não existe na base de dados
        $sql_verifica_aluno_no_bd = "SELECT * FROM aluno WHERE email_aluno = '$email_aluno' OR cpf_aluno = '$cpf_aluno'";
        $sql_verifica_aluno_no_bd_result = mysqli_query($conn, $sql_verifica_aluno_no_bd);
        if($sql_verifica_aluno_no_bd_result){
            $row_verifica_aluno = mysqli_num_rows($sql_verifica_aluno_no_bd_result);
            if($row_verifica_aluno >= 1){
                echo '

                <div class="painel">
                    <p>Este E-mail e CPF já existe na base de dados.</p>
                    <button><a href="./cadastro_aluno_independente.php">Voltar</a></button>
                </div>
                
                ';
            }else{
                $sql_select_texto_tipo_plano = "SELECT * FROM tipos_planos WHERE id_tipo_plano = $tipo_plano";
                $sql_select_texto_tipo_plano_result = mysqli_query($conn, $sql_select_texto_tipo_plano);
                if($sql_select_texto_tipo_plano_result){
                    while($row_texto_tipo_plano = mysqli_fetch_array($sql_select_texto_tipo_plano_result)){
                        $texto_tipo_plano = $row_texto_tipo_plano['nome_plano'];
                        $id_plano = $row_texto_tipo_plano['id_tipo_plano'];
                        $preco_plano = $row_texto_tipo_plano['preco'];
                        $limite_redacao = $row_texto_tipo_plano['limite_redacao_por_aluno'];
                    }   
                    //inserir aluno na base de dados
                    $sql_insert_aluno = "INSERT INTO aluno(nome_aluno, email_aluno, cpf_aluno, senha_aluno, nome_escola, id_escola, acesso)VALUES('$nome_aluno', '$email_aluno', '$cpf_aluno', '$senha_aluno', 'individual', 0, 0)";//de acesso to setando 1(concedendo acesso ao aluno) enquanto a funcionalidade de pagamento ainda não está pronta
                    $sql_insert_aluno_result = mysqli_query($conn, $sql_insert_aluno);
                    if($sql_insert_aluno_result){//insert deu certo
                        //$sql_select_id = "SELECT * FROM aluno a INNER JOIN tipos_planos tp ON a.tipo_plano = tp.id_tipo_plano WHERE cpf_aluno = '$cpf_aluno'";
                        //$sql_select_id_result = mysqli_query($conn, $sql_select_id);

                        /*while($row = mysqli_fetch_array($sql_select_id_result)){
                            $id_aluno = $row['id_aluno'];
                        }*/
                        header('Location: ./../php/pagseguro_slide/planos.php?cpf='.$cpf_aluno);
                        /*if($id_aluno != 0){
                            //echo date();
                            $data_compra = "now()";
                            $sql_insert_carrinho = "INSERT INTO carrinho(identificador_compra, id_aluno, valor_venda, qtd_plano, data_compra)VALUES($id_plano, $id_aluno, $preco_plano, 1, $data_compra)";
                            $sql_insert_carrinho_result = mysqli_query($conn, $sql_insert_carrinho);
                            if($sql_insert_carrinho_result){
                                session_start();
                                $_SESSION['id_aluno'] = $id_aluno;
                                $_SESSION['data_compra'] = $data_compra;
                                header('Location: ./../php/pagseguro_slide/planos.php?cpf='.$cpf_aluno);
                                //header('Location: ./../html/login.html');
                            }else{
                                echo 'Erro ao inserir na tabela carrinho';
                            }
                        }*/
                        //$id_aluno = ($sql_select_id_result['id_aluno']);
                        //echo $id_aluno;
                    }else{
                        echo 'Erro ao inserir aluno na base de dados.';
                    }
                }else{
                    echo 'Erro ao selecionar Texto do tipo plano deste aluno(a)';
                }
            }
        }else{
            echo 'Erro na query select aluno';
        }
    }else{
        echo 'Preencha todos os campos.';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validação do Cadastro de Aluno Independente</title>
    <style type="text/css">
        *{margin: 0px; padding: 0px;}
        
        html,body{
            font-family: Arial;
        }

        div.painel{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
        }

        div.painel > button{
            border: none;
            border-radius: 3px;
            padding: 10px;
            background-color: #379c69;
            transition-duration: 0.4s;
            width: 100px;
        }

        div.painel > button:hover{
            opacity: 0.9;
        }

        div.painel > button > a{
            text-decoration: none;
            color: #ffffff;
        }

        div.painel > p{
            font-size: 25px;
            font-weight: bold;
            margin: 10px;
        }
    </style>
</head>
<body>
    
</body>
</html>
