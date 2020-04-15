<!-- <?php include './connection.php'; ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- <link rel="stylesheet" href="./../css/style_cad_aluno_independete.css"> -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./../js/jquery.mask.js"></script>

    <script>
        $(document).ready(function(){
            $('.cpf-mask').mask('000.000.000-00');
        });
    </script>

    <title>Cadastro Aluno Independente</title>
</head>
<body>

    <div class="flex-container">
        <div class="body">
            <div class="form">
                <?php $id_plano = $_GET['id_plano']; ?>
                <form action="./../php/vaidacao_cadastro_aluno_independente.php?id_plano=<?php echo $id_plano; ?>" method="POST" id="form">
                    <label>Nome</label>
                    <input type="text" name="nome_aluno" id="nome">
                    <label>Email</label>
                    <input type="text" name="email_aluno" id="email">
                    <label>CPF</label>
                    <input type="text" name="cpf_aluno" class="cpf-mask" id="cpf">
                    <label>Senha</label>
                    <input type="password" name="senha_aluno" id="senha">
                    <input type="submit" value="Cadastrar" id="btnSubmit">
                    <div class="painel-fazer-login">
                        <a href="./../html/login.html">Já tenho uma conta</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    html, body{
        font-family: Arial, Helvetica, sans-serif;
    }

    div.body{
        display: flex;
        width: 100vw;
        height: 100vh;
        justify-content: center;
        align-content: center;
    }

    form{
        display: flex;
        flex-direction: column;
        margin-top: 100px;
    }

    form input{
        outline: none;
        padding: 8px 10px;
        margin: 5px 0px;
        font-size: 17px;
        width: 250px;
    }

    form input[type="submit"]{
        background-color: #E1289B;
        padding: 10px;
        border: none;
        border-radius: 3px;
        color: #ffffff;
        font-weight: bold;
        transition-duration: 0.4s;
        width: 150px;
    }

    form input[type="submit"]:hover{
        opacity: 0.9;
        cursor: pointer;
    }
</style>