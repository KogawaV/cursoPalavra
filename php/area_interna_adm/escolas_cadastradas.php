<?php
    include './../connection.php';

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
                <a href="./alunos_cadastrados.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Alunos Cadastrados</span>
                </a>
                <a href="./corretores_cadastrados.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Corretores Cadastrados</span>
                </a>
                <a href="./escolas_cadastradas.php" class="active">
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
                    Cadastro de corretores
                </div>
                <div class="card">
                  
                    <?php
                        $sql_select_escola = "SELECT * FROM escola";
                        $sql_select_escola_result = mysqli_query($conn, $sql_select_escola);
                        if($sql_select_escola_result){
                            $row_escolas = mysqli_num_rows($sql_select_escola_result);
                            if($row_escolas >= 1){
                                echo '
                                <table>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Número de alunos</th>
                                        <th>Opções</th>
                                    </tr>
                                ';
                                while($row_dados_escola = mysqli_fetch_array($sql_select_escola_result)){
                                    echo '
                                        <tr>
                                            <td>'.$row_dados_escola['nome_escola'].'</td> <!-- NOME -->
                                            <td>'.$row_dados_escola['email_escola'].'</td> <!-- EMAIL -->
                                            <td>'.$row_dados_escola['qtd_aluno_escola'].'</td> <!-- Número de alunos nesta escola -->
                                            <td>
                                                <a href="./delete_escola.php?id_escola='.$row_dados_escola['id_escola'].'" class="btn-excluir">Excluir</a>
                                            </td>
                                        </tr>';
                                }
                                echo '</table>';
                            }else{
                                echo '
                                <div class="painel-nada-bd">
                                    <h2>Nenhuma Escola Cadastrada Ainda</h2>
                                    <button class="btn-novo-tema"><a href="./cadastro_escola.php">Cadastrar Nova Escola</a></button>
                                </div>
                            ';
                            }
                            
                        }else{
                            echo 'Erro ao selecionar dados do corretores na base de dados.';
                        }
                    ?>
                   </table>
                </div>
            </div>
        </div>
    </body>
</html>