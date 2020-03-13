<?php
    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
        <link href="./../../css/area_interna_style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="./../../images/favicon.ico">
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
                <a href="./index.php" class="">
                    <i class="fas fa-home iSidenav"></i>
                    <span class="sidenavTxt">Home</span>
                </a>
                <a href="./profile.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Perfil</span>
                </a>
                <a href="./novaRed.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Nova Redação</span>
                </a>
                <a href="./envRed.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Enviar Redação</span>
                </a>
                <a href="./oldRed.php" class="">
                    <i class="fas fa-folder-open iSidenav"></i>
                    <span class="sidenavTxt">Redações Submetidas</span>
                </a>
            </div>
        <div class="shortcut">
            <a href="#">
                <i class="fas fa-comment-dots iSHortcut"></i>
            </a>
            <a href="#">
                <i class="fas fa-plus iSHortcut bigger"></i>
            </a>
            <a href="#">
                <i class="fas fa-cog iSHortcut"></i>
            </a>
        </div>
        <div class="content">
            <div class="header">
                <div class="title">
                    <span>Curso Palavra: Redação Online</span>
                </div>
                <div class="user">
                    <div class="profile center">P</div>
                    <span class="username"><?php echo $_SESSION['email'];?></span>
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
                    <span>Aqui, você avalia e conversa com seus corretores!
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet volutpat consequat mauris nunc congue nisi vitae suscipit tellus. Ut faucibus pulvinar elementum integer enim neque volutpat.
                    </span>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Corretores
                </div>
                <div class="card">
                    <div class="corrWrapper">
                        <div class="corrName">
                            <span>Corretor Teste</span>
                        </div>
                        <div class="corrDesc">
                            <span>Professor de Língua Portuguesa e Literatura na escola Super Escola de São Paulo.</span>
                        </div>
                        <div class="corrRed">
                            Democratização do acesso ao cinema no Brasil 
                        </div>

                        <div class="btnWrapper">
                            <div class="corrAval">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <button class="btn itemBtn corrBtn"><i class="fas fa-comment-dots"></i>Conversar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>