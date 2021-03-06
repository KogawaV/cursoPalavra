<?php
    include './../connection.php';

    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        //echo 'Página em desenvolvimento.';
        $tema_redacao = mysqli_real_escape_string($conn, $_GET['tema_redacao']);
        $modelo_redacao = strtolower(mysqli_real_escape_string($conn, $_GET['modelo_redacao']));
        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);

        $sql_select_texto_redacao = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND id_red = $id_redacao";
        $sql_select_texto_redacao_result = mysqli_query($conn, $sql_select_texto_redacao);
        if($sql_select_texto_redacao_result){
            while($row_texto_redacao = mysqli_fetch_array($sql_select_texto_redacao_result)){
                $texto_redacao_aluno = nl2br($row_texto_redacao['texto_redacao_escrita']);
            }

            if($modelo_redacao == 'unicamp'){
                echo    '
                <div class="dados-redacao">
                    <div class="logo-plataforma"></div>
                    <div class="logo-unicamp"></div>
                </div>
                <div class="painel_texto_redacao">
                <div class="dados-aluno">
                    <div class="dados">
                        <label>Tema</label><p>'.$tema_redacao.'</p>
                        <label>Aluno</label><p>'.$_SESSION['nome_aluno'].'</p>
                    </div>
                </div>
                    <div class="texto_redacao">'.nl2br($texto_redacao_aluno).'</div>
                    <div class="painel_btn_texto_redacao">
                        <button class="btn-voltar"><a href="./oldRed.php">Voltar para área de redações</a></button>
                    </div>
                </div>';
            }else if($modelo_redacao == 'enem'){
                echo    '
                <div class="dados-redacao">
                    <div class="logo-plataforma"></div>
                    <div class="logo-enem"></div>
                </div>
                <div class="painel_texto_redacao">
                <div class="dados-aluno">
                    <div class="dados">
                        <label>Tema</label><p>'.$tema_redacao.'</p>
                        <label>Aluno</label><p>'.$_SESSION['nome_aluno'].'</p>
                    </div>
                </div>
                    <div class="texto_redacao">'.nl2br($texto_redacao_aluno).'</div>
                    <div class="painel_btn_texto_redacao">
                        <button class="btn-voltar"><a href="./oldRed.php">Voltar para área de redações</a></button>
                    </div>
                </div>';
            }else if($modelo_redacao == 'fuvest'){
                echo    '
                <div class="dados-redacao">
                    <div class="logo-plataforma"></div>
                    <div class="logo-fuvest"></div>
                </div>
                <div class="painel_texto_redacao">
                <div class="dados-aluno">
                    <div class="dados">
                        <label>Tema</label><p>'.$tema_redacao.'</p>
                        <label>Aluno</label><p>'.$_SESSION['nome_aluno'].'</p>
                    </div>
                </div>
                    <div class="texto_redacao">'.nl2br($texto_redacao_aluno).'</div>
                    <div class="painel_btn_texto_redacao">
                        <button class="btn-voltar"><a href="./oldRed.php">Voltar para área de redações</a></button>
                    </div>
                </div>';
            }else if($modelo_redacao == 'vunesp'){
                echo    '
                <div class="dados-redacao">
                    <div class="logo-plataforma"></div>
                    <div class="logo-vunesp"></div>
                </div>
                <div class="painel_texto_redacao">
                <div class="dados-aluno">
                    <div class="dados">
                        <label>Tema</label><p>'.$tema_redacao.'</p>
                        <label>Aluno</label><p>'.$_SESSION['nome_aluno'].'</p>
                    </div>
                </div>
                    <div class="texto_redacao">'.nl2br($texto_redacao_aluno).'</div>
                    <div class="painel_btn_texto_redacao">
                        <button class="btn-voltar"><a href="./oldRed.php">Voltar para área de redações</a></button>
                    </div>
                </div>';
            }
        }else{
            echo 'Erro ao selecionar a redação do aluno.';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Curso Palavra</title>

    <style type="text/css">
        *{
            margin: 0px;
            padding: 0px;
        }

        html, body{
            font-family: Arial;
        }

        div.painel_texto_redacao{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            padding: 10px;
        }

        div.painel_texto_redacao > div.texto_redacao{
            width: 950px;
            padding: 10px;
            text-align: left;
            line-height: 30px;
            font-size: 20px;
            border: 1px solid #f1f1f1;
            border-radius: 5px;
            transition-duration: 0.4s;
            word-wrap: break-word;
        }

        div.painel_texto_redacao > div.texto_redacao:hover{
            box-shadow: 1px 1px 20px 1px #000000;
        }

        div.painel_texto_redacao > div.painel_btn_texto_redacao{
            display: flex;
            flex-direction: row;
        }

        div.painel_texto_redacao > div.painel_btn_texto_redacao > button{
            border: none;
            padding: 10px;
            width: 300px;
            border-radius: 3px;
            margin: 10px;
            transition-duration: 0.4s;
        }

        div.painel_texto_redacao > div.painel_btn_texto_redacao > button:hover{
            opacity: 0.9;
            cursor: pointer;
        }

        div.painel_texto_redacao > div.painel_btn_texto_redacao > button > a{
            text-decoration: none;
            color: #ffffff;
            font-size: 15px;
        }

        div.painel_texto_redacao > div.painel_btn_texto_redacao > .btn-corrigir{
            background-color: #379c69;
        }  

        div.painel_texto_redacao > div.painel_btn_texto_redacao > .btn-voltar{
            background-color: #3f51b5;
        }

        div.dados-redacao{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin-bottom: 25px;
        }

        div.painel_texto_redacao > div.dados-aluno{
            background-color: transparent;
            width: 972px;
        }

        div.painel_texto_redacao > div.dados-aluno > div.dados{
            padding: 10px;
            background-color: transparent;
        }

        div.painel_texto_redacao > div.dados-aluno > div.dados> label{
            font-weight: bold;
            margin-bottom: 10px;
        }

        div.painel_texto_redacao > div.dados-aluno div.dados > p{
            text-transform: capitalize;
            margin: 5px 0px;
        }

        div.dados-redacao > div.logo-unicamp{
            width: 100px;
            height: 100px;
            background-image: url('./../../png/UNICAMP_logo.svg.png');
            background-size: 100px 100px;
            margin-left: 50px;
            margin: 20px;
        }

        div.dados-redacao > div.logo-enem{
            width: 200px;
            height: 100px;
            background-image: url('./../../png/Enem_logo.png');
            background-size: 100% 100%;
            margin-left: 50px;
            margin: 20px;
        }

        div.dados-redacao > div.logo-fuvest{
            width: 220px;
            height: 90px;
            background-image: url('./../../png/fuvest_logo.png');
            background-size: cover;
            margin-left: 50px;
            margin: 20px;
        }

        div.dados-redacao > div.logo-vunesp{
            width: 200px;
            height: 50px;
            background-image: url('./../../svg/logo_unesp.svg');
            background-size: 100% 100%;
            margin: 20px;
        }

        div.dados-redacao > div.logo-plataforma{
            width: 200px;
            height: 100px;
            background-image: url('./../../images/logo_center.png');
            background-size: 100% 100%;
            margin: 0px 10px;
        }
    </style>
</head>
<body>
    
</body>
</html>