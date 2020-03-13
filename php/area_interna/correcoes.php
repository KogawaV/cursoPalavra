<?php
    include './../connection.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet"> -->
    <link href="./../../js/jquery.highlight-within-textarea.css" rel="stylesheet" type="text/css">

    <script src="./../../js/jquery.highlight-within-textarea.js"></script>

    <title>Sua correção</title>
    <style type="text/css">
        *{margin:0px; padding: 0px;}

        html, body{
            font-family: Arial;
        }

        div.box-painel-criterios{
            margin-top: 50px;
            border:none;
        }

        div.box-painel-criterios > div.box-nota-total{
            display: flex;
            flex-direction: row;
            margin: 10px 0px;
        }

        div.box-painel-criterios > div.box-nota-total > label{
            font-size: 30px;
            margin-right: 10px;
        }

        div.box-painel-criterios > div.box-criterio{
            border: 1px solid #f1f1f1;
            border-radius: 0px;
            margin:  15px 0px;
            transition-duration: 0.4s;
        }

        div.box-painel-criterios > div.box-criterio:hover{
            /*box-shadow: 1px 1px 10px 3px #000000;*/
            border: 1px solid #f1f1f1;
        }

        div.box-painel-criterios > div.box-criterio > label{
            display: block;
            background-image: linear-gradient(to right, #E1289B, #41B4F5);
            color: #ffffff;
            padding: 5px;
        }

        div.box-painel-criterios > div.box-criterio > p{
            padding: 10px;
        }

        div.box-painel-criterios > div.painel-btn > button{
            border: none;
            border-radius :3px;
            padding: 10px;
            background-color: #379c69;
            transition-duration: 0.4s;
        }

        div.box-painel-criterios > div.painel-btn > button > a{
            text-decoration: none;
            color: #ffffff;
            font-size: 15px;
        }

        div.box-painel-criterios > div.painel-btn > button:hover{
            opacity: 0.9;
        }

        mark{
            background-color: orange;
        }

        /***************** ÁREA DE COMENTÁRIOS DA REDAÇÃO *****************/
        div.elemento_opcao2{
            width: 60%;
            height: 100%;
            overflow: auto;
            background-color: #ffffff;
            left: -100%;
            position:absolute;
            transition: left 0.5s;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        div.painel-logo-comentario{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        div.logo-comentario{
            background-image: url('./../../images/logo_center.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100px 50px;
        }

        div.elemento_opcao2 >  label{
            font-weight: bold;
            font-size: 25px;
            margin: 30px;
        }

        div.elemento_opcao2 > textarea{
            width: 90%;
            height: 100%;
            overflow: auto;
            padding: 20px;
            margin: 10px 0px;
            outline: none;
            font-size: 20px;
            border-radius: 5px;
            resize: none;
        }
        
        div.elemento_opcao2 > button{
            width: 250px;
            padding: 10px;
            border-radius: 3px;
            border: none;
            background-color: #379c69;
        }

        div.elemento_opcao2 > button:hover{
            cursor: pointer;
            opacity: 0.9;
        }

        div.elemento_opcao2 > button > a{
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
        }

        div.dados_alunos > label{
            font-weight: bold;
        }
    </style>    
</head>
<body>
</body>
</html>

<?php
    if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
        $universidade = mysqli_real_escape_string($conn, strtolower($_GET['universidade']));
        $tipo_redacao = mysqli_real_escape_string($conn, $_GET['tipo_redacao']);
        $texto_redacao;
        $row = 0;

        $array_trechos = array();
        $array_comentarios = array();

        $array_entrada = array("'");
        $array_saida = array("");
        //echo $caminho_redacao;
        //echo $id_redacao;
        //echo $universidade;

        if($tipo_redacao == 1){
            $caminho_redacao = mysqli_real_escape_string($conn, $_GET['caminho_redacao']);
            if($universidade == 'enem'){
                $sql_select_texto_redacao = "SELECT * FROM redacoes_enviadas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND id_red= $id_redacao";
                $sql_select_correcao_enem = "SELECT * FROM correcao_enem WHERE id_redacao = $id_redacao";

                $sql_select_texto_redacao_result = mysqli_query($conn, $sql_select_texto_redacao);
                $sql_select_correcao_enem_result = mysqli_query($conn, $sql_select_correcao_enem);
                if($sql_select_texto_redacao_result && $sql_select_correcao_enem_result){
                    //echo 'Dados de correção selecionados com sucesso';
                    while($row_texto_redacao = mysqli_fetch_array($sql_select_texto_redacao_result)){
                        $texto_redacao = nl2br($row_texto_redacao['texto_redacao_escrita']);
                    }

                    while($row_enem = mysqli_fetch_array($sql_select_correcao_enem_result)){
                            $comentario_redacao = nl2br($row_enem['comentario']);

                            $texto_criterio_1;
                            $texto_criterio_2;
                            $texto_criterio_3;
                            $texto_criterio_4;
                            $texto_criterio_5;

                            //critério 1
                            if($row_enem['criterio_1'] == 0){
                                $texto_criterio_1 = 'Demonstra desconhecimento da modalidade escrita formal da Língua Portuguesa.';
                            }else if($row_enem['criterio_1'] == 40){
                                $texto_criterio_1 = 'Demonstra domínio precário da modalidade escrita formal da Língua Portuguesa, de forma sistemática, com diversificados e frequentes desvios gramaticais, de escolha de registro e de convenções da escrita.';
                            }else if($row_enem['criterio_1'] == 80){
                                $texto_criterio_1 = 'Demonstra domínio insuficiente da modalidade escrita formal da Língua Portuguesa, com muitos desvios gramaticais, de escolha de registro e de convenções da escrita.';
                            }else if($row_enem['criterio_1'] == 120){
                                $texto_criterio_1 = 'Demonstra domínio mediano da modalidade escrita formal da Língua Portuguesa e de escolha de registro, com alguns desvios gramaticais e de convenções da escrita.';
                            }else if($row_enem['criterio_1'] == 160){
                                $texto_criterio_1 = 'Demonstra bom domínio da modalidade escrita formal da Língua Portuguesa e de escolha de registro, com poucos desvios gramaticais e de convenções da escrita.';
                            }else if($row_enem['criterio_1'] == 200){
                                $texto_criterio_1 = 'Demonstra excelente domínio da modalidade escrita formal da Língua Portuguesa e de escolha de registro. Desvios gramaticais ou de convenções da escrita serão aceitos somente como excepcionalidade e quando não caracterizem reincidência.';
                            }

                            //critério 2
                            if($row_enem['criterio_2'] == 0){
                                $texto_criterio_2 = 'Fuga ao tema/não atendimento à estrutura dissertativo-argumentativa.';
                            }else if($row_enem['criterio_2'] == 40){
                                $texto_criterio_2 = 'Apresenta o assunto, tangenciando o tema, ou demonstra domínio precário do texto dissertativo- argumentativo, com traços constantes de outros tipos textuais.';
                            }else if($row_enem['criterio_2'] == 80){
                                $texto_criterio_2 = 'Desenvolve o tema recorrendo à cópia de trechos dos textos motivadores ou apresenta domínio insuficiente do texto dissertativo-argumentativo, não atendendo à estrutura com proposição, argumentação e conclusão.';
                            }else if($row_enem['criterio_2'] == 120){
                                $texto_criterio_2 = 'Desenvolve o tema por meio de argumentação previsível e apresenta domínio mediano do texto dissertativo-argumentativo, com proposição, argumentação e conclusão.';
                            }else if($row_enem['criterio_2'] == 160){
                                $texto_criterio_2 = 'Desenvolve o tema por meio de argumentação consistente e apresenta bom domínio do texto dissertativo-argumentativo, com proposição, argumentação e conclusão.';
                            }else if($row_enem['criterio_2'] == 200){
                                $texto_criterio_2 = 'Desenvolve o tema por meio de argumentação consistente, a partir de um repertório sociocultural produtivo, e apresenta excelente domínio do texto dissertativo-argumentativo.';
                            }

                            //criterio 3
                            if($row_enem['criterio_3'] == 0){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões não relacionados ao tema e sem defesa de um ponto de vista.';
                            }else if($row_enem['criterio_3'] == 40){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões pouco relacionados ao tema ou incoerentes e sem defesa de um ponto de vista.  ';
                            }else if($row_enem['criterio_3'] == 80){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões relacionados ao tema, mas desorganizados ou contraditórios e limitados aos argumentos dos textos motivadores, em defesa de um ponto de vista.';
                            }else if($row_enem['criterio_3'] == 120){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões relacionados ao tema, limitados aos argumentos dos textos motivadores e pouco organizados, em defesa de um ponto de vista.';
                            }else if($row_enem['criterio_3'] == 160){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões relacionados ao tema, de forma organizada, com indícios de autoria, em defesa de um ponto de vista.';
                            }else if($row_enem['criterio_3'] == 200){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões relacionados ao tema proposto, de forma consistente e organizada, configurando autoria, em defesa de um ponto de vista.';
                            }

                            //criterio 4
                            if($row_enem['criterio_4'] == 0){
                                $texto_criterio_4 = 'Ausência de marcas de articulação, resultando em fragmentação das ideias.';
                            }else if($row_enem['criterio_4'] == 40){
                                $texto_criterio_4 = 'Articula as partes do texto de forma precária. ';
                            }else if($row_enem['criterio_4'] == 80){
                                $texto_criterio_4 = 'Articula as partes do texto, de forma insuficiente, com muitas inadequações e apresenta repertório limitado de recursos coesivos.';
                            }else if($row_enem['criterio_4'] == 120){
                                $texto_criterio_4 = 'Articula as partes do texto, de forma mediana, com inadequações e apresenta repertório pouco diversificado de recursos coesivos.';
                            }else if($row_enem['criterio_4'] == 160){
                                $texto_criterio_4 = 'Articula as partes do texto com poucas inadequações e apresenta repertório diversificado de recursos coesivos.';
                            }else if($row_enem['criterio_4'] == 200){
                                $texto_criterio_4 = 'Articula bem as partes do texto e apresenta repertório diversificado de recursos coesivos.';
                            }

                            //criterio 5
                            if($row_enem['criterio_5'] == 0){
                                $texto_criterio_5 = 'Não apresenta proposta de intervenção ou apresenta proposta não relacionada ao tema ou ao assunto.';
                            }else if($row_enem['criterio_5'] == 40){
                                $texto_criterio_5 = 'Apresenta proposta de intervenção vaga, precária ou relacionada apenas ao assunto.';
                            }else if($row_enem['criterio_5'] == 80){
                                $texto_criterio_5 = 'Elabora, de forma insuficiente, proposta de intervenção relacionada ao tema ou não articulada com a discussão desenvolvida no texto.';
                            }else if($row_enem['criterio_5'] == 120){
                                $texto_criterio_5 = 'Elabora, de forma mediana, proposta de intervenção relacionada ao tema e articulada à discussão desenvolvida no texto. ';
                            }else if($row_enem['criterio_5'] == 160){
                                $texto_criterio_5 = 'Elabora bem proposta de intervenção relacionada ao tema e articulada à discussão desenvolvida no texto.';
                            }else if($row_enem['criterio_5'] == 200){
                                $texto_criterio_5 = 'Elabora muito bem proposta de intervenção, detalhada, relacionada ao tema e articulada à discussão desenvolvida no texto.';
                            }

                            echo '
                            
                            <div class="box_1">
                                <div class="painel_opcoes_1">
                                    <div class="opcao1" id="id_opcao1" style="background-color: #000000; color: #ffffff; text-align:center;">Ver Correção</div>
                                    <div class="opcao1" id="id_opcao2" style="background-color: #000000; color: #ffffff; text-align:center;">Comentários</div>
                                </div>
                                <div class="painel_redacao_1">
                                    <div class="dados_redacao_1">
                                        <!-- <div class="logo_plataforma"></div> -->
                                        <div class="logo_enem"></div>
                                    </div>
                                <p class="texto_redacao_1">
                                    <iframe src="./'.$caminho_redacao.'" width="950px" height="1200px"></iframe>
                                </p>
                                </div>


                                <!-- ÁREA PARA O CORRETOR COLOCAR COMENTÁRIO SOBRE A REDAÇÃO DO ALUNO -->
                                <div class="elemento_opcao2" id="id_elemento_opcao2">
                                    <div class="painel-logo-comentario">
                                        <div class="logo-comentario"></div>
                                    </div>
                                    <label>Comentários dos corretores sobre a sua correção</label>
                                    <textarea name="comentario_redacao" value='.$comentario_redacao.'>'.$comentario_redacao.'</textarea>
                                    <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                                </div>

                                <div class="elemento_opcao1" id="id_elemento_opcao1">

                                <div class="box-painel-criterios">
                                    <div class="box-nota-total">
                                        <label>Nota total: </label>
                                        <p style="font-size: 30px;">'.$row_enem['nota_final'].'</p>
                                    </div>

                                    <div class="box-criterio box-criterio-1">
                                        <label>I. Demonstrar domínio da norma culta da língua escrita.</label>
                                        <p>'.$texto_criterio_1.'</p>
                                        <p>Nota: '.$row_enem['criterio_1'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-2">
                                        <label>II. Compreender a proposta de redação e aplicar conceitos das várias áreas do conhecimento para desenvolver o tema, dentro dos limites estruturais do texto dissertativo-argumentativo.</label>
                                        <p>'.$texto_criterio_2.'</p>
                                        <p>'.$row_enem['criterio_2'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-3">
                                        <label>III. . Selecionar, relacionar, organizar e interpretar informações, fatos, opiniões e argumentos em defesa de um ponto de vista.</label>
                                        <p>'.$texto_criterio_3.'</p>
                                        <p>'.$row_enem['criterio_3'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-4">
                                        <label>IV. Demonstrar conhecimento dos mecanismos linguísticos necessários para a construção da argumentação.</label>
                                        <p>'.$texto_criterio_4.'</p>
                                        <p>'.$row_enem['criterio_4'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-5">
                                        <label>V. Elaborar proposta de intervenção para o problema abordado, demonstrando respeito aos direitos humanos.</label>
                                        <p>'.$texto_criterio_5.'</p>
                                        <p>'.$row_enem['criterio_5'].'</p>
                                    </div>
                                    <div class="painel-btn">
                                        <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                                    </div>
                                </div>

                                </div>
                            </div>
                            
                            ';
                    }
                }else{
                    echo 'Falha ao selecionar os dados de correção';
                }
            }else if($universidade == 'unicamp'){
                $sql_select_texto_redacao = "SELECT * FROM redacoes_enviadas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND id_red= $id_redacao";
                $sql_select_correcao_unicamp = "SELECT * FROM correcao_unicamp WHERE id_redacao = $id_redacao";

                $sql_select_texto_redacao_result = mysqli_query($conn, $sql_select_texto_redacao);
                $sql_select_correcao_unicamp_result = mysqli_query($conn, $sql_select_correcao_unicamp);
                if($sql_select_texto_redacao_result && $sql_select_correcao_unicamp_result){
                    //echo 'Dados de correção selecionados com sucesso.';
                    while($row_texto_redacao = mysqli_fetch_array($sql_select_texto_redacao_result)){
                        $texto_redacao = nl2br($row_texto_redacao['texto_redacao_escrita']);
                    }

                    while($row_unicamp = mysqli_fetch_array($sql_select_correcao_unicamp_result)){
                        $comentario_redacao = nl2br($row_unicamp['comentario']);

                        $texto_criterio_1;
                        $texto_criterio_2;
                        $texto_criterio_3;
                        $texto_criterio_4;
        
                        //critério 1
                        if($row_unicamp['criterio_1'] == 0){
                            $texto_criterio_1 = 'Não cumprida';
                        }else if($row_unicamp['criterio_1'] == 1){
                            $texto_criterio_1 = 'Cumprida parcialmente';
                        }else if($row_unicamp['criterio_1'] == 2){  
                            $texto_criterio_1 = 'Cumprida plenamente';
                        }
        
                        //criterio 2
                        if($row_unicamp['criterio_2'] == 0){
                            $texto_criterio_2 = 'Desenvolve outro gênero';
                        }else if($row_unicamp['criterio_2'] == 1){
                            $texto_criterio_2 = 'Mal desenvolvido';
                        }else if($row_unicamp['criterio_2'] == 2){
                            $texto_criterio_2 = 'Desenvolvimento adequado';
                        }else if($row_unicamp['criterio_2'] == 3){
                            $texto_criterio_2 = 'Bem desenvolvido';
                        }
        
                        //criterio 3
                        if($row_unicamp['criterio_3'] == 3){
                            $texto_criterio_3 = 'Leitura crítica/inferencial ';
                        }else if($row_unicamp['criterio_3'] == 2){
                            $texto_criterio_3 = 'Leitura mediana/ adequada';
                        }else if($row_unicamp['criterio_3'] == 1){
                            $texto_criterio_3 = 'Leitura superficial/ inadequada ';
                        }else if($row_unicamp['criterio_3'] == 0){
                            $texto_criterio_3 = 'Nenhuma referência/ cópias justapostas';
                        }
        
                        //criterio 4
                        if($row_unicamp['criterio_4'] == 4){
                            $texto_criterio_4 = 'Produtivas  (vocabulário selecionado e recursos coesivos muito bem articulados)';
                        }else if($row_unicamp['criterio_4'] == 3){
                            $texto_criterio_4 = 'Adequadas (vocabulário adequado, de senso comum, erros coesivos pouco graves, que não comprometem a coerência)';
                        }else if($row_unicamp['criterio_4'] == 2){
                            $texto_criterio_4 = 'Simples (alguns erros gramaticais, vocabulário limitado, erros coesivos que não comprometem a coerência)';
                        }else if($row_unicamp['criterio_4'] == 1){
                            $texto_criterio_4 = 'Escolhas inadequadas do léxico, erros graves de ortografia e pontuação; coesão mal articulada, comprometendo a coerência';
                        }else if($row_unicamp['criterio_4'] == 0){
                            $texto_criterio_4 = 'Outro léxico';
                        }

                            echo '
                            
                            <div class="box_1">
                                <div class="painel_opcoes_1">
                                    <div class="opcao1" id="id_opcao1" style="background-color: #000000; color: #ffffff; text-align:center;">Ver Correção</div>
                                    <div class="opcao1" id="id_opcao2" style="background-color: #000000; color: #ffffff; text-align:center;">Comentários</div>
                                </div>
                                <div class="painel_redacao_1">
                                    <div class="dados_redacao_1">
                                        <!-- <div class="logo_plataforma"></div> -->
                                        <div class="logo_unicamp"></div>
                                    </div>
                                <p class="texto_redacao_1">
                                    <iframe src="./'.$caminho_redacao.'" width="950px" height="1200px"></iframe>
                                </p>
                                </div>

                                <!-- ÁREA PARA O CORRETOR COLOCAR COMENTÁRIO SOBRE A REDAÇÃO DO ALUNO -->
                                <div class="elemento_opcao2" id="id_elemento_opcao2">
                                    <div class="painel-logo-comentario">
                                        <div class="logo-comentario"></div>
                                    </div>
                                    <label>Comentários dos corretores sobre a sua correção</label>
                                    <textarea name="comentario_redacao" value='.$comentario_redacao.'>'.$comentario_redacao.'</textarea>
                                    <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                                </div>


                                <div class="elemento_opcao1" id="id_elemento_opcao1">

                                <div class="box-painel-criterios">
                                    <div class="box-nota-total">
                                        <label>Nota total: </label>
                                        <p style="font-size: 30px;">'.$row_unicamp['nota_final'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-1">
                                        <label>I. Proposta Temática (PT).</label>
                                        <p>'.$texto_criterio_1.'</p>
                                        <p>'.$row_unicamp['criterio_1'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-2">
                                        <label>II. Gênero (G).</label>
                                        <p>'.$texto_criterio_2.'</p>
                                        <p>'.$row_unicamp['criterio_2'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-3">
                                        <label>III. Leitura dos Textos da Prova (LT).</label>
                                        <p>'.$texto_criterio_3.'</p>
                                        <p>'.$row_unicamp['criterio_3'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-4">
                                        <label>IV. Leitura dos Textos da Prova (LT).</label>
                                        <p>'.$texto_criterio_4.'</p>
                                        <p>'.$row_unicamp['criterio_4'].'</p>
                                    </div>
                                    <div class="painel-btn">
                                        <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                                    </div>
                                </div>

                                </div>
                            </div>';          
                    }
                }else{
                    echo 'Falha ao selecionar os dados de correção';
                }
            }else if($universidade == 'fuvest'){   
                $sql_select_texto_redacao = "SELECT * FROM redacoes_enviadas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND id_red = $id_redacao";
                $sql_select_correcao_fuvest = "SELECT * FROM correcao_fuvest WHERE id_redacao = $id_redacao";

                $sql_select_texto_redacao_result = mysqli_query($conn, $sql_select_texto_redacao);
                $sql_select_correcao_fuvest_result = mysqli_query($conn, $sql_select_correcao_fuvest);

                if($sql_select_texto_redacao_result && $sql_select_correcao_fuvest_result){
                    //echo 'Dados de coreção selecionados com sucesso.';
                    while($row_texto_redacao = mysqli_fetch_array($sql_select_texto_redacao_result)){
                        $texto_redacao = nl2br($row_texto_redacao['texto_redacao_escrita']);
                    }

                    while($row_fuvest = mysqli_fetch_array($sql_select_correcao_fuvest_result)){
                            $comentario_redacao = nl2br($row_fuvest['comentario']);

                            $texto_criterio_a;
                            $texto_criterio_b;
                            $texto_criterio_c;

                            //critério a
                            if($row_fuvest['criterio_a'] == 0){
                                $texto_criterio_a = 'A redação não se configura como uma dissertação e nem atende minimamente ao tema proposto, há uma fuga total deste ou desconhecimento sobre as estruturas do texto dissertativo.';
                            }else if($row_fuvest['criterio_a'] == 1 ){
                                $texto_criterio_a = 'O texto atende minimante ao tema proposto, não se nota uma clara estrutura dissertativa, apesar de haver uma opinião expressa; não houve qualquer aproveitamento da coletânea ou houve uma leitura totalmente inadequada desta.';
                            }else if($row_fuvest['criterio_a'] == 2 ){
                                $texto_criterio_a = 'A redação apresenta uma resposta pouco articulada para o tema, apesar de estar correta; não se nota uma progressão temática e nem argumentativa, havendo uma circularidade das ideias, comprometendo o projeto de texto, que não traz um aproveitamento claro da coletânea.';
                            }else if($row_fuvest['criterio_a'] == 3){
                                $texto_criterio_a = 'A resposta para o tema está correta, assim como é correto o uso da coletânea, porém não há qualquer indício de autoria, não é aprofundada a opinião e nem reflexivo o uso dos textos que acompanham a proposta de redação.';
                            }else if($row_fuvest['criterio_a'] == 4){
                                $texto_criterio_a = 'A resposta para o tema e as estruturas da dissertação são boas, com indícios de autoria e uso reflexivo dos textos que acompanham a proposta de redação.';
                            }else if($row_fuvest['criterio_a'] == 5){
                                $texto_criterio_a = 'A reposta para o tema e as estruturas da dissertação são excelentes,  tem-se um perfeito aproveitamento da coletânea, com autoria plena do candidato sobre o assunto apresentado na proposta.';
                            }

                            //criterio b
                            if($row_fuvest['criterio_b'] == 0){
                                $texto_criterio_b = 'O texto é apenas uma relação de comentários desconectados, não se nota qualquer articulação entre as ideias, prejudicando gravemente a estrutura da dissertação e a compreensão do projeto de texto do candidato, que desconhece totalmente os recursos coesivos.';
                            }else if($row_fuvest['criterio_b'] == 1 ){
                                $texto_criterio_b = 'A articulação dos argumentos é ruim, há graves contradições entre as ideias, não há um indício de projeto de texto, e várias passagens estão confusas, afetando a progressão das ideias. O candidato mostra que não domina os recursos da coesão textual. ';
                            }else if($row_fuvest['criterio_b'] == 2 ){
                                $texto_criterio_cb= 'A articulação dos argumentos é razoável,  há um indício de projeto texto, porém este não é totalmente claro; a tese aparece, mas os argumentos não são totalmente coerentes com esta; ou a conclusão não apresenta uma análise pertinente com a argumentação. Há um domínio razoável dos recursos coesivos. ';
                            }else if($row_fuvest['criterio_b'] == 3){
                                $texto_criterio_b = 'A argumentação e articulação das ideias no texto apresentam-se corretas, todavia há alguns deslizes que comprometem a coerência em algumas passagens, sem causar grandes prejuízos à leitura do corretor. O emprego dos recursos coesivos é correto, mas não chega a ser elaborado.';
                            }else if($row_fuvest['criterio_b'] == 4){
                                $texto_criterio_b = 'A articulação dos argumentos e das ideias na dissertação é boa, com mínimos deslizes e um domínio claro dos elementos que garantem a progressão argumentativa, sem qualquer prejuízo à leitura.';
                            }else if($row_fuvest['criterio_b'] == 5){
                                $texto_criterio_b = 'A articulação dos argumentos e das ideais na dissertação é excelente, não há qualquer deslize na coerência e na relação entre uma ideia e outra; além disso, há uma sofisticação dos recursos da norma culta que garantem a coesão, culminando em um projeto de texto muito bem sucedido.';
                            }

                            //criterio c
                            if($row_fuvest['criterio_c'] == 0){
                                $texto_criterio_c = 'A linguagem empregada não constitui (em nenhuma passagem do texto) o registro formal, havendo um total desconhecimento das regras gramaticais, uma expressão de que o candidato não foi alfabetizado plenamente ou não tem conhecimento da língua portuguesa, porque sua língua materna é outra.';
                            }else if($row_fuvest['criterio_c'] == 1 ){
                                $texto_criterio_c = 'Problemas graves com o emprego da norma culta, marcas de oralidade em todos os níveis da redação; erros crassos de ortografia, concordância, regência verbal, nominal, flexão verbal etc. O trabalho com a norma culta é muito ruim. ';
                            }else if($row_fuvest['criterio_c'] == 2 ){
                                $texto_criterio_c = 'O trabalho com a norma culta é razoável, o texto tem erros gramaticais e algumas marcas de oralidade, com um vocabulário redundante, que não expressa um total conhecimento do emprego dos recursos da norma culta.';
                            }else if($row_fuvest['criterio_c'] == 3){
                                $texto_criterio_c = 'O trabalho com a norma culta é correto; a escolha lexical e o uso dos elementos da norma culta são adequados, com alguns deslizes que não chegam a constituir o desconhecimento das regras gramaticais.';
                            }else if($row_fuvest['criterio_c'] == 4){
                                $texto_criterio_c = 'A escolha lexical é bem sucedida, com raros problemas de norma culta, há um bom conhecimento das regras gramaticais, porém não se tem ainda a sofisticação da sintaxe.';
                            }else if($row_fuvest['criterio_c'] == 5){
                                $texto_criterio_c = 'Sofisticação da sintaxe e um conhecimento muito bom das regras gramaticais. Admitem-se raros deslizes na norma culta, que não prejudiquem o sentido das ideias. A escolha do vocabulário é perfeita para o que se deseja expressar.';
                            }   

                            echo '
                            
                            <div class="box_1">
                                <div class="painel_opcoes_1">
                                    <div class="opcao1" id="id_opcao1" style="background-color: #000000; color: #ffffff; text-align:center;">Correção</div>
                                    <div class="opcao1" id="id_opcao2" style="background-color: #000000; color: #ffffff; text-align:center;">Comentários</div>
                                </div>
                                <div class="painel_redacao_1">
                                    <div class="dados_redacao_1">
                                        <!-- <div class="logo_plataforma"></div> -->
                                        <div class="logo_fuvest"></div>
                                    </div>
                                <p class="texto_redacao_1">
                                    <iframe src="./'.$caminho_redacao.'" width="950px" height="1200px"></iframe>
                                </p>
                                </div>


                                <!-- ÁREA PARA O CORRETOR COLOCAR COMENTÁRIO SOBRE A REDAÇÃO DO ALUNO -->
                                <div class="elemento_opcao2" id="id_elemento_opcao2">
                                    <div class="painel-logo-comentario">
                                        <div class="logo-comentario"></div>
                                    </div>
                                    <label>Comentários dos corretores sobre a sua correção</label>
                                    <textarea name="comentario_redacao" value='.$comentario_redacao.'>'.$comentario_redacao.'</textarea>
                                    <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                                </div>


                                <div class="elemento_opcao1" id="id_elemento_opcao1">

                                <div class="box-painel-criterios">
                                    <div class="box-nota-total">
                                        <label>Nota total: </label>
                                        <p style="font-size: 30px;">'.$row_fuvest['nota_final'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-1">
                                        <label>A. Proposta e Abordagem do Tema.</label>
                                        <p>'.$texto_criterio_a.'</p>
                                        <p>'.$row_fuvest['criterio_a'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-2">
                                        <label>B. Gênero / Tipo de Texto e Coerência.</label>
                                        <p>'.$texto_criterio_b.'</p>
                                        <p>'.$row_fuvest['criterio_b'].'</p>
                                    </div>
                                    <div class="box-criterio box-criterio-3">
                                        <label>C. Elementos Linguísticos (Modalidade e Coesão).</label>
                                        <p>'.$texto_criterio_c.'</p>
                                        <p>'.$row_fuvest['criterio_c'].'</p>
                                    </div>
                                    <div class="painel-btn">
                                        <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                                    </div>
                                </div>

                                </div>
                            </div>
                            
                            ';
                    }
                }else{
                    echo 'Falha ao selecionar os dados de correção.';
                }
            }else if($universidade == 'vunesp'){
                $sql_select_texto_redacao = "SELECT * FROM redacoes_enviadas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND id_red= $id_redacao";
                $sql_select_correcao_vunesp = "SELECT *  FROM correcao_vunesp WHERE id_redacao = $id_redacao";

                $sql_select_texto_redacao_result = mysqli_query($conn, $sql_select_texto_redacao);
                $sql_select_correcao_vunesp_result = mysqli_query($conn, $sql_select_correcao_vunesp);

                if($sql_select_correcao_vunesp_result && $sql_select_texto_redacao_result){
                    //echo 'Dados de correção selecionado com sucesso.';
                    echo '<div class="box">';
                    while($row_vunesp_texto_red = mysqli_fetch_array($sql_select_texto_redacao_result)){
                        $texto_redacao = nl2br($row_vunesp_texto_red['texto_redacao_escrita']);
                    }
                    while($row_vunesp = mysqli_fetch_array($sql_select_correcao_vunesp_result)){
                        $comentario_redacao = nl2br($row_vunesp['comentario']);

                        $texto_criterio_a;
                        $texto_criterio_b;
                        $texto_criterio_c;

                         //critério a
                         if($row_vunesp['criterio_a'] == 0){
                            $texto_criterio_a = 'O texto não  atende ao tema proposto, tem-se uma fuga total do assunto apresentado para o desenvolvimento da dissertação.';
                        }else if($row_vunesp['criterio_a'] == 1 ){
                            $texto_criterio_a = 'O texto atende minimamente ao tema proposto, não há progressão temática, não se nota aproveitamento da coletânea ou este é ruim, com interpretação equivocada do repertório que integra a coletânea.';
                        }else if($row_vunesp['criterio_a'] == 2 ){
                            $texto_criterio_a = 'A progressão do tema tem muitas falhas, há mera paráfrase da coletânea, apesar de haver uma opinião expressa, esta não se baseia totalmente no assunto apresentado pela proposta ou responde parcialmente a proposta.';
                        }else if($row_vunesp['criterio_a'] == 3){
                            $texto_criterio_a = 'O texto está correto, a análise já apresenta alguns aspectos críticos e com um bom aproveitamento da coletânea, porém há apenas indício de autoria, não se nota autoria plena.';
                        }else if($row_vunesp['criterio_a'] == 4){
                            $texto_criterio_a = 'A resposta atende de forma brilhante o tema, tem-se um excelente aproveitamento da coletânea, com autoria plena do candidato sobre o assunto apresentado na proposta.';
                        }

                        //criterio b
                        if($row_vunesp['criterio_b'] == 0){
                            $texto_criterio_b = 'O texto não se configura como uma dissertação, não há uma estrutura clara de tese, argumentos e conclusão. O zero também se aplica a dissertações que estejam estruturadas em argumentos preconceituosos e que ameacem os direitos humanos. ';
                        }else if($row_vunesp['criterio_b'] == 1 ){
                            $texto_criterio_b = 'A tese e argumentos não são claros, não há progressão argumentativa, o texto fica muito parecido com uma lista de comentários sobre o tema, ou apresenta contradições graves entre tese e argumentos. ';
                        }else if($row_vunesp['criterio_b'] == 2 ){
                            $texto_criterio_b = 'O texto está correto, há clareza da tese e argumentos, a análise já apresenta alguns aspectos críticos, porém há apenas indício de autoria, a argumentação não é irrefutável e não tem autoria plena. ';
                        }else if($row_vunesp['criterio_b'] == 3){
                            $texto_criterio_b = 'A articulação da tese e dos argumentos é bem feita, tem-se uma argumentação irrefutável, com um projeto de texto bem sucedido, constituindo a autoria plena do candidato.  ';
                        }

                        //criterio c
                        if($row_vunesp['criterio_c'] == 0){
                            $texto_criterio_c = 'A linguagem empregada não constitui (em nenhuma passagem do texto) o registro formal, havendo um total desconhecimento das regras gramaticais, uma expressão de que o candidato não foi alfabetizado plenamente ou não tem conhecimento da língua portuguesa, porque sua língua materna é outra. Não há qualquer indício de coesão, sendo as ideias um conjunto confuso que não permite identificar um único momento de clareza na redação. ';
                        }else if($row_vunesp['criterio_c'] == 1 ){
                            $texto_criterio_c = 'Problemas graves com o emprego da norma culta, marcas de oralidade em todos os níveis da redação e muitas quebras da sequência lógica dentro dos parágrafos e entre eles, além de empregos totalmente inadequados dos conectivos e recursos da norma culta que assegurem a coesão. ';
                        }else if($row_vunesp['criterio_c'] == 2 ){
                            $texto_criterio_c = 'Escolha lexical correta, uso adequado dos elementos da norma culta e da coesão, com alguns deslizes que não chegam a comprometer a articulação das ideias no texto. ';
                        }else if($row_vunesp['criterio_c'] == 3){
                            $texto_criterio_c = 'Sofisticação da sintaxe e dos elementos da norma culta e coesão. Admitem-se raros deslizes na norma culta e coesão, que não prejudiquem o sentido das ideias. A escolha do vocabulário é perfeita para o que se deseja expressar.  ';
                        }

                            echo '
                            <div class="box_1">
                                <div class="painel_opcoes_1">
                                    <div class="opcao1" id="id_opcao1" style="background-color: #000000; color: #ffffff; text-align:center;">Ver Correção</div>
                                    <div class="opcao1" id="id_opcao2" style="background-color: #000000; color: #ffffff; text-align:center;">Comentários</div>
                                </div>
                                <div class="painel_redacao_1">
                                    <div class="dados_redacao_1">
                                        <!-- <div class="logo_plataforma"></div> -->
                                        <div class="logo_vunesp"></div>
                                    </div>
                                <p class="texto_redacao_1">
                                    <iframe src="./'.$caminho_redacao.'" width="950px" height="1200px"></iframe>
                                </p>
                                </div>

                                <!-- ÁREA PARA O CORRETOR COLOCAR COMENTÁRIO SOBRE A REDAÇÃO DO ALUNO -->
                                <div class="elemento_opcao2" id="id_elemento_opcao2">
                                <div class="painel-logo-comentario">
                                    <div class="logo-comentario"></div>
                                </div>
                                    <label>Comentários dos corretores sobre a sua correção</label>
                                    <textarea name="comentario_redacao" value='.$comentario_redacao.'>'.$comentario_redacao.'</textarea>
                                    <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                                </div>


                                <div class="elemento_opcao1" id="id_elemento_opcao1">

                                    <div class="box-painel-criterios">
                                        <div class="box-nota-total">
                                            <label>Nota total: </label>
                                            <p style="font-size: 30px;">'.$row_vunesp['nota_final'].'</p>
                                        </div>
                                        <div class="box-criterio box-criterio-1">
                                            <label>A. Tipo de texto e abordagem do tema.</label>
                                            <p>'.$texto_criterio_a.'</p>
                                            <p>Nota: '.$row_vunesp['criterio_a'].'</p>
                                        </div>
                                        <div class="box-criterio box-criterio-2">
                                            <label>B. Estrutura</label>
                                            <p>'.$texto_criterio_b.'</p>
                                            <p>Nota: '.$row_vunesp['criterio_b'].'</p>
                                        </div>
                                        <div class="box-criterio box-criterio-3">
                                            <label>C. Expressão</label>
                                            <p>'.$texto_criterio_c.'</p>
                                            <p>Nota: '.$row_vunesp['criterio_c'].'</p>
                                        </div>
                                        <div class="painel-btn">
                                            <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            ';

                    }
                }else{
                    echo 'Falha ao selecionar os dados de correção.';
                }
            }
        }else{
            //para redações que foram escritas
            if($universidade == 'enem'){
                $sql_select_texto_redacao = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND id_red= $id_redacao";
                $sql_select_correcao_enem = "SELECT * FROM correcao_enem WHERE id_redacao = $id_redacao";

                $sql_select_texto_redacao_result = mysqli_query($conn, $sql_select_texto_redacao);
                $sql_select_correcao_enem_result = mysqli_query($conn, $sql_select_correcao_enem);
                if($sql_select_texto_redacao_result && $sql_select_correcao_enem_result){
                    //echo 'Dados de correção selecionados com sucesso';
                    while($row_texto_redacao = mysqli_fetch_array($sql_select_texto_redacao_result)){
                        $texto_redacao =str_replace($array_entrada, $array_saida, $row_texto_redacao['redacao_alterada']);

                        echo '
                        <div class="painel">
                            <div class="painel_redacao">
                                <div class="logo_enem"></div>
                                <div class="dados_alunos">
                                    <label>Tema</label>
                                    <p>'.$row_texto_redacao['tema_redacao'].'</p>
                                </div>
                                
                                <textarea class="textArea" name="redacao_alterada" id="redacao_alterada" cols="90" rows="40" style="resize: none; background-color: white; color: black; border: none;" disabled>'.$texto_redacao.'</textarea>
                            </div>';
                    }


                    echo '<div class="painel_comentario">
                    <!-- <div class="logo_plataforma"></div> -->
                        <nav class="nav_tabs">
                            <ul>
                                <li>
                                    <input type="radio" name="rd_btn" id="rd_comentarios" class="rd_tab" checked>
                                    <label for="rd_comentarios" class="tab_label">Comentários</label>
                                    <div class="tab-content">';

                    $criterio_1;
                    $criterio_2;
                    $criterio_3;
                    $criterio_4;
                    $criterio_5;
                    $nota_final;
                    while($row_enem = mysqli_fetch_array($sql_select_correcao_enem_result)){
                            $comentario_redacao = nl2br($row_enem['comentario']);
                            $row++;
                            $array_trechos[$row] = $row_enem['trecho_selecionado'];
                            $array_comentarios[$row] = $row_enem['comentario'];

                            $texto_criterio_1;
                            $texto_criterio_2;
                            $texto_criterio_3;
                            $texto_criterio_4;
                            $texto_criterio_5;
                            $trechos_selecionados;
                            $comentarios_trechos_selecionados;

                            $criterio_1 = $row_enem['criterio_1'];
                            $criterio_2 = $row_enem['criterio_2'];
                            $criterio_3 = $row_enem['criterio_3'];
                            $criterio_4 = $row_enem['criterio_4'];
                            $criterio_5 = $row_enem['criterio_5'];
                            $nota_final = $row_enem['nota_final'];

                            //trechos_selecionados
                            $trechos_selecionados = $row_enem['trecho_selecionado'];
                            /*echo $trechos_selecionados;
                            echo '<br>';*/


                            //comentarios_trechos_selecionados
                            $comentarios_trechos_selecionados = $row_enem['comentario'];
                            /*echo $comentarios_trechos_selecionados;
                            echo '<br>';*/

                            //critério 1
                            if($row_enem['criterio_1'] == 0){
                                $texto_criterio_1 = 'Demonstra desconhecimento da modalidade escrita formal da Língua Portuguesa.';
                            }else if($row_enem['criterio_1'] == 40){
                                $texto_criterio_1 = 'Demonstra domínio precário da modalidade escrita formal da Língua Portuguesa, de forma sistemática, com diversificados e frequentes desvios gramaticais, de escolha de registro e de convenções da escrita.';
                            }else if($row_enem['criterio_1'] == 80){
                                $texto_criterio_1 = 'Demonstra domínio insuficiente da modalidade escrita formal da Língua Portuguesa, com muitos desvios gramaticais, de escolha de registro e de convenções da escrita.';
                            }else if($row_enem['criterio_1'] == 120){
                                $texto_criterio_1 = 'Demonstra domínio mediano da modalidade escrita formal da Língua Portuguesa e de escolha de registro, com alguns desvios gramaticais e de convenções da escrita.';
                            }else if($row_enem['criterio_1'] == 160){
                                $texto_criterio_1 = 'Demonstra bom domínio da modalidade escrita formal da Língua Portuguesa e de escolha de registro, com poucos desvios gramaticais e de convenções da escrita.';
                            }else if($row_enem['criterio_1'] == 200){
                                $texto_criterio_1 = 'Demonstra excelente domínio da modalidade escrita formal da Língua Portuguesa e de escolha de registro. Desvios gramaticais ou de convenções da escrita serão aceitos somente como excepcionalidade e quando não caracterizem reincidência.';
                            }

                            //critério 2
                            if($row_enem['criterio_2'] == 0){
                                $texto_criterio_2 = 'Fuga ao tema/não atendimento à estrutura dissertativo-argumentativa.';
                            }else if($row_enem['criterio_2'] == 40){
                                $texto_criterio_2 = 'Apresenta o assunto, tangenciando o tema, ou demonstra domínio precário do texto dissertativo- argumentativo, com traços constantes de outros tipos textuais.';
                            }else if($row_enem['criterio_2'] == 80){
                                $texto_criterio_2 = 'Desenvolve o tema recorrendo à cópia de trechos dos textos motivadores ou apresenta domínio insuficiente do texto dissertativo-argumentativo, não atendendo à estrutura com proposição, argumentação e conclusão.';
                            }else if($row_enem['criterio_2'] == 120){
                                $texto_criterio_2 = 'Desenvolve o tema por meio de argumentação previsível e apresenta domínio mediano do texto dissertativo-argumentativo, com proposição, argumentação e conclusão.';
                            }else if($row_enem['criterio_2'] == 160){
                                $texto_criterio_2 = 'Desenvolve o tema por meio de argumentação consistente e apresenta bom domínio do texto dissertativo-argumentativo, com proposição, argumentação e conclusão.';
                            }else if($row_enem['criterio_2'] == 200){
                                $texto_criterio_2 = 'Desenvolve o tema por meio de argumentação consistente, a partir de um repertório sociocultural produtivo, e apresenta excelente domínio do texto dissertativo-argumentativo.';
                            }

                            //criterio 3
                            if($row_enem['criterio_3'] == 0){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões não relacionados ao tema e sem defesa de um ponto de vista.';
                            }else if($row_enem['criterio_3'] == 40){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões pouco relacionados ao tema ou incoerentes e sem defesa de um ponto de vista.  ';
                            }else if($row_enem['criterio_3'] == 80){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões relacionados ao tema, mas desorganizados ou contraditórios e limitados aos argumentos dos textos motivadores, em defesa de um ponto de vista.';
                            }else if($row_enem['criterio_3'] == 120){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões relacionados ao tema, limitados aos argumentos dos textos motivadores e pouco organizados, em defesa de um ponto de vista.';
                            }else if($row_enem['criterio_3'] == 160){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões relacionados ao tema, de forma organizada, com indícios de autoria, em defesa de um ponto de vista.';
                            }else if($row_enem['criterio_3'] == 200){
                                $texto_criterio_3 = 'Apresenta informações, fatos e opiniões relacionados ao tema proposto, de forma consistente e organizada, configurando autoria, em defesa de um ponto de vista.';
                            }

                            //criterio 4
                            if($row_enem['criterio_4'] == 0){
                                $texto_criterio_4 = 'Ausência de marcas de articulação, resultando em fragmentação das ideias.';
                            }else if($row_enem['criterio_4'] == 40){
                                $texto_criterio_4 = 'Articula as partes do texto de forma precária. ';
                            }else if($row_enem['criterio_4'] == 80){
                                $texto_criterio_4 = 'Articula as partes do texto, de forma insuficiente, com muitas inadequações e apresenta repertório limitado de recursos coesivos.';
                            }else if($row_enem['criterio_4'] == 120){
                                $texto_criterio_4 = 'Articula as partes do texto, de forma mediana, com inadequações e apresenta repertório pouco diversificado de recursos coesivos.';
                            }else if($row_enem['criterio_4'] == 160){
                                $texto_criterio_4 = 'Articula as partes do texto com poucas inadequações e apresenta repertório diversificado de recursos coesivos.';
                            }else if($row_enem['criterio_4'] == 200){
                                $texto_criterio_4 = 'Articula bem as partes do texto e apresenta repertório diversificado de recursos coesivos.';
                            }

                            //criterio 5
                            if($row_enem['criterio_5'] == 0){
                                $texto_criterio_5 = 'Não apresenta proposta de intervenção ou apresenta proposta não relacionada ao tema ou ao assunto.';
                            }else if($row_enem['criterio_5'] == 40){
                                $texto_criterio_5 = 'Apresenta proposta de intervenção vaga, precária ou relacionada apenas ao assunto.';
                            }else if($row_enem['criterio_5'] == 80){
                                $texto_criterio_5 = 'Elabora, de forma insuficiente, proposta de intervenção relacionada ao tema ou não articulada com a discussão desenvolvida no texto.';
                            }else if($row_enem['criterio_5'] == 120){
                                $texto_criterio_5 = 'Elabora, de forma mediana, proposta de intervenção relacionada ao tema e articulada à discussão desenvolvida no texto. ';
                            }else if($row_enem['criterio_5'] == 160){
                                $texto_criterio_5 = 'Elabora bem proposta de intervenção relacionada ao tema e articulada à discussão desenvolvida no texto.';
                            }else if($row_enem['criterio_5'] == 200){
                                $texto_criterio_5 = 'Elabora muito bem proposta de intervenção, detalhada, relacionada ao tema e articulada à discussão desenvolvida no texto.';
                            }

                            
                            //colocando tuddo isso numa div bonitinha
                            echo '
                                <!-- PAINEL ONDE OS COMETÁRIOS FICARAM ARMAZENADOS -->
                                    <div class="card-comentario" id="painel-comentario">
                                        <label>Trecho comentado</label>
                                        <div id="trecho_redacao">'.$trechos_selecionados.'</div>
                                        <label>Comentário ('.$row.')</label>
                                            <textarea name="texto_comentario" id="texto_comentario" disabled>'.$comentarios_trechos_selecionados.'</textarea>
                                    </div>
                            ';
                        }
                        echo "</div></li>";
                        //var_dump($array_trechos);
                        //var_dump($array_comentarios);
                        $string_trechos = implode("|", $array_trechos);

                        echo "<input type='hidden' value='$string_trechos' id='id_trechos'>";


                    echo '
                    <li>
                        <input type="radio" name="rd_btn" id="rd_criterios" class="rd_tab">
                        <label for="rd_criterios" class="tab_label">Critérios de Avaliação</label>
                        <div class="tab-content">
                        <div class="box-painel-criterios">
                            <div class="box-nota-total">
                                <label>Nota total: </label>
                                <p style="font-size: 30px;">'.$nota_final.'</p>
                            </div>

                            <div class="box-criterio box-criterio-1">
                                <label>I. Demonstrar domínio da norma culta da língua escrita.</label>
                                <p>'.$texto_criterio_1.'</p>
                                <p>Nota: '.$criterio_1.'</p>
                            </div>
                            <div class="box-criterio box-criterio-2">
                                <label>II. Compreender a proposta de redação e aplicar conceitos das várias áreas do conhecimento para desenvolver o tema, dentro dos limites estruturais do texto dissertativo-argumentativo.</label>
                                <p>'.$texto_criterio_2.'</p>
                                <p>Nota: '.$criterio_2.'</p>
                            </div>
                            <div class="box-criterio box-criterio-3">
                                <label>III. . Selecionar, relacionar, organizar e interpretar informações, fatos, opiniões e argumentos em defesa de um ponto de vista.</label>
                                <p>'.$texto_criterio_3.'</p>
                                <p>Nota: '.$criterio_3.'</p>
                            </div>
                            <div class="box-criterio box-criterio-4">
                                <label>IV. Demonstrar conhecimento dos mecanismos linguísticos necessários para a construção da argumentação.</label>
                                <p>'.$texto_criterio_4.'</p>
                                <p>Nota: '.$criterio_4.'</p>
                            </div>
                            <div class="box-criterio box-criterio-5">
                                <label>V. Elaborar proposta de intervenção para o problema abordado, demonstrando respeito aos direitos humanos.</label>
                                <p>'.$texto_criterio_5.'</p>
                                <p>Nota: '.$criterio_5.'</p>
                            </div>
                            <div class="painel-btn">
                                <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                            </div>
                        </div>
                    </div>
                </li>
                </ul>
                </nav>
                    ';
                }else{
                    echo 'Falha ao selecionar os dados de correção';
                }
            }else if($universidade == 'unicamp'){
                $sql_select_texto_redacao = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND id_red= $id_redacao";
                $sql_select_correcao_unicamp = "SELECT * FROM correcao_unicamp WHERE id_redacao = $id_redacao";

                $sql_select_texto_redacao_result = mysqli_query($conn, $sql_select_texto_redacao);
                $sql_select_correcao_unicamp_result = mysqli_query($conn, $sql_select_correcao_unicamp);
                if($sql_select_texto_redacao_result && $sql_select_correcao_unicamp_result){
                    //echo 'Dados de correção selecionados com sucesso.';
                    while($row_texto_redacao = mysqli_fetch_array($sql_select_texto_redacao_result)){
                        $texto_redacao = $row_texto_redacao['redacao_alterada'];
                        

                        echo '
                        <div class="painel">
                            <div class="painel_redacao">
                                <div class="logo_unicamp"></div>
                                <div class="dados_alunos">
                                    <label>Tema</label>
                                    <p>'.$row_texto_redacao['tema_redacao'].'</p>

                                    <label>Aluno</label>
                                    <p>'.$row_texto_redacao['nome_aluno'].'</p>
                                </div>
                                
                                <textarea class="textArea" name="redacao_alterada" id="redacao_alterada" cols="90" rows="40" style="resize: none; background-color: white; color: black; border: none;" disabled>'.nl2br($texto_redacao).'</textarea>                            
                            </div>';
                    }

                    echo '<div class="painel_comentario">
                            <!-- <div class="logo_plataforma"></div> -->
                            <nav class="nav_tabs">
                                <ul>
                                    <li>
                                        <input type="radio" name="rd_btn" id="rd_comentarios" class="rd_tab" checked>
                                        <label for="rd_comentarios" class="tab_label">Comentários</label>
                                        <div class="tab-content">';

                    $criterio_1;
                    $criterio_2;
                    $criterio_3;
                    $criterio_4;
                    $notal_final;
                    //$row = mysqli_num_rows($sql_select_correcao_unicamp_result);
                    //echo $row;
                    while($row_unicamp = mysqli_fetch_array($sql_select_correcao_unicamp_result)){
                        $comentario_redacao = nl2br($row_unicamp['comentario']);
                        $row++;
                        $array_trechos[$row] = $row_unicamp['trecho_selecionado'];
                        $array_comentarios[$row] = $row_unicamp['comentario'];
                        //echo $row;

                        $criterio_1 = $row_unicamp['criterio_1'];
                        $criterio_2 = $row_unicamp['criterio_2'];
                        $criterio_3 = $row_unicamp['criterio_3'];
                        $criterio_4 = $row_unicamp['criterio_4'];
                        $nota_final = $row_unicamp['nota_final'];

                        $texto_criterio_1;
                        $texto_criterio_2;
                        $texto_criterio_3;
                        $texto_criterio_4;
                        $trechos_selecionados;
                        $comentarios_trechos_selecionados;

                        //trechos_selecionados
                        $trechos_selecionados = $row_unicamp['trecho_selecionado'];
                        /*echo $trechos_selecionados;
                        echo '<br>';*/


                        //comentarios_trechos_selecionados
                        $comentarios_trechos_selecionados = $row_unicamp['comentario'];
                        /*echo $comentarios_trechos_selecionados;
                        echo '<br>';*/
                        //colocando tuddo isso numa div bonitinha
                        //critério 1
                        if($row_unicamp['criterio_1'] == 0){
                            $texto_criterio_1 = 'Não cumprida';
                        }else if($row_unicamp['criterio_1'] == 1){
                            $texto_criterio_1 = 'Cumprida parcialmente';
                        }else if($row_unicamp['criterio_1'] == 2){
                            $texto_criterio_1 = 'Cumprida plenamente';
                        }
        
                        //criterio 2
                        if($row_unicamp['criterio_2'] == 0){
                            $texto_criterio_2 = 'Desenvolve outro gênero';
                        }else if($row_unicamp['criterio_2'] == 1){
                            $texto_criterio_2 = 'Mal desenvolvido';
                        }else if($row_unicamp['criterio_2'] == 2){
                            $texto_criterio_2 = 'Desenvolvimento adequado';
                        }else if($row_unicamp['criterio_2'] == 3){
                            $texto_criterio_2 = 'Bem desenvolvido';
                        }
        
                        //criterio 3
                        if($row_unicamp['criterio_3'] == 3){
                            $texto_criterio_3 = 'Leitura crítica/inferencial ';
                        }else if($row_unicamp['criterio_3'] == 2){
                            $texto_criterio_3 = 'Leitura mediana/ adequada';
                        }else if($row_unicamp['criterio_3'] == 1){
                            $texto_criterio_3 = 'Leitura superficial/ inadequada ';
                        }else if($row_unicamp['criterio_3'] == 0){
                            $texto_criterio_3 = 'Nenhuma referência/ cópias justapostas';
                        }
        
                        //criterio 4
                        if($row_unicamp['criterio_4'] == 4){
                            $texto_criterio_4 = 'Produtivas  (vocabulário selecionado e recursos coesivos muito bem articulados)';
                        }else if($row_unicamp['criterio_4'] == 3){
                            $texto_criterio_4 = 'Adequadas (vocabulário adequado, de senso comum, erros coesivos pouco graves, que não comprometem a coerência)';
                        }else if($row_unicamp['criterio_4'] == 2){
                            $texto_criterio_4 = 'Simples (alguns erros gramaticais, vocabulário limitado, erros coesivos que não comprometem a coerência)';
                        }else if($row_unicamp['criterio_4'] == 1){
                            $texto_criterio_4 = 'Escolhas inadequadas do léxico, erros graves de ortografia e pontuação; coesão mal articulada, comprometendo a coerência';
                        }else if($row_unicamp['criterio_4'] == 0){
                            $texto_criterio_4 = 'Outro léxico';
                        }

                        //colocando tuddo isso numa div bonitinha
                        echo '
                        <!-- PAINEL ONDE OS COMETÁRIOS FICARAM ARMAZENADOS -->
                            <div class="card-comentario" id="painel-comentario">
                                <label>Trecho comentado</label>
                                <div id="trecho_redacao">'.$trechos_selecionados.'</div>
                                <label>Comentário ('.$row.')</label>
                                    <textarea name="texto_comentario" id="texto_comentario" disabled>'.$comentarios_trechos_selecionados.'</textarea>
                            </div>
                    ';

                    }

                    echo "</div></li>";

                    $string_trechos = implode("|", $array_trechos);
                    echo "<input type='hidden' value='$string_trechos' id='id_trechos'>";

                    echo ' 
                    <li>
                    <input type="radio" name="rd_btn" id="rd_criterios" class="rd_tab">
                    <label for="rd_criterios" class="tab_label">Critérios de Avaliação</label>
                    <div class="tab-content">
                    <div class="box-painel-criterios">
                        <div class="box-nota-total">
                            <label>Nota total: </label>
                            <p style="font-size: 30px;">'.$nota_final.'</p>
                        </div>
                        <div class="box-criterio box-criterio-1">
                            <label>I. Proposta Temática (PT).</label>
                            <p>'.$texto_criterio_1.'</p>
                            <p>Nota: '.$criterio_1.'</p>
                        </div>
                        <div class="box-criterio box-criterio-2">
                            <label>II. Gênero (G).</label>
                            <p>'.$texto_criterio_2.'</p>
                            <p>Nota: '.$criterio_2.'</p>
                        </div>
                        <div class="box-criterio box-criterio-3">
                            <label>III. Leitura dos Textos da Prova (LT).</label>
                            <p>'.$texto_criterio_3.'</p>
                            <p>Nota: '.$criterio_3.'</p>
                        </div>
                        <div class="box-criterio box-criterio-4">
                            <label>IV. Leitura dos Textos da Prova (LT).</label>
                            <p>'.$texto_criterio_4.'</p>
                            <p>Nota: '.$criterio_4.'</p>
                        </div>
                        <div class="painel-btn">
                            <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                        </div>
                    </div>
                    
                    </div>
                        </div>
                        </li>
                        </ul>
                        </nav>';

                }else{
                    echo 'Falha ao selecionar os dados de correção';
                }
            }else if($universidade == 'fuvest'){   
                $sql_select_texto_redacao = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND id_red = $id_redacao";
                $sql_select_correcao_fuvest = "SELECT * FROM correcao_fuvest WHERE id_redacao = $id_redacao";

                $sql_select_texto_redacao_result = mysqli_query($conn, $sql_select_texto_redacao);
                $sql_select_correcao_fuvest_result = mysqli_query($conn, $sql_select_correcao_fuvest);

                if($sql_select_texto_redacao_result && $sql_select_correcao_fuvest_result){
                    //echo 'Dados de coreção selecionados com sucesso.';
                    while($row_texto_redacao = mysqli_fetch_array($sql_select_texto_redacao_result)){
                        $texto_redacao = $row_texto_redacao['redacao_alterada'];

                        echo '
                        <div class="painel">
                            <div class="painel_redacao">
                                <div class="logo_fuvest"></div>
                                <div class="dados_alunos">
                                    <label>Tema</label>
                                    <p>'.$row_texto_redacao['tema_redacao'].'</p>

                                    <label>Aluno</label>
                                    <p>'.$row_texto_redacao['nome_aluno'].'</p>
                                </div>
                                
                                <textarea class="textArea" name="redacao_alterada" id="redacao_alterada" cols="90" rows="40" style="resize: none; background-color: white; color: black; border: none;" disabled>'.$texto_redacao.'</textarea>
                            </div>
                    ';
                    }


                    echo '<div class="painel_comentario">
                        <!-- <div class="logo_plataforma"></div> -->
                        <nav class="nav_tabs">
                            <ul>
                                <li>
                                    <input type="radio" name="rd_btn" id="rd_comentarios" class="rd_tab" checked>
                                    <label for="rd_comentarios" class="tab_label">Comentários</label>
                                    <div class="tab-content">';

                    $criterio_1;
                    $criterio_2;
                    $criterio_3;
                    $notal_final;

                    while($row_fuvest = mysqli_fetch_array($sql_select_correcao_fuvest_result)){
                            $comentario_redacao = nl2br($row_fuvest['comentario']);
                            $row++;
                            $array_trechos[$row] = $row_fuvest['trecho_selecionado'];
                            $array_comentarios[$row] = $row_fuvest['comentario'];

                            $criterio_1 = $row_fuvest['criterio_a'];
                            $criterio_2 = $row_fuvest['criterio_b'];
                            $criterio_3 = $row_fuvest['criterio_c'];
                            $nota_final = $row_fuvest['nota_final'];

                            $texto_criterio_a;
                            $texto_criterio_b;
                            $texto_criterio_c;
                            $trechos_selecionados;
                            $comentarios_trechos_selecionados;
    
                            //trechos_selecionados
                            $trechos_selecionados = $row_fuvest['trecho_selecionado'];
                            /*echo $trechos_selecionados;
                            echo '<br>';*/
    
    
                            //comentarios_trechos_selecionados
                            $comentarios_trechos_selecionados = $row_fuvest['comentario'];
                            /*echo $comentarios_trechos_selecionados;
                            echo '<br>';*/
    
                            //critério a
                            if($row_fuvest['criterio_a'] == 0){
                                $texto_criterio_a = 'A redação não se configura como uma dissertação e nem atende minimamente ao tema proposto, há uma fuga total deste ou desconhecimento sobre as estruturas do texto dissertativo.';
                            }else if($row_fuvest['criterio_a'] == 1 ){
                                $texto_criterio_a = 'O texto atende minimante ao tema proposto, não se nota uma clara estrutura dissertativa, apesar de haver uma opinião expressa; não houve qualquer aproveitamento da coletânea ou houve uma leitura totalmente inadequada desta.';
                            }else if($row_fuvest['criterio_a'] == 2 ){
                                $texto_criterio_a = 'A redação apresenta uma resposta pouco articulada para o tema, apesar de estar correta; não se nota uma progressão temática e nem argumentativa, havendo uma circularidade das ideias, comprometendo o projeto de texto, que não traz um aproveitamento claro da coletânea.';
                            }else if($row_fuvest['criterio_a'] == 3){
                                $texto_criterio_a = 'A resposta para o tema está correta, assim como é correto o uso da coletânea, porém não há qualquer indício de autoria, não é aprofundada a opinião e nem reflexivo o uso dos textos que acompanham a proposta de redação.';
                            }else if($row_fuvest['criterio_a'] == 4){
                                $texto_criterio_a = 'A resposta para o tema e as estruturas da dissertação são boas, com indícios de autoria e uso reflexivo dos textos que acompanham a proposta de redação.';
                            }else if($row_fuvest['criterio_a'] == 5){
                                $texto_criterio_a = 'A reposta para o tema e as estruturas da dissertação são excelentes,  tem-se um perfeito aproveitamento da coletânea, com autoria plena do candidato sobre o assunto apresentado na proposta.';
                            }

                            //criterio b
                            if($row_fuvest['criterio_b'] == 0){
                                $texto_criterio_b = 'O texto é apenas uma relação de comentários desconectados, não se nota qualquer articulação entre as ideias, prejudicando gravemente a estrutura da dissertação e a compreensão do projeto de texto do candidato, que desconhece totalmente os recursos coesivos.';
                            }else if($row_fuvest['criterio_b'] == 1 ){
                                $texto_criterio_b = 'A articulação dos argumentos é ruim, há graves contradições entre as ideias, não há um indício de projeto de texto, e várias passagens estão confusas, afetando a progressão das ideias. O candidato mostra que não domina os recursos da coesão textual. ';
                            }else if($row_fuvest['criterio_b'] == 2 ){
                                $texto_criterio_b= 'A articulação dos argumentos é razoável,  há um indício de projeto texto, porém este não é totalmente claro; a tese aparece, mas os argumentos não são totalmente coerentes com esta; ou a conclusão não apresenta uma análise pertinente com a argumentação. Há um domínio razoável dos recursos coesivos. ';
                            }else if($row_fuvest['criterio_b'] == 3){
                                $texto_criterio_b = 'A argumentação e articulação das ideias no texto apresentam-se corretas, todavia há alguns deslizes que comprometem a coerência em algumas passagens, sem causar grandes prejuízos à leitura do corretor. O emprego dos recursos coesivos é correto, mas não chega a ser elaborado.';
                            }else if($row_fuvest['criterio_b'] == 4){
                                $texto_criterio_b = 'A articulação dos argumentos e das ideias na dissertação é boa, com mínimos deslizes e um domínio claro dos elementos que garantem a progressão argumentativa, sem qualquer prejuízo à leitura.';
                            }else if($row_fuvest['criterio_b'] == 5){
                                $texto_criterio_b = 'A articulação dos argumentos e das ideais na dissertação é excelente, não há qualquer deslize na coerência e na relação entre uma ideia e outra; além disso, há uma sofisticação dos recursos da norma culta que garantem a coesão, culminando em um projeto de texto muito bem sucedido.';
                            }

                            //echo 'Texto critério B: '.$texto_criterio_b.'<br>'.$row_fuvest['criterio_b'];

                            //criterio c
                            if($row_fuvest['criterio_c'] == 0){
                                $texto_criterio_c = 'A linguagem empregada não constitui (em nenhuma passagem do texto) o registro formal, havendo um total desconhecimento das regras gramaticais, uma expressão de que o candidato não foi alfabetizado plenamente ou não tem conhecimento da língua portuguesa, porque sua língua materna é outra.';
                            }else if($row_fuvest['criterio_c'] == 1 ){
                                $texto_criterio_c = 'Problemas graves com o emprego da norma culta, marcas de oralidade em todos os níveis da redação; erros crassos de ortografia, concordância, regência verbal, nominal, flexão verbal etc. O trabalho com a norma culta é muito ruim. ';
                            }else if($row_fuvest['criterio_c'] == 2 ){
                                $texto_criterio_c = 'O trabalho com a norma culta é razoável, o texto tem erros gramaticais e algumas marcas de oralidade, com um vocabulário redundante, que não expressa um total conhecimento do emprego dos recursos da norma culta.';
                            }else if($row_fuvest['criterio_c'] == 3){
                                $texto_criterio_c = 'O trabalho com a norma culta é correto; a escolha lexical e o uso dos elementos da norma culta são adequados, com alguns deslizes que não chegam a constituir o desconhecimento das regras gramaticais.';
                            }else if($row_fuvest['criterio_c'] == 4){
                                $texto_criterio_c = 'A escolha lexical é bem sucedida, com raros problemas de norma culta, há um bom conhecimento das regras gramaticais, porém não se tem ainda a sofisticação da sintaxe.';
                            }else if($row_fuvest['criterio_c'] == 5){
                                $texto_criterio_c = 'Sofisticação da sintaxe e um conhecimento muito bom das regras gramaticais. Admitem-se raros deslizes na norma culta, que não prejudiquem o sentido das ideias. A escolha do vocabulário é perfeita para o que se deseja expressar.';
                            }   

                            //colocando tuddo isso numa div bonitinha
                            echo '
                            <!-- PAINEL ONDE OS COMETÁRIOS FICARAM ARMAZENADOS -->
                                <div class="card-comentario" id="painel-comentario">
                                    <label>Trecho comentado</label>
                                    <div id="trecho_redacao">'.$trechos_selecionados.'</div>
                                    <label>Comentário ('.$row.')</label>
                                        <textarea name="texto_comentario" id="texto_comentario" disabled>'.$comentarios_trechos_selecionados.'</textarea>
                                </div>';
                        }

                    echo "</div></li>";
                    //var_dump($array_trechos);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    //var_dump($array_comentarios);
                    $string_trechos = implode("|", $array_trechos);

                    echo "<input type='hidden' value='$string_trechos' id='id_trechos'>";


                    echo '                    
                    <li>
                        <input type="radio" name="rd_btn" id="rd_criterios" class="rd_tab">
                        <label for="rd_criterios" class="tab_label">Critérios de Avaliação</label>
                        <div class="tab-content">
                            <div class="box-painel-criterios">
                                <div class="box-nota-total">
                                    <label>Nota total: </label>
                                    <p style="font-size: 30px;">'.$nota_final.'</p>
                                </div>
                                <div class="box-criterio box-criterio-1">
                                    <label>A. Proposta e Abordagem do Tema.</label>
                                    <p>'.$texto_criterio_a.'</p>
                                    <p>'.$criterio_1.'</p>
                                </div>
                                <div class="box-criterio box-criterio-2">
                                    <label>B. Gênero / Tipo de Texto e Coerência.</label>
                                    <p>'.$texto_criterio_b.'</p>
                                    <p>'.$criterio_2.'</p>
                                </div>
                                <div class="box-criterio box-criterio-3">
                                    <label>C. Elementos Linguísticos (Modalidade e Coesão).</label>
                                    <p>'.$texto_criterio_c.'</p>
                                    <p>'.$criterio_3.'</p>
                                </div>
                                <div class="painel-btn">
                                    <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </li>
                    </ul>
                    </nav>
                    ';
                }else{
                    echo 'Falha ao selecionar os dados de correção.';
                }
            }else if($universidade == 'vunesp'){
                $sql_select_texto_redacao = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND id_red= $id_redacao";
                $sql_select_correcao_vunesp = "SELECT *  FROM correcao_vunesp WHERE id_redacao = $id_redacao";

                $sql_select_texto_redacao_result = mysqli_query($conn, $sql_select_texto_redacao);
                $sql_select_correcao_vunesp_result = mysqli_query($conn, $sql_select_correcao_vunesp);

                if($sql_select_correcao_vunesp_result && $sql_select_texto_redacao_result){
                    //echo 'Dados de correção selecionado com sucesso.';
                    echo '<div class="box">';
                    while($row_vunesp_texto_red = mysqli_fetch_array($sql_select_texto_redacao_result)){
                        $texto_redacao = nl2br($row_vunesp_texto_red['redacao_alterada']);

                        echo '
                        <div class="painel">
                            <div class="painel_redacao">
                                <div class="logo_vunesp"></div>
                                <div class="dados_alunos">
                                    <label>Tema</label>
                                    <p>'.$row_vunesp_texto_red['tema_redacao'].'</p>

                                    <label>Aluno</label>
                                    <p>'.$row_vunesp_texto_red['nome_aluno'].'</p>
                                </div>
                                
                                <textarea class="textArea" name="redacao_alterada" id="redacao_alterada" cols="90" rows="40" style="resize: none; background-color: white; color: black; border: none;" disabled>'.$texto_redacao.'</textarea>
                            </div>';
                    }

                    echo '<div class="painel_comentario">
                    <!-- <div class="logo_plataforma"></div> -->
                    <h2>Comentários</h2>
                    <nav class="nav_tabs">
                            <ul>
                                <li>
                                    <input type="radio" name="rd_btn" id="rd_comentarios" class="rd_tab" checked>
                                    <label for="rd_comentarios" class="tab_label">Comentários</label>
                                    <div class="tab-content">';

                    $criterio_1;
                    $criterio_2;
                    $criterio_3;
                    $notal_final;

                    while($row_vunesp = mysqli_fetch_array($sql_select_correcao_vunesp_result)){
                        $comentario_redacao = nl2br($row_vunesp['comentario']);
                        $row++;
                        $array_trechos[$row] = $row_vunesp['trecho_selecionado'];
                        $array_comentarios[$row] = $row_vunesp['comentario'];

                        $criterio_1 = $row_vunesp['criterio_a'];
                        $criterio_2 = $row_vunesp['criterio_b'];
                        $criterio_3 = $row_vunesp['criterio_c'];
                        $nota_final = $row_vunesp['nota_final'];

                        $texto_criterio_a;
                        $texto_criterio_b;
                        $texto_criterio_c;
                        $trechos_selecionados;
                        $comentarios_trechos_selecionados;

                        //trechos_selecionados
                        $trechos_selecionados = $row_vunesp['trecho_selecionado'];
                        /*echo $trechos_selecionados;
                        echo '<br>';*/


                        //comentarios_trechos_selecionados
                        $comentarios_trechos_selecionados = $row_vunesp['comentario'];
                        /*echo $comentarios_trechos_selecionados;
                        echo '<br>';*/

                         //critério a
                         if($row_vunesp['criterio_a'] == 0){
                            $texto_criterio_a = 'O texto não  atende ao tema proposto, tem-se uma fuga total do assunto apresentado para o desenvolvimento da dissertação.';
                        }else if($row_vunesp['criterio_a'] == 1 ){
                            $texto_criterio_a = 'O texto atende minimamente ao tema proposto, não há progressão temática, não se nota aproveitamento da coletânea ou este é ruim, com interpretação equivocada do repertório que integra a coletânea.';
                        }else if($row_vunesp['criterio_a'] == 2 ){
                            $texto_criterio_a = 'A progressão do tema tem muitas falhas, há mera paráfrase da coletânea, apesar de haver uma opinião expressa, esta não se baseia totalmente no assunto apresentado pela proposta ou responde parcialmente a proposta.';
                        }else if($row_vunesp['criterio_a'] == 3){
                            $texto_criterio_a = 'O texto está correto, a análise já apresenta alguns aspectos críticos e com um bom aproveitamento da coletânea, porém há apenas indício de autoria, não se nota autoria plena.';
                        }else if($row_vunesp['criterio_a'] == 4){
                            $texto_criterio_a = 'A resposta atende de forma brilhante o tema, tem-se um excelente aproveitamento da coletânea, com autoria plena do candidato sobre o assunto apresentado na proposta.';
                        }

                        //criterio b
                        if($row_vunesp['criterio_b'] == 0){
                            $texto_criterio_b = 'O texto não se configura como uma dissertação, não há uma estrutura clara de tese, argumentos e conclusão. O zero também se aplica a dissertações que estejam estruturadas em argumentos preconceituosos e que ameacem os direitos humanos. ';
                        }else if($row_vunesp['criterio_b'] == 1 ){
                            $texto_criterio_b = 'A tese e argumentos não são claros, não há progressão argumentativa, o texto fica muito parecido com uma lista de comentários sobre o tema, ou apresenta contradições graves entre tese e argumentos. ';
                        }else if($row_vunesp['criterio_b'] == 2 ){
                            $texto_criterio_b = 'O texto está correto, há clareza da tese e argumentos, a análise já apresenta alguns aspectos críticos, porém há apenas indício de autoria, a argumentação não é irrefutável e não tem autoria plena. ';
                        }else if($row_vunesp['criterio_b'] == 3){
                            $texto_criterio_b = 'A articulação da tese e dos argumentos é bem feita, tem-se uma argumentação irrefutável, com um projeto de texto bem sucedido, constituindo a autoria plena do candidato.  ';
                        }

                        //criterio c
                        if($row_vunesp['criterio_c'] == 0){
                            $texto_criterio_c = 'A linguagem empregada não constitui (em nenhuma passagem do texto) o registro formal, havendo um total desconhecimento das regras gramaticais, uma expressão de que o candidato não foi alfabetizado plenamente ou não tem conhecimento da língua portuguesa, porque sua língua materna é outra. Não há qualquer indício de coesão, sendo as ideias um conjunto confuso que não permite identificar um único momento de clareza na redação. ';
                        }else if($row_vunesp['criterio_c'] == 1 ){
                            $texto_criterio_c = 'Problemas graves com o emprego da norma culta, marcas de oralidade em todos os níveis da redação e muitas quebras da sequência lógica dentro dos parágrafos e entre eles, além de empregos totalmente inadequados dos conectivos e recursos da norma culta que assegurem a coesão. ';
                        }else if($row_vunesp['criterio_c'] == 2 ){
                            $texto_criterio_c = 'Escolha lexical correta, uso adequado dos elementos da norma culta e da coesão, com alguns deslizes que não chegam a comprometer a articulação das ideias no texto. ';
                        }else if($row_vunesp['criterio_c'] == 3){
                            $texto_criterio_c = 'Sofisticação da sintaxe e dos elementos da norma culta e coesão. Admitem-se raros deslizes na norma culta e coesão, que não prejudiquem o sentido das ideias. A escolha do vocabulário é perfeita para o que se deseja expressar.  ';
                        }

                        //colocando tuddo isso numa div bonitinha
                        echo '
                        <!-- PAINEL ONDE OS COMETÁRIOS FICARAM ARMAZENADOS -->
                            <div class="card-comentario" id="painel-comentario">
                                <label>Trecho comentado</label>
                                <div id="trecho_redacao">'.$trechos_selecionados.'</div>
                                <label>Comentário ('.$row.')</label>
                                    <textarea name="texto_comentario" id="texto_comentario" disabled>'.$comentarios_trechos_selecionados.'</textarea>
                            </div>';
                    }

                    echo "</div></li>";
                    //var_dump($array_trechos);
                    //var_dump($array_comentarios);
                    $string_trechos = implode("|", $array_trechos);

                    echo "<input type='hidden' value='$string_trechos' id='id_trechos'>";

                    echo '
                    <li>
                        <input type="radio" name="rd_btn" id="rd_criterios" class="rd_tab">
                        <label for="rd_criterios" class="tab_label">Critérios de Avaliação</label>
                        <div class="tab-content">
                            <div class="box-painel-criterios">
                                <div class="box-nota-total">
                                    <label>Nota total: </label>
                                    <p style="font-size: 30px;">'.$nota_final.'</p>
                                </div>
                                <div class="box-criterio box-criterio-1">
                                    <label>A. Tipo de texto e abordagem do tema.</label>
                                    <p>'.$texto_criterio_a.'</p>
                                    <p>Nota: '.$criterio_1.'</p>
                                </div>
                                <div class="box-criterio box-criterio-2">
                                    <label>B. Estrutura</label>
                                    <p>'.$texto_criterio_b.'</p>
                                    <p>Nota: '.$criterio_2.'</p>
                                </div>
                                <div class="box-criterio box-criterio-3">
                                    <label>C. Expressão</label>
                                    <p>'.$texto_criterio_c.'</p>
                                    <p>Nota: '.$criterio_3.'</p>
                                </div>
                                <div class="painel-btn">
                                    <button><a href="./oldRed.php">Retornar para minhas redações</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </li>
                    </ul>
                    </nav>';
                }else{
                    echo 'Falha ao selecionar os dados de correção.';
                }
            }
        }
}
?>

<style type="text/css">
        div.painel{
            display:flex;
            flex-direction: row;

            background-color: #ffffff;
        }

        /*####################################################################################################################################################*/
        /*###########################################################  PAINEL_REDACAO  #######################################################################*/
        /*####################################################################################################################################################*/

        div.painel > div.painel_redacao{
            flex: 50%;
            padding: 20px;
        }

        div.painel > div.painel_redacao > textarea{
            width: 100%;
            font-size: 15px;
            resize: none;

            background-color: #ffffff;
            color: #000000;
            padding: 10px;
            border: 1px solid #f1f1f1;
        }

        div.painel > div.painel_redacao > div.dados_alunos > p, label{
            margin: 5px 0px;
            font-size: 18px
        }

         /*####################################################################################################################################################*/
        /*###########################################################  LOGOS #################################################################################*/
        /*####################################################################################################################################################*/

        div.painel > div.painel_redacao > div.logo_unicamp{
            width: 100%;
            height: 110px;
            background-image: url('./../../svg/logo_unicamp.svg');
            background-size: 110px 110px;
            background-position: center;
            background-repeat: no-repeat;
            margin-bottom: 20px;
            background-color: transparent;
        }

        div.painel > div.painel_redacao > div.logo_fuvest{
            width: 100%;
            height: 100px;
            background-image: url('./../../png/fuvest_logo_1.png');
            background-size: 250px 100px;
            background-position: center;
            background-repeat: no-repeat;
            margin-bottom: 20px;
        }

        div.painel > div.painel_redacao > div.logo_enem{
            width: 100%;
            height: 120px;
            background-image: url('./../../png/Enem_logo.png');
            background-size: 200px 120px;
            background-position: center;
            margin: 0px 60px;
            background-repeat: no-repeat;
            margin-bottom: 20px;
        }

        div.painel > div.painel_redacao > div.logo_vunesp{
            width: 100%;
            height: 120px;
            background-image: url('./../../svg/logo_unesp.svg');
            background-size: 200px 120px;
            background-position: center;
            background-color: transparent;
            background-repeat: no-repeat;
            margin-bottom: 20px;
        }

        div.painel > div.painel_comentario > div.logo_plataforma{
            width: 100%;
            height: 120px;
            background-color: transparent;
            background-image: url('./../../images/logo_center.png');
            background-position: center;
            background-size: 200px 120px;
            background-repeat: no-repeat;
            border:none;
        }


        /*####################################################################################################################################################*/
        /*###########################################################  PAINEL_COMENTARIO #####################################################################*/
        /*####################################################################################################################################################*/

        div.painel > div.painel_comentario{
            flex: 50%;
            padding: 10px;
        }

        div.painel > div.painel_comentario > nav ul li div.card-comentario{
            margin: 10px 0px;
            border: 1px solid #212121;
            display:flex;
            flex-direction: column;
            padding: 5px;
            border-radius: 5px;
        }

        div.painel > div.painel_comentario > nav ul li div.card-comentario > label{
            font-weight: bold;
            font-size: 15px;
            text-align:center;
            color: #212121;
            padding: 5px;
        }

        div.painel > div.painel_comentario > nav ul li div.card-comentario > div{
            padding: 10px;
            font-size: 15px;
        }

        div.painel > div.painel_comentario > nav ul li div.card-comentario > textarea{
            resize: none;
            border: #212121;
            border-radius: 3px;
            padding: 15px;
            font-size: 17px;

            background-color: #ffffff;
            color: #000000;
        }

        div.painel > div.painel_comentario > h2{
            text-align:center;
            margin: 20px;
        }

        .nav_tabs{
            width: 600px;
            height: 400px;
            background-color: transparent;
            position: relative;
        }

    .nav_tabs ul{
		list-style: none;
	}

	.nav_tabs ul li{
		float: left;
	}

    .tab_label{
		display: block;
		/*width: 100px;*/
		background-color: #363b48;
		padding: 25px;
		font-size: 20px;
		color:#fff;
		cursor: pointer;
		text-align: center;
	}

    .nav_tabs .rd_tab { 
        display:none;
        position: absolute;
    }   

    .nav_tabs .rd_tab:checked ~ label { 
        background-color: #E1289B;
        color:#fff;
    }

    .tab-content{
        background-color: #fff;
        display: none;
        position: absolute;
        width: 600px;
        left: 0;	
        padding: 10px;
    }

    .rd_tab:checked ~ .tab-content{
        display: block;
    }

    div.tab-content div{
        display: flex;
        flex-direction: column;
    }

        
</style>

<script type="text/javascript">
    var trechos = [];
    var comentario = [];

    var id_trechos = document.getElementById('id_trechos');
    trechos = id_trechos.value.split("|");

    $('.textArea').highlightWithinTextarea({
        highlight: trechos,
    });
</script>