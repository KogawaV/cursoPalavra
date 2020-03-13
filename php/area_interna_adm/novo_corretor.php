<?php
    include './../connection.php';

    session_start();
    if(!isset($_SESSION['email_adm'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
        <link href="./../../css/area_interna_style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="./../../images/favicon.ico">
        <style type="text/css">
            form{
                display: flex;
                flex-direction: column;
                padding: 15px;
                width: 400px;
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

        </style>
        <title>Curso Palavra</title>
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
                <a href="./novo_corretor.php" class="active">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Novo Corretor</span>
                </a>
                <a href="./cadastrar_novo_tema/form_novo_tema.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Novo Tema</span>
                </a>
                <a href="./cadastro_escola.php" class="">
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
                    Que página é essa?
                </div>
                <div class="card">
                    <span>Aqui você cadastrar novos corretores na plataforma
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet volutpat consequat mauris nunc congue nisi vitae suscipit tellus. Ut faucibus pulvinar elementum integer enim neque volutpat.
                    </span>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Cadastro de corretores
                </div>
                <div class="card">
                    <form action="./cadastro_corretor/validar_cadastro_corretor.php" method="POST">
                        <label>Nome: </label>
                            <input type="text" name="nome_corretor">
                        <label>Email: </label>
                            <input type="text" name="email_corretor">
                        <label>Senha</label>
                            <input type="text" name="senha_corretor">
                        <label>CPF</label>
                            <input type="text" name="cpf_corretor">
                            <input type="submit" value="Cadastrar">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>