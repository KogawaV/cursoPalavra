<?php
    session_start();
    if(!isset($_SESSION['email_adm'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../../connection.php';
    }
?>
<?php header("Content-Type: text/html; charset=ISO-8859-1",true);?> 
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
        <link href="./../../../css/area_interna_style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="./../../../images/favicon.ico">
        <style type="text/css">
            .painel-nada-bd{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .btn-novo-tema{
                background-color: #379c69;
                padding: 8px;
                border:none;
                border-radius: 3px;
                margin: 10px 0px;
                width: 25%;
            }

            .btn-novo-tema > a{
                text-decoration: none;
                color: #ffffff;
                font-weight: bold;
                font-size: 15px;
            }

            .card-tema{
                border: 1px solid #f1f1f1;
                width: 300px;
                border-radius: 3px;
                margin: 15px;
            }

            .card-tema:hover{
                box-shadow: 1px 1px 10px 3px#808080;
            }

            .title-tema{
                padding: 10px;
                min-height: 120px;
            }

            .title-tema > p{
                color: #5168e6;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
                margin-top: 5px;
            }

            .painel-btn-tema{
                padding: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .painel-btn-tema > button{
                border: none;
                background-color: #003399;
                padding: 10px;
                border-radius: 3px;
                width: 100%;
                transition-duration: 0.4s;
            }

            div.painel-btn-tema > button:hover{
                opacity: 0.9;
                cursor: pointer;
            }

            .painel-btn-tema > button > i{
                margin: 0px 5px;
                color: #ffffff;
            }

            .painel-btn-tema > button > a{
                text-decoration: none;
                color: #ffffff;
            }

            .painel-card-tema{
                background-color: transparent;
                padding: 15px;
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }

            div.header-tema{
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
            }

            div.header-tema > div.logo-usp{
                background-color: transparent;
                background-image: url('./../../../svg/logo_usp.svg');
                background-size: 100% 100%;
                height: 100px;
                width: 100px;
            }

            div.header-tema > div.logo-unicamp{
                background-color: transparent;
                background-image: url('./../../../svg/logo_unicamp.svg');
                background-size: 100% 100%;
                height: 90px;
                width: 90px;
                margin-top: 10px;
            }

            div.header-tema > div.logo-vunesp{
                background-color: transparent;
                background-image: url('./../../../png/logo_unesp.png');
                background-size: 100% 100%;
                height: 90px;
                width: 90px;
                margin-top: 10px;
            }

            div.header-tema > div.logo-enem{
                background-color: transparent;
                background-image: url('./../../../png/Enem_logo.png');
                background-size: 100% 100%;
                height: 90px;
                width: 150px;
                margin-top: 10px;
            }
        </style>
        <title>Curso Palavra</title>
    </head>
    <body>
        <div class="sidenavWrapper">
            <div class="sidenav">
                <div class="sidenavLogo">
                    <div class="sidenavImage">
                        <a href="./../index.php" class="aLogo">
                            <img class="pointer" src="./../../../images/logo_center_fff.png">
                        </a> 
                    </div>
                </div>
                <!-- <a href="./../index.php" class="">
                    <i class="fas fa-home iSidenav"></i>
                    <span class="sidenavTxt">Home</span>
                </a> -->
                <a href="./../alunos_cadastrados.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Alunos Cadastrados</span>
                </a>
                <a href="./../corretores_cadastrados.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Corretores Cadastrados</span>
                </a>
                <a href="./../escolas_cadastradas.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Escolas Cadastradas</span>
                </a>
                <a href="./../novo_corretor.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Novo Corretor</span>
                </a>
                <a href="./form_novo_tema.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Novo Tema</span>
                </a>
                <a href="./../cadastro_escola.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Nova Escola</span>
                </a>
                <a href="./temas_cadastrados.php" class="active">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Temas cadastrados</span>
                </a>
            </div>
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
                <a href="./../../login/logout.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
        <div class="cardWrapper">
            <div class="cardTop">
                Que página é essa?
            </div>
            <div class="card">
                <span>
                    <br>
                    Aqui você pode ver todos os temas já cadastrados na plataforma
                </span>
            </div>
        </div>
        <div class="cardWrapper">
            <div class="cardTop">
                Cadastro de corretores
            </div>
            <div class="card">
                <?php
                    $sql_select_temas_cadastrados = "SELECT * FROM temas_redacao ORDER BY nome_tema";
                    $sql_select_temas_cadastrados_result = mysqli_query($conn, $sql_select_temas_cadastrados);
                    if($sql_select_temas_cadastrados_result){
                        $row_tema = mysqli_num_rows($sql_select_temas_cadastrados_result);
                        if($row_tema == 0){
                            echo '
                                <div class="painel-nada-bd">
                                    <h2>Nenhum Tema Cadastrado Ainda</h2>
                                    <button class="btn-novo-tema"><a href="./form_novo_tema.php">Cadastrar Novo Tema</button>
                                </div>
                            ';
                        }else{
                            echo '<div class="painel-card-tema">';
                                while($row_tema = mysqli_fetch_array($sql_select_temas_cadastrados_result)){
                                    if($row_tema['modelo_tema'] == 'Fuvest'){
                                        echo '
                                        <div class="card-tema">
                                            <div class="header-tema"><div class="logo-usp"></div></div>
                                            <div class="title-tema"><p>Tema</p>'.utf8_decode($row_tema['nome_tema']).'</div>
                                            <div class="painel-btn-tema">
                                                <button><i class="fas fa-eye"></i><a href=./'.$row_tema['caminho_arquivo_tema'].' target="_blank" rel="noopener noreferrer">Visualizar Tema</a></button>                                            </div>
                                        </div>
                                    ';
                                    }else if($row_tema['modelo_tema'] == 'Unicamp'){
                                        echo '
                                        <div class="card-tema">
                                            <div class="header-tema"><div class="logo-unicamp"></div></div>
                                            <div class="title-tema"><p>Tema</p>'.utf8_decode($row_tema['nome_tema']).'</div>
                                            <div class="painel-btn-tema">
                                                <button><i class="fas fa-eye"></i><a href=./'.$row_tema['caminho_arquivo_tema'].' target="_blank" rel="noopener noreferrer">Visualizar Tema</a></button>
                                            </div>
                                        </div>
                                    ';
                                    }else if($row_tema['modelo_tema'] == 'Vunesp'){
                                        echo '
                                        <div class="card-tema">
                                            <div class="header-tema"><div class="logo-vunesp"></div></div>
                                            <div class="title-tema"><p>Tema</p>'.utf8_decode($row_tema['nome_tema']).'</div>
                                            <div class="painel-btn-tema">
                                                <button><i class="fas fa-eye"></i><a href=./'.$row_tema['caminho_arquivo_tema'].' target="_blank" rel="noopener noreferrer">Visualizar Tema</a></button>
                                            </div>
                                        </div>
                                    ';
                                    }else if($row_tema['modelo_tema'] == 'Enem'){
                                        echo '
                                        <div class="card-tema">
                                            <div class="header-tema"><div class="logo-enem"></div></div>
                                            <div class="title-tema"><p>Tema</p>'.utf8_decode($row_tema['nome_tema']).'</div>
                                            <div class="painel-btn-tema">
                                                <button><i class="fas fa-eye"></i><a href=./'.$row_tema['caminho_arquivo_tema'].' target="_blank" rel="noopener noreferrer">Visualizar Tema</a></button>
                                            </div>
                                        </div>
                                    '; 
                                    }
                                }
                            echo '</div>';
                        }
                    }else{
                        echo 'Erro ao selecionar dados da temas_redacao';
                    }
                ?>
            </div>
        </div>
    </body>
</html>