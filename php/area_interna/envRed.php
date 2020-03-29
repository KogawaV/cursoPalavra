<?php
    include './../connection.php';
    //header("Content-Type: text/html; charset=ISO-8859-1",true);

    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
        <link href="./../../css/area_interna_style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="./../../images/favicon.ico">
        <script src="./../../js/jquery.js"></script>
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
                <a href="./temas.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Temas e Produção</span>
                </a>
                <!-- <a href="./novaRed.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Nova Redação</span>
                </a> 
                <a href="./envRed.php" class="active">
                    <i class="fas fa-file-upload iSidenav"></i>
                    <span class="sidenavTxt">Enviar Redação</span>
                </a> -->
                <a href="./oldRed.php" class="">
                    <i class="fas fa-folder-open iSidenav"></i>
                    <span class="sidenavTxt">Redações Submetidas</span>
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
                    <span class="username"><?php echo $_SESSION['email'];?></span>
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
                    <span>
                        Aqui, você envia suas redações!
                        <br>
                        Agora que a parte mais difícil passou, o sistema irá te parear com um corretor, que irá avaliar seu desempenho, te mandando uma correção da sua redação! Boa sorte!
                    </span>
                </div>
            </div>
            <div class="cardWrapper">
                <div class="cardTop">
                    Submeter redação
                </div>
                <div class="card">
                    <form action="./validar_envio_de_redacao.php" method="POST" enctype="multipart/form-data" style="display:block;">
                        <h3>Selecione o modelo de redação que será submetida:</h3>
                        <select name="universidade_redacao" id="id_universidade_redacao" style="width: 50%; margin: 10px 0px 30px 0px; display:block; outline: none;" required>
                            <option value="">Selecione o modelo de redação</option>
                            <?php
                                $sql_select_universidade = "SELECT * FROM universidades ORDER BY nome_universidade";
                                $sql_select_universidade_result = mysqli_query($conn, $sql_select_universidade);
                                if($sql_select_universidade_result){
                                    while($row = mysqli_fetch_array($sql_select_universidade_result)){
                                        echo '
                                            <option value="'.$row['nome_universidade'].'">'.$row['nome_universidade'].'</option>
                                        ';
                                    }
                                }else{
                                    echo 'Erro ao selecionar as universidades.';
                                }
                            ?>
                        </select>
                        <h3>Selecione o tema da redação que você irá submeter:</h3>
                        <select name="temas_redacoes" id="id_temas_redacoes" style="margin: 10px 0px 30px 0px; outline: none; width:50%; boder:1px solid #3f51b5; boder-radius: 3px; display: block;" required>
                            <option value="">Selecione o tema da redação: </option>
                        </select>
                        <h3>Selecione o arquivo da redação: </h3>
                        <i class="fas fa-upload"></i>
                        <input type="file" name="redacao_file" id="id_redacao_file" required>
                        <input type="submit" value="Enviar redação" class="btn-enviar-redacao">
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            //quando o valor da combo de estado alterar ele vai executar essa linha
            $('#id_universidade_redacao').change(function () {
            //armazenando o valor do codigo do estado
                var valor = document.getElementById("id_universidade_redacao").value;//ta pegando o id da universidade
                //alert(valor);
                $.get('modelo.php?search=' + valor, function (data) {
                    //procurando a tag OPTION com id da cidade e removendo 
                    $('#id_temas_redacoes').find("option").remove();
                    //montando a combo da cidade
                    $('#id_temas_redacoes').append(data);
                });
            });
        </script>
    </body> 
</html>