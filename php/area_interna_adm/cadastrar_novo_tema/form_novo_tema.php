<?php
    include './../../connection.php';

    session_start();
    if(!isset($_SESSION['email_adm'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
    <link href="./../../../css/area_interna_style.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="./../../../images/favicon.ico">
    <title>Cadastro de um novo tema</title>
    <style type="text/css">
        form{
            background-color: transparent;
            padding: 10px;
        }

        {
            margin: 10px;
        }

        input[type="file"]{
            display: block;
        }

        select{
            width: 50%;
            display: block;
        }

        form > p{
            margin: 15px 0px 5px 0px;
            font-weight: bold;
        }

        input[type="submit"]{
            margin: 15px 0px;
            border: none;
            border-radius: 3px;
            padding: 8px;
            background-color: #379c69;
            color: #ffffff;
            font-size: 15px;
        }

        input[type="submit"]:hover{
            cursor: pointer;
            opacity: 0.9;
        }

        input[type="text"]{
            padding: 5px;
            width: 30%;
        }

        input, select{
            outline: none;
        }
    </style>
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
            <a href="./form_novo_tema.php" class="active">
                <i class="fas fa-file-upload iSidenav"></i>
                <span class="sidenavTxt">Novo Tema</span>
            </a>
            <a href="./../cadastro_escola.php" class="">
                <i class="fas fa-file-upload iSidenav"></i>
                <span class="sidenavTxt">Nova Escola</span>
            </a>
            <a href="./temas_cadastrados.php" class="">
                <i class="fas fa-file-upload iSidenav"></i>
                <span class="sidenavTxt">Temas cadastrados</span>
            </a>
        </div>
    <!-- <div class="shortcut">
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
                <h2>Cadastre um novo tema</h2>
                <form action="./upload.php" method="POST" enctype="multipart/form-data">
                    <p>Título:</p> <input type="text" name="titulo_tema" placeholder="Título do tema...">
                    <p>Selecione o arquivo do tema:</p>
                    <input type="file" name="arquivo_tema">
                    <p>Selecione o modelo da redação: </p>
                    <select name="modelo" id="id_modelo">
                        <option value="">Selecione o modelo da redação</option>
                        <?php
                            $sql_select_universidades = "SELECT * FROM universidades ORDER BY nome_universidade";
                            $sql_select_universidades_result = mysqli_query($conn, $sql_select_universidades);
                            if($sql_select_universidades_result){
                                while($row_universidades = mysqli_fetch_array($sql_select_universidades_result)){
                                    echo '<option value='.$row_universidades['nome_universidade'].'>'.$row_universidades['nome_universidade'].'</option>';
                                }
                            }else{
                                echo 'Erro ao selecionar as universidades na base de dados.';
                            }
                        ?>
                    </select>
                    <input type="submit" value="Salvar tema">
                </form>
            </div>
        </div>
</body>
</html>