<?php
    session_start();
    if(!isset($_SESSION['email_adm'])){
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
        <style>
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
        </style>
        <link rel="stylesheet" href="./../../css/style_table.css">
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
                <!-- <a href="./index.php" class="">
                    <i class="fas fa-home iSidenav"></i>
                    <span class="sidenavTxt">Home</span>
                </a> -->
                <a href="./alunos_cadastrados.php" class="active">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Alunos Cadastrados</span>
                </a>
                <a href="./corretores_cadastrados.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Corretores Cadastrados</span>
                </a>
                <a href="./escolas_cadastradas.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Escolas Cadastradas</span>
                </a>
                <a href="./novo_corretor.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Novo Corretor</span>
                </a>
                <a href="./cadastrar_novo_tema/form_novo_tema.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Novo Tema</span>
                </a>
                <a href="./cadastro_escola.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Nova Escola</span>
                </a>
                <a href="./cadastrar_novo_tema/temas_cadastrados.php" class="">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Temas cadastrados</span>
                </a>
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
                    <a href="./../login/logout.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Que página é essa?
                </div>
                <div class="card">
                    <span>Aqui você pode gerenciar todos os alunos cadastrados na plataforma.
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet volutpat consequat mauris nunc congue nisi vitae suscipit tellus. Ut faucibus pulvinar elementum integer enim neque volutpat.
                    </span>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Cadastro de corretores
                </div>
                <div class="card">
                   
                        <?php
                            include './../connection.php';

                            $sql_select_alunos = "SELECT * FROM aluno";
                            $sql_select_alunos_result = mysqli_query($conn, $sql_select_alunos);
                            if($sql_select_alunos_result){
                                $row_aluno_cad = mysqli_num_rows($sql_select_alunos_result);
                                    if($row_aluno_cad >= 1){
                                        echo '
                                        <table>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Escola</th>
                                                <th>Opções</th>
                                            </tr>
                                        ';
                                        while($row_dados_alunos = mysqli_fetch_array($sql_select_alunos_result)){
                                            echo '
                                                <tr>
                                                    <td>'.$row_dados_alunos['nome_aluno'].'</td> <!-- NOME -->
                                                    <td>'.$row_dados_alunos['email_aluno'].'</td> <!-- EMAIL -->
                                                    <td>'.$row_dados_alunos['nome_escola'].'</td> <!-- PLANO -->
                                                    <td>
                                                        <a href="./delete_aluno.php?id_aluno='.$row_dados_alunos['id_aluno'].'" class="btn-excluir">Excluir</a>
                                                    </td>
                                                </tr>';
                                        }
                                        echo '</table>';

                                }else{
                                    echo '
                                    <div class="painel-nada-bd">
                                        <h2>Nenhum Aluno Cadastrado Ainda</h2>
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