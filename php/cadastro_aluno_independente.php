<?php include './connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro Aluno Independente</title>

    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
        
        html, body{
            font-family: Arial;
        }

        form{
            display: flex;
            flex-direction: column;
            padding: 15px;
            width: 400px;
            border: 1px solid #f1f1f1;
            border-radius :5px;
        }

        form > label{
            font-weight: bold;
            margin: 10px 0px;
        }

        form > input{
            border-radius: 3px;
            padding: 5px;
            margin-bottom: 20px;
        }

        form > input[type="submit"]{
            width: 50%;
            background-color: #379c69;
            color: #ffffff;
            border-radius: 3px;
            border: none;
            padding: 10px;
            transition-duration: 0.4s;
            font-weight: bold;
            font-size: 15px;
        }

        form > input[type="submit"]:hover{
            opacity: 0.9;
            cursor: pointer;
        }

        form > select{
            padding: 10px;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        div.painel-form{
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="painel-form">
        <form action="./../php/vaidacao_cadastro_aluno_independente.php" method="POST">
            <label>Nome</label>
            <input type="text" name="nome_aluno">
            <label>Email</label>
            <input type="email" name="email_aluno">
            <label>CPF</label>
            <input type="text" name="cpf_aluno">
            <label>Senha</label>
            <input type="text" name="senha_aluno">
            <select name="tipo_plano" id="id_tipo_plano">
                <option value="">Selecione Seu Plano</option>
                <?php   
                    $sql_selec_tipo_plano = "SELECT * FROM tipos_planos";
                    $sql_selec_tipo_plano_result = mysqli_query($conn, $sql_selec_tipo_plano);
                    if($sql_selec_tipo_plano_result){
                        while($row_tipos_planos = mysqli_fetch_array($sql_selec_tipo_plano_result)){
                            echo '<option value='.$row_tipos_planos['id_tipo_plano'].'>'.$row_tipos_planos['nome_plano'].' - '.$row_tipos_planos['limite_redacao_por_aluno'].' Redações por mês.</option>';
                        }
                    }else{
                        echo 'Erro ao selecionar os planos da base de dados.';
                    }
                ?>
            </select>
            <input type="submit" value="Cadastrar">
            <div class="painel-fazer-login">
                <a href="./../html/login.html">Já tenho uma conta</a>
            </div>
        </form>
    </div>
</body>
</html>