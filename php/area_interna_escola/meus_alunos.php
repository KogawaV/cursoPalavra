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
        <link rel="stylesheet" href="./../../css/style_table.css">
        <link rel="stylesheet" href="./../../css/style_btn_table.css">
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
                width: 50%;
            }

            .btn-novo-tema > a{
                text-decoration: none;
                color: #ffffff;
                font-weight: bold;
                font-size: 15px;
            }

            .botam-excluir{
                background-color: red;
            }
        </style>
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
                <a href="./meus_alunos.php" class="active">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Meus Alunos</span>
                </a>
                <a href="./cadastro_aluno.php" class="">
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
                    <span>Aqui você pode gerenciar todos os seus alunos cadastrados.
                        <br>
                        Algum texto.
                    </span>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Seus Alunos
                </div>
                <div class="card">
                    <?php
                        $sql_select_alunos = "SELECT * FROM aluno WHERE id_escola = '{$_SESSION['id_escola']}'";
                        $sql_select_alunos_result = mysqli_query($conn, $sql_select_alunos);
                        if($sql_select_alunos_result){
                            $row_meus_alunos = mysqli_num_rows($sql_select_alunos_result);
                            if($row_meus_alunos >= 1){
                                echo '
                                <table>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Opções</th>
                                    </tr>
                                ';
                                while($row_dados_alunos = mysqli_fetch_array($sql_select_alunos_result)){
                                    echo '
                                        <tr>
                                            <td>'.$row_dados_alunos['nome_aluno'].'</td> <!-- NOME -->
                                            <td>'.$row_dados_alunos['email_aluno'].'</td> <!-- EMAIL -->
                                            <td>
                                                <button style="width: 100px; background-color: #8C0303; padding: 5px; border-radius: 3px; border: none;"><a style="text-decoration: none; font-family: Arial, font-size: 15px; color: #ffffff;" href="./delete_aluno.php?id_aluno='.$row_dados_alunos['id_aluno'].'">Excluir</a></button>
                                                <!-- <button style=" width: 100px; background-color: #379c69; padding: 5px; border-radius: 3px; border: none;"><a style="text-decoration: none; font-family: Arial, font-size: 15px; color: #ffffff;" href="">Ver Perfil</a></button> -->
                                            </td>
                                        </tr>';
                                }
                                echo '<table>';
                            }else{
                                echo '
                                    <div class="painel-nada-bd">
                                        <h2>Nenhum Aluno Foi Cadastrado</h2>
                                        <button class="btn-novo-tema"><a href="./cadastro_aluno.php">Cadastrar Aluno</button>
                                    </div>
                                    ';
                            }
                        }else{
                            echo 'Erro ao selecionar dados do corretores na base de dados.';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>