<?php
        include './../connection.php';
        session_start();
        if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
            echo 'Sessões não existem';
            header('Location: ./../../html/login.html');
        }else{
            //echo 'Página em desenvolvimento.';
            $tema_redacao = mysqli_real_escape_string($conn, $_GET['nome_tema']);
            $modelo_redacao = mysqli_real_escape_string($conn, $_GET['modelo_tema']);
            $tipo_redacao = mysqli_real_escape_string($conn, $_GET['tipo_redacao']);
            $caminho_tema = mysqli_real_escape_string($conn, $_GET['caminho_tema']);
            //echo $tema_redacao;
            //echo $modelo_tema;
            //echo $tipo_redacao;
        }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Escreva A Sua Redação</title>

        <style type="text/css">
            *{
                margin: 0px;
                padding: 0px;
            }

            html,body{
                font-family: Arial;
            }

            div.menu-triger > div{
                width: 30px;
                height: 4px;
                margin: 5px 0px;
                background-color: #000000;
                z-index: 1;
            }

            div.menu-triger{
                margin: 10px;
                position:fixed;
                z-index: 2;
            }

            div.menu-triger:hover{
                cursor: pointer;
            }

            div.menu-hide{
                width: 300px;
                height: 100%;
                position: fixed;
                background-color: #f1f1f1;
                left: -100%;
                transition: left 0.5s;
                border: 1px solid #f1f1f1;
            }

            div.painel{
                display: flex;
                flex-direction: row;
            }

            div.painel > div.dados-redacao{
                width: 100%;
            }

            div.dados-redacao > div.logos{
                display:flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;

                background-color: transparent;
                width: 100%;
                height: 100px;
            }

            div.dados-redacao > div.logos > div.logo-fuvest{
                width: 250px;
                height: 100%;
                background-color: transparent;
                background-image: url('./../../png/fuvest_logo_1.png');
                background-position: center;
                background-size: cover;
            }

            div.dados-redacao > div.logos > div.logo-unicamp{
                width: 100px;
                height: 100%;
                background-color: transparent;
                background-image: url('./../../svg/logo_unicamp.svg');
                background-position: center;
                background-size: 100px 100px;
                background-repeat: no-repeat;
            }

            div.dados-redacao > div.logos > div.logo-enem{
                width: 250px;
                height: 100%;
                background-color: transparent;
                background-image: url('./../../png/Enem_logo.png');
                background-position: center;
                background-size: 150px 100px;
                background-repeat: no-repeat;
            }

            div.dados-redacao > div.logos > div.logo-vunesp{
                width: 250px;
                height: 100%;
                background-color: transparent;
                background-image: url('./../../svg/logo_unesp.svg');
                background-position: center;
                background-size: 200px 150px;
                background-repeat: no-repeat;
            }

            div.dados-redacao > form{
                display: flex;
                flex-direction: column;
                justify-content:center;
                align-items: center;
            }

            div.dados-redacao > form > textarea{
                width: 950px;
                height: 1000px;
                font-size: 23px;
                padding: 20px;
                outline: none;
            }

            div.dados-redacao > form > p{
                text-transform: capitalize;
                margin: 25px;
                font-size: 25px;
                text-decoration: underline;
                font-weight:bold;
            }

            div.dados-redacao > form > input[type="submit"]{
                border: none;
                border-radius: 3px;
                background-color: #379c69;
                padding: 10px;
                width: 150px;
                text-align: center;
                color: #ffffff;
                font-weight: bold;
                margin: 10px 0px;
            }

            div.dados-redacao > form > input[type="submit"]:hover{
                cursor: pointer;
                opacity: 0.9;
            }

            div.painel > div.menu-opcoes > div.menu-hide > h2{
                text-transform: capitalize;
                text-align: center;
                padding: 5px;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn{
                /*border: 1px solid #000000;*/
                padding: 10px;
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button{
                width: 150px;
                height: 100px;
                margin: 20px;
                transition-duration: 0.2s;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button > a{
                text-decoration: none;
                color: #ffffff;
                font-weight: bold;
                font-size: 15px;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button.btn-texto{
                background-color: green;
                border: 1px solid green;
                box-shadow:0 5px 0 #006000;           
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button.btn-texto:hover{
                background:#006000;
                box-shadow:0 5px 0 #003f00;       
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button.btn-red{
                background-color: purple;
                border: 1px solid purple;
                box-shadow:0 5px 0 #670167;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button.btn-red:hover{
                background:#670167;
                box-shadow:0 5px 0 #470047;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button.btn-temas{
                background-color: #020A96;
                border: 1px solid #020A96;
                box-shadow:0 5px 0 #01087C;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button.btn-temas:hover{
                background-color: #0311FC;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button.btn-back:hover{
                background-color: #F2B705;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button.btn-back{
                background-color: #F28705;
                border: 1px solid #F28705;
                box-shadow:0 5px 0 #F27405;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button.btn-red:active, button.btn-temas:active, button.btn-back:active, button.btn-textos:active{
                box-shadow: none;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button{
                width: 100px;
                height: 100px;
                margin: 20px;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button{
                width: 100px;
                height: 100px;
                margin: 20px;
            }

            div.painel > div.menu-opcoes > div.menu-hide > div.painel-opcoes-btn > button{
                width: 100px;
                height: 100px;
                margin: 20px;
            }

            
        </style>
</head>
<body>
    <!-- <div class="dados-red">
        <div class="logo-plataforma"></div>
    </div> -->
    <div class="painel">
        
        <div class="menu-opcoes">
            <div class="menu-triger" id="menu-triger">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div class="menu-hide" id="menu-hide">
                <!-- MENU DE OPÇÕES PARA O ALUNO ESCREVER A REDAÇÃO -->
                <h2>opções</h2>
                <div class="painel-opcoes-btn">
                    <button class="btn-texto" id="btn-texto"><a href="./<?php echo $caminho_tema; ?>" target="_blank">Textos Motivadores</a></button>
                    <button class="btn-red" id="btn-red"><a href="./oldRed.php">Minhas Redações</a></button>
                    <button class="btn-temas" id="btn-temas"><a href="./temas.php">Temas Disponíveis</a></button>
                    <button class="btn-back" id="btn-back"><a href="./temas.php">Voltar</a></button>
                </div>
            </div>
        </div>

        <div class="dados-redacao">
            <div class="logos">
                <div class="logo-<?php echo strtolower($modelo_redacao); ?>"></div>
            </div>
            <form action="./validar_redacao_escrita.php?tema_redacao=<?php echo $tema_redacao;?>&modelo_redacao=<?php echo $modelo_redacao; ?>&tipo_redacao=<?php echo $tipo_redacao; ?>" method="POST">
                <p><?php echo utf8_encode($tema_redacao); ?></p>
                <textarea name="texto_redacao" id="id_texto_redacao" maxlength="2900"></textarea>
                <input type="submit" value="Enviar Redação">
            </form>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    var validacao = 1;
    var triger = document.getElementById('menu-triger').addEventListener('click', function(){
        var hide = document.getElementById('menu-hide');
        if(validacao == 1){
            hide.style.left = "0px";
            validacao = 0;
        }else{
            hide.style.left = "-100%";
            validacao = 1;
        }
    });

    document.getElementById('id_texto_redacao').addEventListener("keydown", (e)=>{
        if(e.keyCode === 9) { // TAB
            var posAnterior = this.selectionStart;
            var posPosterior = this.selectionEnd;

            e.target.value = e.target.value.substring(0, posAnterior)
                            + '\t'
                            + e.target.value.substring(posPosterior);

            this.selectionStart = posAnterior + 1;
            this.selectionEnd = posAnterior + 1;
    
            // não move pro próximo elemento
            e.preventDefault();
        }
    }, false);
</script>

<style>
    textarea{
        resize: none;
    }
</style>