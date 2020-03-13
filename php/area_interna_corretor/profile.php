<?php
    include './../connection.php';

    session_start();
    if(!isset($_SESSION['email_corretor']) && !isset($_SESSION['id_corretor']) && isset($_SESSION['nome_corretor'])){
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
                <a href="./index_corretor.php" class="">
                    <i class="fas fa-home iSidenav"></i>
                    <span class="sidenavTxt">Home</span>
                </a>
                <a href="./area_redacoes.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Área Redações</span>
                </a>
                <a href="./minhas_correcoes.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Minhas Correções</span>
                </a>
                <a href="./profile.php" class="active">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Meu Perfil</span>
                </a>
            </div>
        <div class="content">
            <div class="header">
                <div class="title">
                    <span>Curso Palavra: Redação Online</span>
                </div>
                <div class="user">
                    <div class="profile center">P</div>
                    <span class="username"><?php echo $_SESSION['email_corretor'];?></span>
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
                    <span>Aqui você pode alterar seus dados de perfil.
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet volutpat consequat mauris nunc congue nisi vitae suscipit tellus. Ut faucibus pulvinar elementum integer enim neque volutpat.
                    </span>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Alteração de perfil
                </div>
                <div class="card">
                <?php
                        $sql_select_dados_corretor = "SELECT * FROM dados_corretor WHERE id_corretor = '{$_SESSION['id_corretor']}'";
                        $sql_select_dados_corretor_result = mysqli_query($conn, $sql_select_dados_corretor);
                        if($sql_select_dados_corretor_result){
                            while($row_perfil_corretor = mysqli_fetch_array($sql_select_dados_corretor_result)){
                                echo '
                                    <form action="./update_corretor_profile.php" method="POST">
                                        <label>Nome</label>
                                        <input type="text" name="nome_corretor" value="'.$row_perfil_corretor['nome_corretor'].'">
                                        <label>Email</label>
                                        <input type="text" name="email_corretor" value="'.$row_perfil_corretor['email_corretor'].'">
                                        <label>Senha</label>
                                        <input type="text" name="senha_corretor" value="'.$row_perfil_corretor['senha_corretor'].'">
                                        <input type="submit" value="Salvar aterações">
                                    </form>
                                ';
                            }
                        }else{
                            echo 'Erro ao selecionar dados desta escola na base de dados.';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>