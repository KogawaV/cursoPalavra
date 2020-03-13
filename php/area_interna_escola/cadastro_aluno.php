<?php
    include './../connection.php';
    session_start();
    if(!isset($_SESSION['email_escola']) && !isset($_SESSION['id_escola']) && !isset($_SESSION['nome_escola'])){
        header('./../../html/login.html');
    }else{

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
                        <a href="./escola_profile.php" class="aLogo">
                            <img class="pointer" src="./../../images/logo_center_fff.png">
                        </a> 
                    </div>
                </div>
                <a href="./escola_profile.php" class="">
                    <i class="fas fa-home iSidenav"></i>
                    <span class="sidenavTxt">Perfil Da Escola</span>
                </a>
                <a href="./meus_alunos.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Meus Alunos</span>
                </a>
                <a href="./cadastro_aluno.php" class="active">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Novo Aluno</span>
                </a>
            </div>
        <div class="content">
            <div class="header">
                <div class="title">
                    <span>Curso Palavra: Redação Online</span>
                </div>
                <div class="user">
                    <div class="profile center">P</div>
                    <span class="username"><?php echo $_SESSION['email_escola'];?></span>
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
                    <span>Aqui você cadastrar novos alunos na plataforma.
                        <br>
                        Algum texto.
                    </span>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Perfil da escola
                </div>
                <div class="card">
                    <form action="./validando_cadastro_aluno.php" method="POST">
                        <label>Nome: </label>
                        <input type="text" name="student_name">
                        <label>Email: </label>
                        <input type="email" name="student_email">
                        <label>Senha: </label>
                        <input type="text" name="student_password">
                        <input type="submit" value="Cadastrar Aluno"> 
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>