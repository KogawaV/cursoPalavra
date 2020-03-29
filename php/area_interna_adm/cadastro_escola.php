<?php
    include './../connection.php';
    session_start();
    if(!isset($_SESSION['email_adm'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
    <link href="./../../css/area_interna_style.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="./../../../images/favicon.ico">
    <title>Cadastro de escola</title>

    <style type="text/css">
        *{
            margin: 0px;
            padding: 0px;
        }

        html, body{
            font-family: Arial;
        }

        form{
            background-color: transparent;
            display: flex;
            flex-direction: column;
            width: 400px;
            padding: 15px 15px 0px 15px;
            border-radius: 10px;
        }

        form > input{
            margin: 10px 0px;
        }

        form > div.painel-btn-enviar{
            background-color: transparent;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        form > div.painel-btn-enviar > a{
            margin: 10px 0px;
        }

        input[type="submit"]{
            border: none;
            border-radius: 3px;
            padding: 15px;
            width: 80%;
            background-color: #379c69;
            color: #ffffff;
            font-weight: bold;
            transition-duration: 0.4;
        }

        input[type="submit"]:hover{
            opacity: 0.9;
            cursor: pointer;
        }

        input{
            padding: 8px;
            border-radius: 3px;
        }

        form > label{
            font-weight: bold;
            margin: 10px 0px;
        }

        select{
            padding: 8px;
            width: 70%;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        input, select{
            outline: none;
        }

        div.painel-form{
            background-color: transparent;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form > h2{
            margin: 20px 0px;
            text-align: center;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div class="sidenavWrapper">
        <div class="sidenav">   
            <div class="sidenavLogo">
                <div class="sidenavImage">
                    <a href="./index.php" class="aLogo">
                        <img class="pointer" src="./../../images/logo_center_fff.png">
                    </a> 
                </div>
            </div>
            <!-- <a href="./index.php" class="">
                <i class="fas fa-home iSidenav"></i>
                <span class="sidenavTxt">Home</span>
            </a> -->
            <a href="./alunos_cadastrados.php" class="">
                <i class="fas fa-user iSidenav"></i>
                <span class="sidenavTxt">Alunos Cadastrados</span>
            </a>
            <a href="./corretores_cadastrados.php" class="">
                <i class="fas fa-file-medical iSidenav"></i>
                <span class="sidenavTxt">Corretores Cadastrados</span>
            </a>
            <a href="./escolas_cadastradas.php" class="">
                <i class="fas fa-file-medical iSidenav"></i>
                <span class="sidenavTxt">Escolas Cadastradas</span>
            </a>
            <a href="./novo_corretor.php" class="">
                <i class="fas fa-file-upload iSidenav"></i>
                <span class="sidenavTxt">Novo Corretor</span>
            </a>
            <a href="./cadastrar_novo_tema/form_novo_tema.php" class="">
                <i class="fas fa-file-upload iSidenav"></i>
                <span class="sidenavTxt">Novo Tema</span>
            </a>
            <a href="./cadastro_escola.php" class="active">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Nova Escola</span>
                </a>
            <a href="./cadastrar_novo_tema/temas_cadastrados.php" class="">
                <i class="fas fa-file-upload iSidenav"></i>
                <span class="sidenavTxt">Temas cadastrados</span>
            </a>
        </div>
        <div class="content">
            <div class="header">
                <div class="title">
                    <span>Curso Palavra: Redação Online</span>
                </div>
                <div class="user">
                    <div class="profile center">P</div>
                    <span class="username"><?php echo $_SESSION['email_adm'];?></span>
                </div>
                <div class="widgets logout">
                    <a href="./../login/logout.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Cadastro De Escolas
                </div>
                <div class="card">
                    <form action="./validar_cadastro_escola.php" method="POST">
                            <label>Nome: </label>
                                <input type="text" name="nome_escola">
                            <label>Email: </label>
                                <input type="text" name="email_escola">
                            <label>Senha</label>
                                <input type="text" name="senha_escola">
                            <label>Número de alunos: </label>
                                <input type="number" name="qtd_aluno_escola">
                            <label>Selecione o plano da sua escola: </label>
                            <select name="limite_redacao_por_aluno" id="id_limite_redacao_por_aluno">
                                <option value="">Selecione o plano da escola</option>
                                <?php
                                    $sql_select_planos = "SELECT * FROM tipos_planos";
                                    $sql_select_planos_result = mysqli_query($conn, $sql_select_planos);
                                    if($sql_select_planos_result){
                                        while($row_planos = mysqli_fetch_array($sql_select_planos_result)){
                                            echo '<option value="'.$row_planos['limite_redacao_por_aluno'].'">'.$row_planos['limite_redacao_por_aluno'].' redações por aluno.</option>';
                                        }
                                    }else{
                                        echo 'Erro ao selecionar planos da base de dados.';
                                    }
                                ?>
                            </select>
                            <div class="painel-btn-enviar">
                                <input type="submit" value="Cadastrar">
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </body>
</html>

