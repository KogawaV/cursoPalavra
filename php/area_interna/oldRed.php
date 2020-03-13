<?php
    include './../connection.php';

    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }
?>

<html>
    <head>
        <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
        <link href="./../../css/area_interna_style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="./../../images/favicon.ico">
        <title>Curso Palavra</title>
        <style type="text/css">
            /* ESQUEMA DE CORES 
                1 - VERDE DOS CARDS CORRIGIDOS: BORDA, TÍTULO, LABELS: #02704A
                2 - AMARELO DOS CARDS QUE ESTÃO SENDO CORRIGIDOS: #F2B705
                3 - VERMELHO DOS CARDS QUE AINDA NÃO FORAM CORRIGIDOS: #8C0303
            */ 
            p{
                font-size: 15px;
            }
            .painel-card{
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .painel-status-img{
                display: flex;
                flex-direction: row;
                min-height: 70px;
            }

            a{
                text-decoration: none;
                color: #ffffff;
            }

            i{
                margin: 0px 10px;
            }
            /******************* CARDS QUE JÁ FORAM CORRIGIDOS *******************/
            .card-1{
                border: 3px solid #02704A;
                border-radius: 5px;
                width: 300px;
                margin: 15px;
            }

            .card-1:hover{
                box-shadow: 5px 5px #02704A;
            }
            
            .title-card-1{
                background-color: #02704A;
                padding: 3px;
                color: #ffffff;
                font-weight: bold;
                text-align: center;
            }

            .body-card-1{
                padding: 5px 10px;
            }

            .body-card-1 > div{
                margin: 10px 0px;
            }

            .body-card-tema-1 > label{
                color: #02704A;
                font-weight: bold;
            }

            .body-card-tema-1 > p{
                min-height: 120px;
            }

            .body-card-modelo-1 > label{
                color: #02704A;
                font-weight: bold;
            }

            .body-card-status-1{
                flex: 50%;
            }

            .body-card-status-1 > label{
                color: #02704A;
                font-weight: bold;
            }

            .body-card-img-1{
                width: 50px;
                height: 50px;
                background-color: transparent;
                background-image: url('./../../svg/smile.svg');
                background-position: center;
                background-repeat: no-repeat;
                flex: 50%;
            }

            .body-card-painel-btn-1{
                padding: 0px;
                background-color: transparent;
                display: flex;
                flex-direction: row;
            }

            .btn{
                border-radius: 5px;
                width: 120px;
                margin:  0px 10px;
            }

            .body-card-painel-btn-1 > .btn-redacao{
                flex: 50%;
            }

            .body-card-painel-btn-1 > .btn-correcao{
                flex: 50%;
            }


            /******************* CARDS QUE ESTÃO SENDO CORRIGIDOS *******************/
            .card-2{
                border: 3px solid #F2B705;
                border-radius: 5px;
                width: 300px;
                margin: 15px;
            }

            .card-2:hover{
                box-shadow: 5px 5px #F2B705;
            }

            .title-card-2{
                background-color: #F2B705;
                padding: 3px;
                color: #ffffff;
                font-weight: bold;
                text-align: center;
            }

            .body-card-2{
                padding: 5px 10px;
            }

            .body-card-2 > div{
                margin: 10px 0px;
            }

            .body-card-tema-2 > label{
                color: #F2B705;
                font-weight: bold;
            }

            .body-card-tema-2 > p{
                min-height: 120px;
            }

            .body-card-modelo-2 > label{
                color: #F2B705;
                font-weight: bold;
            }

            .body-card-status-2{
                flex: 50%;
            }

            .body-card-status-2 > label{
                color: #F2B705;
                font-weight: bold;
            }

            .body-card-img-2{
                width: 50px;
                height: 50px;
                background-color: transparent;
                background-image: url('./../../svg/confused.svg');
                background-position: center;
                background-repeat: no-repeat;
                flex: 50%;
            }

            .body-card-painel-btn-2{
                padding: 0px;
            }


            /******************* CARDS QUE AINDA NÃO FORAM CORRIGIDOS *******************/
            .card-0{
                border: 3px solid #8C0303;
                border-radius: 5px;
                width: 300px;
                margin: 15px;
            }

            .card-0:hover{
                box-shadow: 5px 5px #8C0303;
            }

            .title-card-0{
                background-color: #8C0303;
                padding: 3px;
                color: #ffffff;
                font-weight: bold;
                text-align: center;
            }

            .body-card-0{
                padding: 5px 10px;
            }

            .body-card-0 > div{
                margin: 10px 0px;
            }

            .body-card-tema-0 > label{
                color: #8C0303;
                font-weight: bold;
            }

            .body-card-tema-0 > p{
                min-height: 70px;
            }

            .body-card-modelo-0 > label{
                color: #8C0303;
                font-weight: bold;
            }

            .body-card-status-0{
                flex: 50%;
            }

            .body-card-status-0 > label{
                color: #8C0303;
                font-weight: bold;
            }

            .body-card-img-0{
                width: 100%;
                height: 50px;
                background-color: transparent;
                background-image: url('./../../svg/sad.svg');
                background-position: center;
                background-repeat: no-repeat;
                flex: 50%;
            }

            .body-card-painel-btn-0{
                padding: 0px;
            }

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
                width: 50%;
            }

            .btn-novo-tema > a{
                text-decoration: none;
                color: #ffffff;
                font-weight: bold;
                font-size: 15px;
            }

            h2{
                margin: 10px 0px;
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
                <a href="./index.php" class="">
                    <i class="fas fa-home iSidenav"></i>
                    <span class="sidenavTxt">Home</span>
                </a>
                <a href="./profile.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Perfil</span>
                </a>
                <a href="./temas.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Temas</span>
                </a>
                <!-- <a href="./novaRed.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Nova Redação</span>
                </a> 
                <a href="./envRed.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Enviar Redação</span>
                </a> -->
                <a href="./oldRed.php" class="active">
                    <i class="fas fa-folder-open iSidenav"></i>
                    <span class="sidenavTxt">Redações Submetidas</span>
                </a>
            </div>
        <!--<div class="shortcut">
            <a href="#">
                <i class="fas fa-comment-dots iSHortcut"></i>
            </a>
            <a href="#">
                <i class="fas fa-plus iSHortcut bigger"></i>
            </a>
            <a href="#">
                <i class="fas fa-cog iSHortcut"></i>
            </a>
        </div> -->
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
                    <a style="color: black" href="./../login/logout.php"><i style="color: #003399;" class="fas fa-sign-out-alt"></i></a>
                </div>

            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Que página é essa?
                </div>
                <div class="card">
                    <span>Aqui, ficam suas redações passadas e respectivas correções!
                        <br>
                        Algum texto.                    
                        </span>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Redações passadas
                </div>
                <div class="painel-card">
                   <?php
                        $sql_select_redacoes = "SELECT * FROM redacoes_enviadas WHERE id_aluno_redacao = {$_SESSION['id_aluno']}";
                        $sql_select_redacoes_result = mysqli_query($conn, $sql_select_redacoes);

                        $sql_select_redacoes_escritas = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = {$_SESSION['id_aluno']}";
                        $sql_select_redacoes_escritas_result = mysqli_query($conn, $sql_select_redacoes_escritas);

                        $nome_corretor;

                        if($sql_select_redacoes_escritas_result && $sql_select_redacoes_result){
                            $row_red_enviada = mysqli_num_rows($sql_select_redacoes_result);
                            $row_red_escritas = mysqli_num_rows($sql_select_redacoes_escritas_result);
                            if($row_red_enviada == 0 && $row_red_escritas == 0){
                                echo '
                                <div class="painel-nada-bd">
                                    <h2>Nenhum Redação Foi Enviada Ainda</h2>
                                    <button class="btn-novo-tema"><a href="./temas.php">Ver Temas Disponíveis</button>
                                </div>
                                ';
                            }else{
                                if($sql_select_redacoes_result){
                                    $row_old_red = mysqli_num_rows($sql_select_redacoes_result);
                                    if($row_old_red >= 1){
                                        while($row = mysqli_fetch_array($sql_select_redacoes_result)){
                                            if($row['nome_corretor'] == null){
                                                $nome_corretor = 'Na fila de correção.';
                                            }else{
                                                $nome_corretor = $row['nome_corretor'];
                                            }
        
                                            if($row['tipo_redacao'] == 1){
                                                if($row['status_corrigida'] == 1){//já foi corrigida
                                                    echo '
                                                    <div class="card-1">
                                                        <div class="title-card-1"><label>Modelo Da Redação</label></div>
                                                        <div class="body-card-1">
                                                            <div class="body-card-tema-1">
                                                                <label>Tema </label>
                                                                <p>'.$row['tema_redacao'].'</p>
                                                            </div>
                                                            <div class="body-card-modelo-1">
                                                                <label>Modelo </label>
                                                                <p>'.$row['universidade_redacao'].'</p>
                                                            </div>
                                                            <div class="painel-status-img">
                                                                <div class="body-card-status-1">
                                                                    <label>Status </label>
                                                                    <p>Corrigida</p>
                                                                </div>
                                                                <div class="body-card-img-1"></div>
                                                            </div>
                                                            <div class="body-card-painel-btn-1">
                                                                <button class="btn btn-redacao"><i class="fas fa-download"></i><a target="_blank" href="./'.$row['caminho_redacao'].'" rel="noopener noreferrer" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                <button class="btn btn-correcao"><i class="fas fa-comment-dots"></i><a href="./correcoes.php?id_redacao='.$row['id_red'].'&universidade='.$row['universidade_redacao'].'&caminho_redacao='.$row['caminho_redacao'].'&tipo_redacao='.$row['tipo_redacao'].'">Correção</a></button>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }else if($row['status_corrigida'] == 2){//está sendo corrigida
                                                        echo '
                                                        <div class="card-2">
                                                            <div class="title-card-2"><label>Modelo Da Redação</label></div>
                                                            <div class="body-card-2">
                                                                <div class="body-card-tema-2">
                                                                    <label>Tema </label>
                                                                    <p>'.$row['tema_redacao'].'</p>
                                                                </div>
                                                                <div class="body-card-modelo-2">
                                                                    <label>Modelo </label>
                                                                    <p>'.$row['universidade_redacao'].'</p>
                                                                </div>
                                                                <div class="painel-status-img">
                                                                    <div class="body-card-status-2">
                                                                        <label>Status </label>
                                                                        <p>Em processo de correção.</p>
                                                                    </div>
                                                                    <div class="body-card-img-2"></div>
                                                                </div>
                                                                <div class="body-card-painel-btn-2">
                                                                    <button class="btn itemBtn dwnRed"><i class="fas fa-download"></i><a target="_blank" href="./'.$row['caminho_redacao'].'" rel="noopener noreferrer" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }else if($row['status_corrigida'] == 0){//ainda não foi corrigida
                                                        echo '
                                                        <div class="card-0">
                                                            <div class="title-card-0"><label>Modelo Da Redação</label></div>
                                                            <div class="body-card-0">
                                                                <div class="body-card-tema-0">
                                                                    <label>Tema </label>
                                                                    <p>'.$row['tema_redacao'].'</p>
                                                                </div>
                                                                <div class="body-card-modelo-0">
                                                                    <label>Modelo </label>
                                                                    <p>'.$row['universidade_redacao'].'</p>
                                                                </div>
                                                                <div class="painel-status-img">
                                                                    <div class="body-card-status-0">
                                                                        <label>Status </label>
                                                                        <p>Aguardando.</p>
                                                                    </div>
                                                                    <div class="body-card-img-0"></div>
                                                                </div>
                                                                <div class="body-card-painel-btn-0">
                                                                    <button class="btn itemBtn dwnRed"><i class="fas fa-download"></i><a target="_blank" href="./'.$row['caminho_redacao'].'" rel="noopener noreferrer" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }
                                            }else{
                                                if($row['status_corrigida'] == 1){//já foi corrigida
                                                    echo '
                                                    <div class="card-1">
                                                        <div class="title-card-1"><label>Modelo Da Redação</label></div>
                                                        <div class="body-card-1">
                                                            <div class="body-card-tema-1">
                                                                <label>Tema </label>
                                                                <p>'.$row['tema_redacao'].'</p>
                                                            </div>
                                                            <div class="body-card-modelo-1">
                                                                <label>Modelo </label>
                                                                <p>'.$row['universidade_redacao'].'</p>
                                                            </div>
                                                            <div class="painel-status-img">
                                                                <div class="body-card-status-1">
                                                                    <label>Status </label>
                                                                    <p>Corrigida</p>
                                                                </div>
                                                                <div class="body-card-img-1"></div>
                                                            </div>
                                                            <div class="body-card-painel-btn-1">
                                                                <button class="btn btn-redacao"><i class="fas fa-eye"></i><a href="./view_redacao_escrita.php?id_redacao='.$row['id_red'].'&tema_redacao='.$row['tema_redacao'].'&modelo_redacao='.$row['universidade_redacao'].'" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                <button class="btn btn-correcao"><i class="fas fa-comment-dots"></i><a href="./correcoes.php?id_redacao='.$row['id_red'].'&universidade='.$row['universidade_redacao'].'&id_aluno='.$row['id_aluno_redacao'].'&tipo_redacao='.$row['tipo_redacao'].'">Correção</a></button>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }else if($row['status_corrigida'] == 2){//está sendo corrigida
                                                        echo '
                                                        <div class="card-2">
                                                            <div class="title-card-2"><label>Modelo Da Redação</label></div>
                                                            <div class="body-card-2">
                                                                <div class="body-card-tema-2">
                                                                    <label>Tema </label>
                                                                    <p>'.$row['tema_redacao'].'</p>
                                                                </div>
                                                                <div class="body-card-modelo-2">
                                                                    <label>Modelo </label>
                                                                    <p>'.$row['universidade_redacao'].'</p>
                                                                </div>
                                                                <div class="painel-status-img">
                                                                    <div class="body-card-status-2">
                                                                        <label>Status </label>
                                                                        <p>Em processo de correção.</p>
                                                                    </div>
                                                                    <div class="body-card-img-2"></div>
                                                                </div>
                                                                <div class="body-card-painel-btn-2">
                                                                <button class="btn btn-redacao"><i class="fas fa-eye"></i><a href="./view_redacao_escrita.php?id_redacao='.$row['id_red'].'&tema_redacao='.$row['tema_redacao'].'&modelo_redacao='.$row['universidade_redacao'].'" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }else if($row['status_corrigida'] == 0){//ainda não foi corrigida
                                                        echo '
                                                        <div class="card-0">
                                                            <div class="title-card-0"><label>Modelo Da Redação</label></div>
                                                            <div class="body-card-0">
                                                                <div class="body-card-tema-0">
                                                                    <label>Tema </label>
                                                                    <p>'.$row['tema_redacao'].'</p>
                                                                </div>
                                                                <div class="body-card-modelo-0">
                                                                    <label>Modelo </label>
                                                                    <p>'.$row['universidade_redacao'].'</p>
                                                                </div>
                                                                <div class="painel-status-img">
                                                                    <div class="body-card-status-0">
                                                                        <label>Status </label>
                                                                        <p>Aguardando.</p>
                                                                    </div>
                                                                    <div class="body-card-img-0"></div>
                                                                </div>
                                                                <div class="body-card-painel-btn-0">
                                                                <button class="btn btn-redacao"><i class="fas fa-eye"></i><a href="./view_redacao_escrita.php?id_redacao='.$row['id_red'].'&tema_redacao='.$row['tema_redacao'].'&modelo_redacao='.$row['universidade_redacao'].'" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }
                                            }
                                        }
                                    }else{
                                        //echo 'Nenhum redação enviada';
                                    }
                                }else{
                                    echo 'Erro ao selecionar dados das redações.';
                                }

                                /******************************* REDAÇÃO ESCRITA *************************************/
                                if($sql_select_redacoes_escritas_result){
                                    $row_old_red = mysqli_num_rows($sql_select_redacoes_escritas_result);
                                    if($row_old_red >= 1){
                                        while($row = mysqli_fetch_array($sql_select_redacoes_escritas_result)){
                                            if($row['nome_corretor'] == null){
                                                $nome_corretor = 'Na fila de correção.';
                                            }else{
                                                $nome_corretor = $row['nome_corretor'];
                                            }

                                            if($row['tipo_redacao'] == 1){
                                                if($row['status_corrigida'] == 1){//já foi corrigida
                                                    echo '
                                                    <div class="card-1">
                                                        <div class="title-card-1"><label>Modelo Da Redação</label></div>
                                                        <div class="body-card-1">
                                                            <div class="body-card-tema-1">
                                                                <label>Tema </label>
                                                                <p>'.utf8_encode($row['tema_redacao']).'</p>
                                                            </div>
                                                            <div class="body-card-modelo-1">
                                                                <label>Modelo </label>
                                                                <p>'.$row['universidade_redacao'].'</p>
                                                            </div>
                                                            <div class="painel-status-img">
                                                                <div class="body-card-status-1">
                                                                    <label>Status </label>
                                                                    <p>Corrigida</p>
                                                                </div>
                                                                <div class="body-card-img-1"></div>
                                                            </div>
                                                            <div class="body-card-painel-btn-1">
                                                                <button class="btn btn-redacao"><i class="fas fa-download"></i><a target="_blank" href="./'.$row['caminho_redacao'].'" rel="noopener noreferrer" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                <button class="btn btn-correcao"><i class="fas fa-comment-dots"></i><a href="./correcoes.php?id_redacao='.$row['id_red'].'&universidade='.$row['universidade_redacao'].'&caminho_redacao='.$row['caminho_redacao'].'&tipo_redacao='.$row['tipo_redacao'].'">Correção</a></button>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }else if($row['status_corrigida'] == 2){//está sendo corrigida
                                                        echo '
                                                        <div class="card-2">
                                                            <div class="title-card-2"><label>Modelo Da Redação</label></div>
                                                            <div class="body-card-2">
                                                                <div class="body-card-tema-2">
                                                                    <label>Tema </label>
                                                                    <p>'.utf8_encode($row['tema_redacao']).'</p>
                                                                </div>
                                                                <div class="body-card-modelo-2">
                                                                    <label>Modelo </label>
                                                                    <p>'.$row['universidade_redacao'].'</p>
                                                                </div>
                                                                <div class="painel-status-img">
                                                                    <div class="body-card-status-2">
                                                                        <label>Status </label>
                                                                        <p>Em processo de correção.</p>
                                                                    </div>
                                                                    <div class="body-card-img-2"></div>
                                                                </div>
                                                                <div class="body-card-painel-btn-2">
                                                                    <button class="btn itemBtn dwnRed"><i class="fas fa-download"></i><a target="_blank" href="./'.$row['caminho_redacao'].'" rel="noopener noreferrer" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }else if($row['status_corrigida'] == 0){//ainda não foi corrigida
                                                        echo '
                                                        <div class="card-0">
                                                            <div class="title-card-0"><label>Modelo Da Redação</label></div>
                                                            <div class="body-card-0">
                                                                <div class="body-card-tema-0">
                                                                    <label>Tema </label>
                                                                    <p>'.utf8_encode($row['tema_redacao']).'</p>
                                                                </div>
                                                                <div class="body-card-modelo-0">
                                                                    <label>Modelo </label>
                                                                    <p>'.$row['universidade_redacao'].'</p>
                                                                </div>
                                                                <div class="painel-status-img">
                                                                    <div class="body-card-status-0">
                                                                        <label>Status </label>
                                                                        <p>Aguardando.</p>
                                                                    </div>
                                                                    <div class="body-card-img-0"></div>
                                                                </div>
                                                                <div class="body-card-painel-btn-0">
                                                                    <button class="btn itemBtn dwnRed"><i class="fas fa-download"></i><a target="_blank" href="./'.$row['caminho_redacao'].'" rel="noopener noreferrer" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }
                                            }else{
                                                if($row['status_corrigida'] == 1){//já foi corrigida
                                                    echo '
                                                    <div class="card-1">
                                                        <div class="title-card-1"><label>Modelo Da Redação</label></div>
                                                        <div class="body-card-1">
                                                            <div class="body-card-tema-1">
                                                                <label>Tema </label>
                                                                <p>'.utf8_encode($row['tema_redacao']).'</p>
                                                            </div>
                                                            <div class="body-card-modelo-1">
                                                                <label>Modelo </label>
                                                                <p>'.$row['universidade_redacao'].'</p>
                                                            </div>
                                                            <div class="painel-status-img">
                                                                <div class="body-card-status-1">
                                                                    <label>Status </label>
                                                                    <p>Corrigida</p>
                                                                </div>
                                                                <div class="body-card-img-1"></div>
                                                            </div>
                                                            <div class="body-card-painel-btn-1">
                                                                <button class="btn btn-redacao"><i class="fas fa-eye"></i><a href="./view_redacao_escrita.php?id_redacao='.$row['id_red'].'&tema_redacao='.$row['tema_redacao'].'&modelo_redacao='.$row['universidade_redacao'].'" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                <button class="btn btn-correcao"><i class="fas fa-comment-dots"></i><a href="./correcoes.php?id_redacao='.$row['id_red'].'&universidade='.$row['universidade_redacao'].'&id_aluno='.$row['id_aluno_redacao'].'&tipo_redacao='.$row['tipo_redacao'].'">Correção</a></button>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }else if($row['status_corrigida'] == 2){//está sendo corrigida
                                                        echo '
                                                        <div class="card-2">
                                                            <div class="title-card-2"><label>Modelo Da Redação</label></div>
                                                            <div class="body-card-2">
                                                                <div class="body-card-tema-2">
                                                                    <label>Tema </label>
                                                                    <p>'.utf8_encode($row['tema_redacao']).'</p>
                                                                </div>
                                                                <div class="body-card-modelo-2">
                                                                    <label>Modelo </label>
                                                                    <p>'.$row['universidade_redacao'].'</p>
                                                                </div>
                                                                <div class="painel-status-img">
                                                                    <div class="body-card-status-2">
                                                                        <label>Status </label>
                                                                        <p>Em processo de correção.</p>
                                                                    </div>
                                                                    <div class="body-card-img-2"></div>
                                                                </div>
                                                                <div class="body-card-painel-btn-2">
                                                                <button class="btn btn-redacao"><i class="fas fa-eye"></i><a href="./view_redacao_escrita.php?id_redacao='.$row['id_red'].'&tema_redacao='.$row['tema_redacao'].'&modelo_redacao='.$row['universidade_redacao'].'" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }else if($row['status_corrigida'] == 0){//ainda não foi corrigida
                                                        echo '
                                                        <div class="card-0">
                                                            <div class="title-card-0"><label>Modelo Da Redação</label></div>
                                                            <div class="body-card-0">
                                                                <div class="body-card-tema-0">
                                                                    <label>Tema </label>
                                                                    <p>'.utf8_encode($row['tema_redacao']).'</p>
                                                                </div>
                                                                <div class="body-card-modelo-0">
                                                                    <label>Modelo </label>
                                                                    <p>'.$row['universidade_redacao'].'</p>
                                                                </div>
                                                                <div class="painel-status-img">
                                                                    <div class="body-card-status-0">
                                                                        <label>Status </label>
                                                                        <p>Aguardando.</p>
                                                                    </div>
                                                                    <div class="body-card-img-0"></div>
                                                                </div>
                                                                <div class="body-card-painel-btn-0">
                                                                <button class="btn btn-redacao"><i class="fas fa-eye"></i><a href="./view_redacao_escrita.php?id_redacao='.$row['id_red'].'&tema_redacao='.$row['tema_redacao'].'&modelo_redacao='.$row['universidade_redacao'].'" style="text-decoration: none; color: #ffffff;">Redação</a></button>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }
                                            }
                                        }
                                    }else{
                                        //echo 'Nenhum redação enviada ainda.';
                                    }
                                }
                            }
                        }else{
                            echo 'As querys não estão funcionando.';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>