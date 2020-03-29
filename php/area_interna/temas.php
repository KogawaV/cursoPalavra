<?php
    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../connection.php';

        $nome_aluno;
        $email_aluno;
        $senha_aluno;

        $sql_select_dados_aluno = "SELECT * FROM aluno WHERE id_aluno = '{$_SESSION['id_aluno']}'";
        $sql_select_dados_aluno_result = mysqli_query($conn, $sql_select_dados_aluno);
        if($sql_select_dados_aluno_result){
            while($row_dados_aluno = mysqli_fetch_array($sql_select_dados_aluno_result)){
                $nome_aluno = $row_dados_aluno['nome_aluno'];
                $email_aluno = $row_dados_aluno['email_aluno'];
                $senha_aluno = $row_dados_aluno['senha_aluno'];
            }

            /*echo $nome_aluno;
            echo '<br>'.$email_aluno;
            echo '<br>'.$senha_aluno;*/
        }else{
            echo 'Erro ao selecionar dados do aluno.';
        }
    }
?>

<html>
    <head>
        <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
        <link href="./../../css/area_interna_style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="./../../images/favicon.ico">
        <style type="text/css">
            .btn-novo-tema > a{
                text-decoration: none;
                color: #ffffff;
                font-weight: bold;
                font-size: 15px;
            }

            .btn-texto-motivador{
                background-color: #41B4F5;
            }

            .btn-escreva-redacao{
                background-color: #E1289B;
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
                    margin-bottom: 10px;
                }

                .painel-btn-tema{
                    padding: 10px;
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-around;
                }

                .painel-btn-tema > button{
                    border: none;
                    /*background-color: #003399;*/
                    padding: 10px;
                    border-radius: 3px;
                    width: 100%;
                    margin: 5px;
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
                    background-image: url('./../../svg/logo_usp.svg');
                    background-size: 100% 100%;
                    height: 100px;
                    width: 100px;
                }

                div.header-tema > div.logo-unicamp{
                    background-color: transparent;
                    background-image: url('./../../svg/logo_unicamp.svg');
                    background-size: 100% 100%;
                    height: 90px;
                    width: 90px;
                    margin-top: 10px;
                }

                div.header-tema > div.logo-vunesp{
                    background-color: transparent;
                    background-image: url('./../../png/logo_unesp.png');
                    background-size: 100% 100%;
                    height: 90px;
                    width: 90px;
                    margin-top: 10px;
                }

                div.header-tema > div.logo-enem{
                    background-color: transparent;
                    background-image: url('./../../png/Enem_logo.png');
                    background-size: 100% 100%;
                    height: 90px;
                    width: 150px;
                    margin-top: 10px;
                }

                div.painel-escolha-enviar-red{
                    background-color: transparent;
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                }

                div.painel-escolha-enviar-red > button{
                    border:none;
                    border-radius: 3px;
                    padding: 10px;
                    width: 100%;
                    height: 40px;
                    margin: 0px 3px;
                }

                div.painel-escolha-enviar-red > button > a{
                    color: #ffffff;
                    font-size: 20px;
                }

                /*********************** CSS DO TEXT TOOLTIP (https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_tooltip) ***********************/
                .tooltip {
                    position: relative;
                    display: inline-block;
                    border-bottom: 1px dotted black;
                }

                .tooltip .tooltiptext {
                    visibility: hidden;
                    width: 120px;
                    background-color: #555;
                    color: #fff;
                    text-align: center;
                    border-radius: 6px;
                    padding: 5px 0;
                    position: absolute;
                    z-index: 1;
                    bottom: 125%;
                    left: 50%;
                    margin-left: -60px;
                    opacity: 0;
                    transition: opacity 0.3s;
                }

                .tooltip .tooltiptext::after {
                    content: "";
                    position: absolute;
                    top: 100%;
                    left: 50%;
                    margin-left: -5px;
                    border-width: 5px;
                    border-style: solid;
                    border-color: #555 transparent transparent transparent;
                }

                .tooltip:hover .tooltiptext {
                    visibility: visible;
                    opacity: 1;
                }

                div.header-tema > div.logo-obj{
                    background-color: transparent;
                    background-image: url('./../../png/logo_objetivo.png');
                    background-size: 100% 100%;
                    height: 90px;
                    width: 120px;
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
                        <a href="./index.php" class="aLogo">
                            <img class="pointer" src="./../../images/logo_center_fff.png">
                        </a> 
                    </div>
                </div>
                <a href="./index.php" class="">
                    <i class="fas fa-home iSidenav"></i>
                    <span class="sidenavTxt">Desempenho</span>
                </a>
                <a href="./profile.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Perfil</span>
                </a>
                <a href="./temas.php" class="active">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Temas e Produção</span>
                </a>
                <a href="./oldRed.php" class="">
                    <i class="fas fa-folder-open iSidenav"></i>
                    <span class="sidenavTxt">Redações Submetidas</span>
                </a>
            </div>
        <div class="content">
            <div class="header">
                <div class="title">
                    <span>Curso Palavra: Redação Online</span>
                </div>
                <div class="user">
                    <div class="profile center">P</div>
                    <span class="username"><?php echo $_SESSION['email']; ?></span>
                </div>
                <div class="widgets logout">
                    <a href="./../login/logout.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Temas e Produção
                </div>
               <div class="card">
                <?php
                    $sql_select_temas_cadastrados = "SELECT * FROM temas_redacao ORDER BY nome_tema";
                    $sql_select_temas_cadastrados_result = mysqli_query($conn, $sql_select_temas_cadastrados);
                    if($sql_select_temas_cadastrados_result){
                        $row_temas = mysqli_num_rows($sql_select_temas_cadastrados_result);
                        if($row_temas == 0){
                            echo '
                                <div class="painel-nada-bd">
                                    <h2>Nenhum Tema Disponível No Momento</h2>
                                </div>
                            ';
                        }else{
                            /*
                                1 - enem básico
                                2 - enem mais
                                3 - unicamp
                                4 - unicamp mais
                                5 - fuvest/unesp
                                6 - Temas Vocacionados: Medicina e áreas da saúde
                            */
                            $tipo_plano_aluno;

                            $sql_select_tipo_plano_aluno = "SELECT * FROM aluno WHERE id_aluno = '{$_SESSION['id_aluno']}'";
                            $sql_select_tipo_plano_aluno_result = mysqli_query($conn, $sql_select_tipo_plano_aluno);
                            echo '<div class="painel-card-tema">';
                            if($sql_select_tipo_plano_aluno_result){
                                while($row = mysqli_fetch_array($sql_select_tipo_plano_aluno_result)){
                                    $tipo_plano_aluno = $row['tipo_plano'];
                                }
                                

                                switch($tipo_plano_aluno){
                                    case 1://enem 
                                        while($row_tema = mysqli_fetch_array($sql_select_temas_cadastrados_result)){
                                            $caminho_texto_motivadores = './../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'];
                                            echo '<input type="hidden" value='.$caminho_texto_motivadores.' id="caminho_texto_motivador">';

                                            if($row_tema['modelo_tema'] == 'Enem'){
                                                echo '
                                                <div class="card-tema">
                                                    <div class="header-tema"><div class="logo-enem"></div></div>
                                                    <div class="title-tema"><p>Tema</p>'.utf8_encode($row_tema['nome_tema']).'</div>
                                                    <div class="painel-btn-tema">
                                                        <button class="tooltip" style="background-color: #41B4F5;" id="btn_texto_motivador"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                        <button style="background-color: #E1289B;" class="tooltip"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.utf8_encode($row_tema['nome_tema']).'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                                    </div>
                                                </div>
                                            ';
                                            }
                                        } 
                                        break;
                                    
                                    case 2://enem mais
                                        while($row_tema = mysqli_fetch_array($sql_select_temas_cadastrados_result)){
                                            $caminho_texto_motivadores = './../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'];
                                            echo '<input type="hidden" value='.$caminho_texto_motivadores.' id="caminho_texto_motivador">';

                                            if($row_tema['modelo_tema'] == 'Enem'){
                                                echo '
                                                <div class="card-tema">
                                                    <div class="header-tema"><div class="logo-enem"></div></div>
                                                    <div class="title-tema"><p>Tema</p>'.utf8_encode($row_tema['nome_tema']).'</div>
                                                    <div class="painel-btn-tema">
                                                        <button class="tooltip" style="background-color: #41B4F5;" id="btn_texto_motivador"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                        <button style="background-color: #E1289B;" class="tooltip"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.utf8_encode($row_tema['nome_tema']).'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                                    </div>
                                                </div>
                                            ';
                                            }
                                        } 
                                        break;

                                    case 3://unicamp
                                        while($row_tema = mysqli_fetch_array($sql_select_temas_cadastrados_result)){
                                            $caminho_texto_motivadores = './../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'];
                                            echo '<input type="hidden" value='.$caminho_texto_motivadores.' id="caminho_texto_motivador">';

                                            if($row_tema['modelo_tema'] == 'Unicamp'){
                                                echo '
                                                <div class="card-tema">
                                                    <div class="header-tema"><div class="logo-unicamp"></div></div>
                                                    <div class="title-tema"><p>Tema</p>'.$row_tema['nome_tema'].'</div>
                                                    <div class="painel-btn-tema">
                                                        <button class="tooltip" style="background-color: #41B4F5;" id="btn_texto_motivador"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                        <button style="background-color: #E1289B;" class="tooltip"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.utf8_encode($row_tema['nome_tema']).'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                                    </div>
                                                </div>
                                            ';
                                            }
                                        }
                                        break;

                                    case 4://unicamp mais
                                        while($row_tema = mysqli_fetch_array($sql_select_temas_cadastrados_result)){
                                            $caminho_texto_motivadores = './../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'];
                                            echo '<input type="hidden" value='.$caminho_texto_motivadores.' id="caminho_texto_motivador">';

                                            if($row_tema['modelo_tema'] == 'Unicamp'){
                                                echo '
                                                <div class="card-tema">
                                                    <div class="header-tema"><div class="logo-unicamp"></div></div>
                                                    <div class="title-tema"><p>Tema</p>'.utf8_encode($row_tema['nome_tema']).'</div>
                                                    <div class="painel-btn-tema">
                                                        <button class="tooltip" style="background-color: #41B4F5;" id="btn_texto_motivador"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                        <button style="background-color: #E1289B;" class="tooltip"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.utf8_encode($row_tema['nome_tema']).'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                                    </div>
                                                </div>
                                            ';
                                            }
                                        }
                                        break;

                                    case 5://fuvest/unesp
                                            while($row_tema = mysqli_fetch_array($sql_select_temas_cadastrados_result)){
                                                $caminho_texto_motivadores = './../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'];
                                                echo '<input type="hidden" value='.$caminho_texto_motivadores.' id="caminho_texto_motivador">';
    
                                                if($row_tema['modelo_tema'] == 'Fuvest'){
                                                    echo '
                                                    <div class="card-tema">
                                                        <div class="header-tema"><div class="logo-usp"></div></div>
                                                        <div class="title-tema"><p>Tema</p>'.utf8_encode($row_tema['nome_tema']).'</div>
                                                        <div class="painel-btn-tema">
                                                            <button class="tooltip" style="background-color: #41B4F5;" id="btn_texto_motivador"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                            <button style="background-color: #E1289B;" class="tooltip"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.utf8_encode($row_tema['nome_tema']).'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                                        </div>
                                                    </div>';
                                                }else if($row_tema['modelo_tema'] == 'Vunesp'){
                                                    echo '
                                                    <div class="card-tema">
                                                        <div class="header-tema"><div class="logo-vunesp"></div></div>
                                                        <div class="title-tema"><p>Tema</p>'.utf8_encode($row_tema['nome_tema']).'</div>
                                                        <div class="painel-btn-tema">
                                                            <button class="tooltip" style="background-color: #41B4F5;" id="btn_texto_motivador"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                            <button style="background-color: #E1289B;" class="tooltip"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.utf8_encode($row_tema['nome_tema']).'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                                        </div>
                                                    </div>';
                                                }
                                            }
                                            break;

                                    case 6://temas vocacionadas para área da medicina
                                            echo 'Em desenvolvimento';
                                            break;
                                        
                                    case 7:
                                            while($row_tema = mysqli_fetch_array($sql_select_temas_cadastrados_result)){
                                                $caminho_texto_motivadores = './../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'];
                                                echo '<input type="hidden" value='.$caminho_texto_motivadores.' id="caminho_texto_motivador">';
    
                                                if($row_tema['modelo_tema'] == 'Objetivo'){
                                                    echo '
                                                    <div class="card-tema">
                                                        <div class="header-tema"><div class="logo-obj"></div></div>
                                                        <div class="title-tema"><p>Tema</p>'.utf8_encode($row_tema['nome_tema']).'</div>
                                                        <div class="painel-btn-tema">
                                                            <button class="tooltip" style="background-color: #41B4F5;" id="btn_texto_motivador"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                            <button style="background-color: #E1289B;" class="tooltip"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.utf8_encode($row_tema['nome_tema']).'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                                        </div>
                                                    </div>
                                                ';
                                                }
                                            }
                                            break;
                                }
                                echo '</div>';
                            }else{
                                echo 'Falha ao selecionar tipo do aluno.';
                            }
                                /*while($row_tema = mysqli_fetch_array($sql_select_temas_cadastrados_result)){
                                    
                                    
                                    if($row_tema['modelo_tema'] == 'Fuvest'){
                                        echo '
                                        <div class="card-tema">
                                            <div class="header-tema"><div class="logo-usp"></div></div>
                                            <div class="title-tema"><p>Tema</p>'.utf8_encode($row_tema['nome_tema']).'</div>
                                            <div class="painel-btn-tema">
                                                <button class="tooltip" style="background-color: #41B4F5;" id="btn_texto_motivador"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                <button style="background-color: #E1289B;" class="tooltip"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.utf8_encode($row_tema['nome_tema']).'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                            </div>
                                        </div>
                                    ';
                                    }else if($row_tema['modelo_tema'] == 'Unicamp'){
                                        echo '
                                        <div class="card-tema">
                                            <div class="header-tema"><div class="logo-unicamp"></div></div>
                                            <div class="title-tema"><p>Tema</p>'.utf8_encode($row_tema['nome_tema']).'</div>
                                            <div class="painel-btn-tema">
                                                <button class="tooltip" style="background-color: #41B4F5;"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                <button style="background-color: #E1289B;" class="tooltip btn-escreva-redacao"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.$row_tema['nome_tema'].'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                            </div>
                                        </div>
                                    ';
                                    }else if($row_tema['modelo_tema'] == 'Vunesp'){
                                        echo '
                                        <div class="card-tema">
                                            <div class="header-tema"><div class="logo-vunesp"></div></div>
                                            <div class="title-tema"><p>Tema</p>'.utf8_encode($row_tema['nome_tema']).'</div>
                                            <div class="painel-btn-tema">
                                                <button class="tooltip" style="background-color: #41B4F5;"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                <button style="background-color: #E1289B;" class="tooltip btn-escreva-redacao"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.$row_tema['nome_tema'].'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                            </div>
                                        </div>
                                    ';
                                    }else if($row_tema['modelo_tema'] == 'Enem'){
                                        echo '
                                        <div class="card-tema">
                                            <div class="header-tema"><div class="logo-enem"></div></div>
                                            <div class="title-tema"><p>Tema</p>'.utf8_encode($row_tema['nome_tema']).'</div>
                                            <div class="painel-btn-tema">
                                                <button class="tooltip" style="background-color: #41B4F5;"><span class="tooltiptext">Textos Motivadores</span><a href='.$caminho_texto_motivadores.'><i class="fas fa-eye"></i></a></button>
                                                <button style="background-color: #E1289B;" class="tooltip btn-escreva-redacao"><span class="tooltiptext">Escreva sua redação</span><a href="./escrever_redacao.php?nome_tema='.$row_tema['nome_tema'].'&modelo_tema='.$row_tema['modelo_tema'].'&tipo_redacao=2&caminho_tema=./../area_interna_adm/cadastrar_novo_tema/'.$row_tema['caminho_arquivo_tema'].'&universidade='.$row_tema['modelo_tema'].'"><i class="fas fa-pen"></i></a></button>
                                            </div>
                                        </div>
                                    '; 
                                    }
                                }*/
                        }
                    }else{
                        echo 'Erro ao selecionar dados da temas_redacao';
                    }
                ?>
               </div>
            </div>
        </div>
    </body>
</html>

<script>
    var btnTextoMotivador = document.getElementById('btn_texto_motivador');
    btnTextoMotivador.addEventListener("click", ()=>{
        var caminhoTextoMotivador = document.getElementById('caminho_texto_motivador').value;
        //console.log(caminhoTextoMotivador);
        window.location.href="./visualizarTextoMotivador.php?caminho="+caminhoTextoMotivador;
    });

</script>

<!-- 

    1 - ADICIONAR UM IMAGEM REPRESENTANDO O TIPO DE PLANO QUE O ALUNO ASSINOU;
    2 - ADICIONAR A MÉDIA DE NOTAS DAS REDAÇÕES DE CADA ALUNO;
    3 - ADICIONAR O NÚMERO DE REDAÇÕES QUE O ALUNO JÁ ENVIOU E QUE AINDA PODE ENVIAR;
    4 - COM TUDO ISSO DEIXAR ESTÁ PÁGINA MAIS BONITINHA;

-->