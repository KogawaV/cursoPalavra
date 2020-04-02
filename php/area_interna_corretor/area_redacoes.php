<?php
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
        <title>Curso Palavra</title>

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

            div.painel-nada-bd > h2{
                margin: 20px;
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
                <!-- <a href="./index_corretor.php" class="">
                    <i class="fas fa-home iSidenav"></i>
                    <span class="sidenavTxt">Home</span>
                </a> -->
                <a href="./area_redacoes.php" class="active">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Área Redações</span>
                </a>
                <a href="./minhas_correcoes.php" class="">
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
                    Procure por novas redações a serem corrigidas
                </div>
                <div style="display:flex; flex-direction: row; background-color: #ffffff; flex-wrap: wrap; justify-content: center;">
                    <?php
                        include './../connection.php';

                        $id_aluno;
                        $caminho_redacao;
                        $sql_select_redacoes = "SELECT * FROM redacoes_enviadas WHERE status_corrigida = 0";
                        $sql_select_redacoes_result = mysqli_query($conn, $sql_select_redacoes);

                        $sql_select_redacoes_escritas = "SELECT * FROM redacoes_escritas WHERE status_corrigida = 0";
                        $sql_select_redacoes_escritas_result = mysqli_query($conn, $sql_select_redacoes_escritas);

                        if($sql_select_redacoes_result && $sql_select_redacoes_escritas_result){
                            $row_area_red = mysqli_num_rows($sql_select_redacoes_result);
                            $row_area_red_escrita = mysqli_num_rows($sql_select_redacoes_escritas_result);
                            if($row_area_red == 0 && $row_area_red_escrita == 0){
                                echo '
                                <div class="painel-nada-bd">
                                    <h2>Nenhuma Redação Foi Enviada Para Correção Ainda</h2>
                                </div>
                            ';
                            }else{
                                while($row_red = mysqli_fetch_array($sql_select_redacoes_result)){
                                    $id_aluno = $row_red['id_aluno_redacao'];
                                    $caminho_redacao = utf8_decode($row_red['caminho_redacao']);
                                    if($row_red['tipo_redacao'] == 1){
                                        echo '
                                        <div style="background-color: #f1f1f1; width: 300px; border: 1px solid #f1f1f1; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                            <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #a57af5;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                            </div>
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                            </div>
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p>
                                            </div>
                                            <div style="padding: 5px 5px;">
                                                <button style="display: block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #003399;"><i></i><a href="./../area_interna/'.$row_red['caminho_redacao'].'" target="_blank" style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Redação</a></button>
                                                <button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #379c69;"><i></i><a href="./corrigir_redacao.php?caminho_redacao=./../area_interna/'.$row_red['caminho_redacao'].'&id_redacao='.$row_red['id_red'].'&status_corrigida='.$row_red['status_corrigida'].'&nome_corretor='.$row_red['nome_corretor'].'&tipo_redacao='.$row_red['tipo_redacao'].'&id_aluno='.$row_red['id_aluno_redacao'].'" style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Corrigir</a></button>
                                            </div>
                                        </div>';
                                    }else{//tipo que a redação é escrita: tipo redação 2
                                        echo '
                                        <div style="background-color: #f1f1f1; width: 300px; border: 1px solid #f1f1f1; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                            <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #a57af5;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                            </div>
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                            </div>
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p>
                                            </div>
                                            <div style="padding: 5px 5px;">
                                                <button style="display: block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #003399;"><i></i><a href="./view_redacao_escrita.php?tema_redacao='.$row_red['tema_redacao'].'&modelo_redacao='.$row_red['universidade_redacao'].'&nome_aluno='.$row_red['nome_aluno'].'&status_corrigida='.$row_red['status_corrigida'].'&nome_corretor='.$row_red['nome_corretor'].'&tipo_redacao='.$row_red['tipo_redacao'].'&id_aluno='.$row_red['id_aluno_redacao'].'&id_redacao='.$row_red['id_red'].'" style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Redação</a></button>
                                                <button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #379c69;"><i></i><a href="./corrigir_redacao.php?id_aluno='.$row_red['id_aluno_redacao'].'&id_redacao='.$row_red['id_red'].'&status_corrigida='.$row_red['status_corrigida'].'&nome_corretor='.$row_red['nome_corretor'].'&tipo_redacao='.$row_red['tipo_redacao'].'" style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Corrigir</a></button>
                                            </div>
                                        </div>';
                                    }
                                }


                                /**************************** REDAÇÕES ESCRITAS *******************************/
                                while($row_red = mysqli_fetch_array($sql_select_redacoes_escritas_result)){
                                    $id_aluno = $row_red['id_aluno_redacao'];
                                    $caminho_redacao = utf8_decode($row_red['caminho_redacao']);
                                    if($row_red['tipo_redacao'] == 1){
                                        echo '
                                        <div style="background-color: #f1f1f1; width: 300px; border: 1px solid #f1f1f1; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                            <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #a57af5;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                            </div>
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                            </div>
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p>
                                            </div>
                                            <div style="padding: 5px 5px;">
                                                <button style="display: block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #003399;"><i></i><a href="./../area_interna/'.$row_red['caminho_redacao'].'" target="_blank" style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Redação</a></button>
                                                <button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #379c69;"><i></i><a href="./corrigir_redacao.php?caminho_redacao=./../area_interna/'.$row_red['caminho_redacao'].'&id_redacao='.$row_red['id_red'].'&status_corrigida='.$row_red['status_corrigida'].'&nome_corretor='.$row_red['nome_corretor'].'&tipo_redacao='.$row_red['tipo_redacao'].'&id_aluno='.$row_red['id_aluno_redacao'].'" style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Corrigir</a></button>
                                            </div>
                                        </div>';
                                    }else{//tipo que a redação é escrita: tipo redação 2
                                        echo '
                                        <div style="background-color: #f1f1f1; width: 300px; border: 1px solid #f1f1f1; margin: 10px; boder: 1px solid #f1f1f1; border-radius: 5px;"> <!-- class="card-redacao" -->
                                            <div style="text-align: center; padding: 5px; border-bottom: 1px solid #f1f1f1; background-color: #a57af5;"><label style="font-weight:bold; color: #ffffff">Modelo</label></div><!-- tipo de redação -->
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Tema</label><p style="font-size: 14px; min-height: 70px;">'.$row_red['tema_redacao'].'</p>
                                            </div>
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Aluno</label><p style="font-size: 14px;">'.$row_red['nome_aluno'].'</p>
                                            </div>
                                            <div style="padding: 5px;">
                                                <label style="color: #a57af5; font-weight: bold;">Modelo</label><p style="font-size: 14px;">'.$row_red['universidade_redacao'].'</p>
                                            </div>
                                            <div style="padding: 5px 5px;">
                                                <button style="display: block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #003399;"><i></i><a href="./view_redacao_escrita.php?tema_redacao='.$row_red['tema_redacao'].'&modelo_redacao='.$row_red['universidade_redacao'].'&nome_aluno='.$row_red['nome_aluno'].'&status_corrigida='.$row_red['status_corrigida'].'&nome_corretor='.$row_red['nome_corretor'].'&tipo_redacao='.$row_red['tipo_redacao'].'&id_aluno='.$row_red['id_aluno_redacao'].'&id_redacao='.$row_red['id_red'].'" style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Redação</a></button>
                                                <button style="display:block; width: 100%; margin: 10px 0px; padding: 8px; border-radius: 3px; border: none; background-color: #379c69;"><i></i><a href="./corrigir_redacao.php?id_aluno='.$row_red['id_aluno_redacao'].'&id_redacao='.$row_red['id_red'].'&status_corrigida='.$row_red['status_corrigida'].'&nome_corretor='.$row_red['nome_corretor'].'&tipo_redacao='.$row_red['tipo_redacao'].'" style="text-decoration: none; color: #ffffff; font-size: 14px; font-weight: bold;">Corrigir</a></button>
                                            </div>
                                        </div>';
                                    }
                                }
                            }
                        }else{
                            echo 'Erro ao selecionar as redações na base de dados.';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>