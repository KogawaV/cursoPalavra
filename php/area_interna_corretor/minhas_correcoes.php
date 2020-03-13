<?php
    include './../connection.php';

    session_start();
    if(!isset($_SESSION['email_corretor']) && !isset($_SESSION['id_corretor']) && isset($_SESSION['nome_corretor'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }
?>4

<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
        <link href="./../../css/area_interna_style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="./../../images/favicon.ico">
        <title>Curso Palavra</title>
        <style type="text/css">
            .img-corrigido{
                flex: 50%;
                background-image:url('./../../svg/checked.svg');
                background-size: 100% 100%;
                width: 100%;
            }

            .img-warning{
                flex: 50%;
                background-image:url('./../../svg/warning.svg');
                background-size: 100% 100%;
                width: 100%;
            }

            div.painel-legenda{
                display: flex;
                flex-direction: column;
            }

            div.painel-legenda > div{
                display: flex;
                margin: 10px;
            }

            div.img-check{
                width: 25px;
                height: 25px;
                background-image:url('./../../svg/checked.svg');
            }

            div.img-pendente{
                width: 25px;
                height: 25px;
                background-image:url('./../../svg/warning.svg');
            }

            .painel-nada-bd{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            div.painel-nada-bd > h2{
                margin: 15px;
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
                <a href="./index_corretor.php" class="">
                    <i class="fas fa-home iSidenav"></i>
                    <span class="sidenavTxt">Home</span>
                </a>
                <a href="./area_redacoes.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Área Redações</span>
                </a>
                <a href="./minhas_correcoes.php" class="active">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Minhas Correções</span>
                </a>
                <a href="./profile.php" class="">
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
                    <span>Aqui você pode ver as redações que você já corrigiu ou que ainda está corrigindo.
                        <br>
                        <div class="painel-legenda">
                            <div class="check"><div class="img-check"></div><p>  =  Redações Já Corrigidas.</p></div>
                            <div class="pendente"><div class="img-pendente"></div><p>  =  Redações Que Ainda Não Foram Corrigidas.</p></div>
                        </div>
                    </span>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Redações que você já corrigiu
                </div>
                <div style="display:flex; flex-direction: row; background-color: #ffffff; flex-wrap: wrap; justify-content: center;">
                    <?php
                        include './../connection.php';

                        $sql_select_red = "SELECT * FROM redacoes_enviadas WHERE id_corretor = '{$_SESSION['id_corretor']}'";
                        $sql_select_red_result = mysqli_query($conn, $sql_select_red);

                        $sql_select_red_escrita = "SELECT * FROM redacoes_escritas WHERE id_corretor = '{$_SESSION['id_corretor']}'";
                        $sql_select_red_escrita_result = mysqli_query($conn, $sql_select_red_escrita);

                        if($sql_select_red_result){
                            $row_red = mysqli_num_rows($sql_select_red_result);
                            $row_red_escrita = mysqli_num_rows($sql_select_red_escrita_result);
                            if($row_red == 0 && $row_red_escrita == 0){
                                echo '
                                <div class="painel-nada-bd">
                                    <h2>Nenhuma Redação Foi Selecionada Para Correção Ainda</h2>
                                    <button class="btn-novo-tema"><a href="./area_redacoes.php">Selecionar uma redação para correção</a></button>

                                </div>
                            ';
                            }else{
                                while($row_red = mysqli_fetch_array($sql_select_red_result)){
                                    if($row_red['tipo_redacao'] == 1){
                                        if($row_red['status_corrigida'] == 1){//se for igual a corrigida faça
                                            echo '
                                            <div style="background-color: #f1f1f1; width: 300px; border: 2px solid #02704A; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                                <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #02704A;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                                <div style="padding: 5px;">
                                                    <label style="color: #02704A; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                                </div>
                                                <div style="padding: 5px;">
                                                    <label style="color: #02704A; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                                </div>
        
                                                <div style="padding: 5px; display: flex; flex-direction: row;">
                                                    <div style="flex: 50%;"><label style="color: #02704A; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p></div>
                                                    <div class="img-corrigido"></div>
                                                </div>
                                                
                                                <div style="padding: 5px 5px;">
                                                    <!--<button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #3f51b5;"><i></i><a href=./editar_correcao.php?caminho_red=./../area_interna/'.$row_red['caminho_redacao'].'&universidade_redacao='.$row_red['universidade_redacao'].'&id_redacao='.$row_red['id_red'].' style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Editar Correção</a></button> -->
                                                </div>
                                            </div>';
                                            //echo $row_red['tipo_redacao'];
                                        }else if($row_red['status_corrigida'] == 2){//se for igual a SENDO CORRIGIDA faça
                                            echo '
                                            <div style="background-color: #f1f1f1; width: 300px; border: 1px solid #F2B705; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                                <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #F2B705;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                                <div style="padding: 5px;">
                                                    <label style="color: #F2B705; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                                </div>
                                                <div style="padding: 5px;">
                                                    <label style="color: #F2B705; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                                </div>
                                                <div style="padding: 5px; display: flex; flex-direction: row;">
                                                    <div style="flex: 50%;"><label style="color: #F2B705; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p></div>
                                                    <div class="img-warning"></div>
                                                </div>
                                                <div style="padding: 5px 5px;">
                                                    <button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #379c69;"><i></i><a href=./view_redacao.php?caminho_red=./../area_interna/'.$row_red['caminho_redacao'].'&universidade_redacao='.$row_red['universidade_redacao'].'&id_redacao='.$row_red['id_red'].'&tipo_redacao='.$row_red['tipo_redacao'].' style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Corrigir</a></button>
                                                </div>
                                            </div>';
                                            //echo $row_red['tipo_redacao'];
                                        }
                                    }else{
                                        if($row_red['status_corrigida'] == 1){//se for igual a corrigida faça
                                            echo '
                                            <div style="background-color: #f1f1f1; width: 300px; border: 2px solid #02704A; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                                <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #02704A;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                                <div style="padding: 5px;">
                                                    <label style="color: #02704A; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                                </div>
                                                <div style="padding: 5px;">
                                                    <label style="color: #02704A; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                                </div>
        
                                                <div style="padding: 5px; display: flex; flex-direction: row;">
                                                    <div style="flex: 50%;"><label style="color: #02704A; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p></div>
                                                    <div class="img-corrigido"></div>
                                                </div>
                                                
                                                <div style="padding: 5px 5px;">
                                                    <!--<button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #3f51b5;"><i></i><a href=./editar_correcao.php?caminho_red=./../area_interna/'.$row_red['caminho_redacao'].'&universidade_redacao='.$row_red['universidade_redacao'].'&id_redacao='.$row_red['id_red'].' style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Editar Correção</a></button> -->
                                                </div>
                                            </div>';
                                            //echo $row_red['tipo_redacao'];
                                        }else if($row_red['status_corrigida'] == 2){//se for igual a SENDO CORRIGIDA faça
                                            echo '
                                            <div style="background-color: #f1f1f1; width: 300px; border: 1px solid #F2B705; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                                <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #F2B705;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                                <div style="padding: 5px;">
                                                    <label style="color: #F2B705; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                                </div>
                                                <div style="padding: 5px;">
                                                    <label style="color: #F2B705; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                                </div>
                                                <div style="padding: 5px; display: flex; flex-direction: row;">
                                                    <div style="flex: 50%;"><label style="color: #F2B705; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p></div>
                                                    <div class="img-warning"></div>
                                                </div>
                                                <div style="padding: 5px 5px;">
                                                    <button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #379c69;"><i></i><a href="./view_redacao.php?tema_redacao='.$row_red['tema_redacao'].'&modelo_redacao='.$row_red['universidade_redacao'].'&nome_aluno='.$row_red['nome_aluno'].'&tipo_redacao='.$row_red['tipo_redacao'].'&id_aluno='.$row_red['id_aluno_redacao'].'&id_redacao='.$row_red['id_red'].'" style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Corrigir</a></button>
                                                </div>
                                            </div>';
                                            //echo $row_red['tipo_redacao'];
                                        }
                                    }
                                }

                                while($row_red = mysqli_fetch_array($sql_select_red_escrita_result)){
                                    if($row_red['tipo_redacao'] == 1){
                                        if($row_red['status_corrigida'] == 1){//se for igual a corrigida faça
                                            echo '
                                            <div style="background-color: #f1f1f1; width: 300px; border: 2px solid #02704A; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                                <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #02704A;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                                <div style="padding: 5px;">
                                                    <label style="color: #02704A; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                                </div>
                                                <div style="padding: 5px;">
                                                    <label style="color: #02704A; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                                </div>
        
                                                <div style="padding: 5px; display: flex; flex-direction: row;">
                                                    <div style="flex: 50%;"><label style="color: #02704A; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p></div>
                                                    <div class="img-corrigido"></div>
                                                </div>
                                                
                                                <div style="padding: 5px 5px;">
                                                    <!--<button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #3f51b5;"><i></i><a href=./editar_correcao.php?caminho_red=./../area_interna/'.$row_red['caminho_redacao'].'&universidade_redacao='.$row_red['universidade_redacao'].'&id_redacao='.$row_red['id_red'].' style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Editar Correção</a></button> -->
                                                </div>
                                            </div>';
                                            //echo $row_red['tipo_redacao'];
                                        }else if($row_red['status_corrigida'] == 2){//se for igual a SENDO CORRIGIDA faça
                                            echo '
                                            <div style="background-color: #f1f1f1; width: 300px; border: 1px solid #F2B705; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                                <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #F2B705;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                                <div style="padding: 5px;">
                                                    <label style="color: #F2B705; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                                </div>
                                                <div style="padding: 5px;">
                                                    <label style="color: #F2B705; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                                </div>
                                                <div style="padding: 5px; display: flex; flex-direction: row;">
                                                    <div style="flex: 50%;"><label style="color: #F2B705; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p></div>
                                                    <div class="img-warning"></div>
                                                </div>
                                                <div style="padding: 5px 5px;">
                                                    <button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #379c69;"><i></i><a href=./view_redacao.php?caminho_red=./../area_interna/'.$row_red['caminho_redacao'].'&universidade_redacao='.$row_red['universidade_redacao'].'&id_redacao='.$row_red['id_red'].'&tipo_redacao='.$row_red['tipo_redacao'].' style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Corrigir</a></button>
                                                </div>
                                            </div>';
                                            //echo $row_red['tipo_redacao'];
                                        }
                                    }else{
                                        if($row_red['status_corrigida'] == 1){//se for igual a corrigida faça
                                            echo '
                                            <div style="background-color: #f1f1f1; width: 300px; border: 2px solid #02704A; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                                <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #02704A;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                                <div style="padding: 5px;">
                                                    <label style="color: #02704A; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                                </div>
                                                <div style="padding: 5px;">
                                                    <label style="color: #02704A; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                                </div>
        
                                                <div style="padding: 5px; display: flex; flex-direction: row;">
                                                    <div style="flex: 50%;"><label style="color: #02704A; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p></div>
                                                    <div class="img-corrigido"></div>
                                                </div>
                                                
                                                <div style="padding: 5px 5px;">
                                                    <!--<button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #3f51b5;"><i></i><a href=./editar_correcao.php?caminho_red=./../area_interna/'.$row_red['caminho_redacao'].'&universidade_redacao='.$row_red['universidade_redacao'].'&id_redacao='.$row_red['id_red'].' style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Editar Correção</a></button> -->
                                                </div>
                                            </div>';
                                            //echo $row_red['tipo_redacao'];
                                        }else if($row_red['status_corrigida'] == 2){//se for igual a SENDO CORRIGIDA faça
                                            echo '
                                            <div style="background-color: #f1f1f1; width: 300px; border: 1px solid #F2B705; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                                <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #F2B705;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                                <div style="padding: 5px;">
                                                    <label style="color: #F2B705; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                                </div>
                                                <div style="padding: 5px;">
                                                    <label style="color: #F2B705; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                                </div>
                                                <div style="padding: 5px; display: flex; flex-direction: row;">
                                                    <div style="flex: 50%;"><label style="color: #F2B705; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p></div>
                                                    <div class="img-warning"></div>
                                                </div>
                                                <div style="padding: 5px 5px;">
                                                    <button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #379c69;"><i></i><a href="./view_redacao.php?tema_redacao='.$row_red['tema_redacao'].'&modelo_redacao='.$row_red['universidade_redacao'].'&nome_aluno='.$row_red['nome_aluno'].'&tipo_redacao='.$row_red['tipo_redacao'].'&id_aluno='.$row_red['id_aluno_redacao'].'&id_redacao='.$row_red['id_red'].'" style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Corrigir</a></button>
                                                </div>
                                            </div>';
                                            //echo $row_red['tipo_redacao'];
                                        }
                                    }
                                }
                            }  
                        }else{
                            echo "Erro ao selecionar as redações corrigidas do corretor(a): '{$_SESSION['nome_corretor']}'";
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>