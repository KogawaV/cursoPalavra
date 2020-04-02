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
        $qtd_red_enviadas;
        $titulo_plano;
        $id_plano;

        $sql_select_dados_aluno = "SELECT * FROM aluno WHERE id_aluno = '{$_SESSION['id_aluno']}'";
        $sql_select_dados_aluno_result = mysqli_query($conn, $sql_select_dados_aluno);
        if($sql_select_dados_aluno_result){
            while($row_dados_aluno = mysqli_fetch_array($sql_select_dados_aluno_result)){
                $nome_aluno = $row_dados_aluno['nome_aluno'];
                $email_aluno = $row_dados_aluno['email_aluno'];
                $senha_aluno = $row_dados_aluno['senha_aluno'];
                $id_plano = $row_dados_aluno['tipo_plano'];
            }

            $sql_select_titulo_plano = "SELECT * FROM tipos_planos WHERE id_tipo_plano = $id_plano";
            $sql_select_titulo_plano_result = mysqli_query($conn, $sql_select_titulo_plano);
            if($sql_select_titulo_plano_result){
                while($row_titulo_plano = mysqli_fetch_array($sql_select_titulo_plano_result)){
                    $titulo_plano = utf8_encode($row_titulo_plano['nome_plano']);
                }
                //echo $titulo_plano;
            }else{
                echo 'Falha ao selecionar o tipo do plano';
            }

            /*echo $nome_aluno;
            echo '<br>'.$email_aluno;
            echo '<br>'.$senha_aluno;*/
        }else{
            echo 'Erro ao selecionar dados do aluno.';
        }


        //SELECIONANDO DADOS RELACIONADOS  AS REDAÇÕES JÁ ENVIADAS PELOS ALUNOS
        $sql_select_qtd_red_escritas = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = '{$_SESSION['id_aluno']}'";
        $sql_select_qtd_red_escritas_result = mysqli_query($conn, $sql_select_qtd_red_escritas);
        if($sql_select_qtd_red_escritas_result){
            $qtd_red_enviadas = mysqli_num_rows($sql_select_qtd_red_escritas_result);
            //echo $qtd_red_enviadas;
        }else{
            echo "Falha ao selecionar os dados.";
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
                <a href="./profile.php" class="active">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Perfil</span>
                </a>
                <a href="./temas.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Temas e Produção</span>
                </a>
                <!-- <a href="./novaRed.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Nova Redação</span>
                </a> 
                <a href="./envRed.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Enviar Redação</span>
                </a> -->
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
                    Meu perfil
                </div>

                <div class="painel-profile">
                    <div class="formulario">
                        <form action="./upgrade_profile.php" method="POST">
                            <input type="email" name="email_aluno" value="<?php echo $email_aluno; ?>">
                            <input type="text" name="nome_aluno" value="<?php echo $nome_aluno; ?>">
                            <input type="text" name="senha_aluno" value="<?php echo $senha_aluno; ?>">
                            <input type="submit" value="Salvar" id="btn_salvar_alteracoes">
                        </form>
                    </div>
                    
                    <div class="dados-planos">
                        <div class="inter-div1">
                            <label>Seu Atual Plano</label>
                            <div class="img-plano"><?php echo $titulo_plano; ?></div>
                            <!-- <button class="btn-mudar-plano">Mudar Plano</button> -->
                        </div>

                        <div class="inter-div2">
                            <label>Número de Redações enviadas</label>
                            <p><?php echo $qtd_red_enviadas; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<style type="text/css">
    input, button{
        outline: none;
    }

    div.painel-profile{
        display: flex;
        flex-direction: row;
        padding: 20px;
    }

    div.painel-profile > div.formulario{
        flex: 50%;
    }

    div.painel-profile > div.dados-planos{
        flex: 50%;
    }

    div.painel-profile > div.formulario > form{
        background-color: transparent;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    input[type="text"], input[type="email"]{
        border:none;
        border-bottom: 1px solid #E1289B;
        background-color: transparent;
        padding: 10px;
        height: 50px;
        margin: 20px 0px;
        width: 80%;
        font-size: 18px;
    }

    input[type="submit"], .btn-mudar-plano{
        width: 30%;
        border: none;
        background-image: linear-gradient(to right, #41B4F5, #E1289B);
        border-radius: 30px;
        height: 30px;
        color: #ffffff;
        font-weight: bold;
        text-transform: uppercase;
    }

    input[type="submit"]:hover, button.btn-mudar-plano:hover{
        opacity: 0.9;
        cursor:pointer;
    }

    div.painel-profile > div.dados-planos{
        background-color: transparent;
        display:flex;
        justify-content: space-around;
    }

    div.painel-profile > div.dados-planos > div.inter-div1{
        flex: 50%;
    }

    div.painel-profile > div.dados-planos > div.inter-div2{
        flex: 50%;
    }

    div.painel-profile > div.dados-planos > div.inter-div2 > p{
        /*border: 1px solid #000000;*/
        padding: 10px 0px;
        font-weight: bold;
    }

    div.painel-profile > div.dados-planos > div.inter-div1 > button{
        width: 60%;
    }

    div.painel-profile > div.dados-planos > div.inter-div1 > label, div.painel-profile > div.dados-planos > div.inter-div2 > label{
        margin: 10px 0px;
        font-weight: bold;
        color: #E1289B;
    }

    div.painel-profile > div.dados-planos > div.inter-div1 > div.img-plano{
        width: 200px;
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: linear-gradient(to right, #41B4F5, #E1289B);

        color: #ffffff;
        font-weight: bold;
        font-size: 170%;
        margin: 10px 0px;

        border-radius : 10px;
    }
</style>

<!-- 

    1 - ADICIONAR UM IMAGEM REPRESENTANDO O TIPO DE PLANO QUE O ALUNO ASSINOU;
    2 - ADICIONAR A MÉDIA DE NOTAS DAS REDAÇÕES DE CADA ALUNO;
    3 - ADICIONAR O NÚMERO DE REDAÇÕES QUE O ALUNO JÁ ENVIOU E QUE AINDA PODE ENVIAR;

-->