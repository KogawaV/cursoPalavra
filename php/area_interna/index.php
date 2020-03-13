<?php
    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../connection.php';

        $qtd_red_enem = 0;
        $qtd_red_fuvest = 0;
        $qtd_red_unicamp= 0;
        $qtd_red_vunesp = 0;
        $qtd_red_total = 0;


        $sql_select_qtd_redacoes_enem = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND universidade_redacao = 'Enem'";
        $sql_select_qtd_redacoes_enem_result = mysqli_query($conn, $sql_select_qtd_redacoes_enem);
        if($sql_select_qtd_redacoes_enem_result){
            $qtd_red_enem = mysqli_num_rows($sql_select_qtd_redacoes_enem_result);
        }else{
            echo 'Erro ao selecionar os dados.';
        }

        $sql_select_qtd_redacoes_fuvest = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND universidade_redacao = 'Fuvest'";
        $sql_select_qtd_redacoes_fuvest_result = mysqli_query($conn, $sql_select_qtd_redacoes_fuvest);
        if($sql_select_qtd_redacoes_fuvest_result){
            $qtd_red_fuvest = mysqli_num_rows($sql_select_qtd_redacoes_fuvest_result);
        }else{
            echo 'Erro ao selecionar os dados.';
        }


        $sql_select_qtd_redacoes_unicamp = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND universidade_redacao = 'Unicamp'";
        $sql_select_qtd_redacoes_unicamp_result = mysqli_query($conn, $sql_select_qtd_redacoes_unicamp);
        if($sql_select_qtd_redacoes_unicamp_result){
            $qtd_red_unicamp = mysqli_num_rows($sql_select_qtd_redacoes_unicamp_result);
        }else{
            echo 'Erro ao selecionar os dados.';
        }

        $sql_select_qtd_redacoes_vunesp = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = {$_SESSION['id_aluno']} AND universidade_redacao = 'Vunesp'";
        $sql_select_qtd_redacoes_vunesp_result = mysqli_query($conn, $sql_select_qtd_redacoes_vunesp);
        if($sql_select_qtd_redacoes_vunesp_result){
            $qtd_red_vunesp = mysqli_num_rows($sql_select_qtd_redacoes_vunesp_result);
        }else{
            echo 'Erro ao selecionar os dados.';
        }

        $qtd_red_total = ($qtd_red_enem + $qtd_red_fuvest + $qtd_red_unicamp + $qtd_red_vunesp);

        echo "<input type='hidden' value='$qtd_red_enem' id='qtd_red_enem'>";
        echo "<input type='hidden' value='$qtd_red_vunesp' id='qtd_red_vunesp'>";
        echo "<input type='hidden' value='$qtd_red_unicamp' id='qtd_red_unicamp'>";
        echo "<input type='hidden' value='$qtd_red_fuvest' id='qtd_red_fuvest'>";

        //variaveis para popular os gráficos
        $sql_select_nota_enem = "SELECT * FROM dados_graficos WHERE universidade = 'Enem' AND id_aluno = '{$_SESSION['id_aluno']}'";
        $sql_select_nota_enem_result = mysqli_query($conn, $sql_select_nota_enem);
        $array_notas_enem = array();
        
        if($sql_select_nota_enem_result){
            $row_enem = mysqli_num_rows($sql_select_nota_enem_result);
            //echo $row_enem;
            while($row = mysqli_fetch_array($sql_select_nota_enem_result)){
                $array_notas_enem[] = $row['nota_total']; 
                //echo $row['nota_total'];
            }

            //var_dump($array_notas_enem);
        }else{
            echo 'Falha ao selecionar dados Enem.';
        }


        $sql_select_nota_unicamp = "SELECT * FROM dados_graficos WHERE universidade = 'Unicamp' AND id_aluno = '{$_SESSION['id_aluno']}'";
        $sql_select_nota_unicamp_result = mysqli_query($conn, $sql_select_nota_unicamp);
        $array_notas_unicamp = array();
        $meses = array();

        if($sql_select_nota_unicamp_result){
            $row_unicamp = mysqli_num_rows($sql_select_nota_unicamp_result);
            while($row = mysqli_fetch_array($sql_select_nota_unicamp_result)){
                $array_notas_unicamp[] = $row['nota_total'];
                $meses[] = $row['mes_envio'];
            }
            //var_dump($array_notas_unicamp);
            //var_dump($meses);
        }else{
            echo 'Falha ao selecionar os dados Unicamp.';
        }


        $sql_select_nota_fuvest = "SELECT * FROM dados_graficos WHERE universidade = 'Fuvest' AND id_aluno = '{$_SESSION['id_aluno']}'";
        $sql_select_nota_fuvest_result = mysqli_query($conn, $sql_select_nota_fuvest);
        $array_notas_fuvest = array();

        if($sql_select_nota_fuvest_result){
            $row_fuvest = mysqli_num_rows($sql_select_nota_fuvest_result);
            while($row = mysqli_fetch_array($sql_select_nota_fuvest_result)){
                $array_notas_fuvest[] = $row['nota_total'];
            }
            //var_dump($array_notas_fuvest);
        }else{
            echo 'Falha ao selecionar os dados Fuvest.';
        }

        $sql_select_nota_vunesp = "SELECT * FROM dados_graficos WHERE universidade = 'Vunesp' AND id_aluno = '{$_SESSION['id_aluno']}'";
        $sql_select_nota_vunesp_result = mysqli_query($conn, $sql_select_nota_vunesp);
        $array_notas_vunesp = array();

        if($sql_select_nota_vunesp_result){
            $row_vunesp = mysqli_num_rows($sql_select_nota_vunesp_result);
            while($row = mysqli_fetch_array($sql_select_nota_vunesp_result)){
                $array_notas_vunesp[] = $row['nota_total'];
            }
            //var_dump($array_notas_vunesp);
        }else{
            echo 'Falha ao selecionar os dados Vunesp.';
        }

    }
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
        <link href="./../../css/area_interna_style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="./../../images/favicon.ico">

        <!-- FONTE DAS CATEGORIAS -->
        <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">

        <!-------------------------------------------------------------------------------------->
        <!------------------------------------ GRÁFICO UNICAMP --------------------------------->
        <!-------------------------------------------------------------------------------------->

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script type="text/javascript">
            /*var grafico_unicamp = document.getElementById('curve_chart_unicamp');
            var warning_unicamp = document.getElementById('warning_unicamp');
            var qtd_red_unicamp = document.getElementById('qtd_red_unicamp').value;*/

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Redações', 'Sua Nota'],
                <?php
                    for($i = 0; $i < count($array_notas_unicamp); $i++){

                ?>
                ['<?php echo 'Red '.$i; ?>', <?php echo intval($array_notas_unicamp[$i]); ?>],
                <?php } ?>
                ]);

                var options = {
                    title: 'Notas nas Redações da UNICAMP',
                    curveType: 'function',
                    legend: { position: 'bottom' },
                    pointSize: 20,
                    fontSize: 18,
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart_unicamp'));

                chart.draw(data, options);
            }
            
        </script>

        <!-------------------------------------------------------------------------------------->
        <!------------------------------------ GRÁFICO FUVEST ---------------------------------->
        <!-------------------------------------------------------------------------------------->
        
        <script type="text/javascript">
            /*var div_warning_fuvest = document.getElementById('warning_fuvest');
            div_warning_fuvest.style.display = "none";

            var grafico_fuvest = document.getElementById('curve_chart_fuvest');
            var warning_fuvest = document.getElementById('warning_fuvest');
            var qtd_red_fuvest = document.getElementById('qtd_red_fuvest').value;*/

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Redações', 'Sua Nota'],
                <?php
                    for($i = 0; $i < count($array_notas_fuvest); $i++){

                ?>
                ['<?php echo 'Red '.$i; ?>', <?php echo intval($array_notas_fuvest[$i]); ?>],
                <?php } ?>
                ]);

                var options = {
                    title: 'Notas nas Redações da FUVEST',
                    curveType: 'function',
                    legend: { position: 'bottom' },
                    pointSize: 20,
                    fontSize: 18,
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart_fuvest'));

                chart.draw(data, options);
            }
            
        </script>

        <!-------------------------------------------------------------------------------------->
        <!------------------------------------ GRÁFICO ENEM ------------------------------------>
        <!-------------------------------------------------------------------------------------->
        
        <script type="text/javascript">
            /*var div_warning_enem = document.getElementById('warning_enem');
            div_warning_enem.style.display = "none";

            var grafico_enem = document.getElementById('curve_chart_enem');
            var warning_enem = document.getElementById('warning_enem');
            var qtd_red_enem = document.getElementById('qtd_red_enem').value;*/

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Redações', 'Sua Nota'],
                <?php
                    for($i = 0; $i < count($array_notas_enem); $i++){

                ?>
                ['<?php echo 'Red '.$i; ?>', <?php echo intval($array_notas_enem[$i]); ?>],
                <?php } ?>
                ]);

                var options = {
                    title: 'Notas nas Redações da ENEM',
                    curveType: 'function',
                    legend: { position: 'bottom' },
                    pointSize: 20,
                    fontSize: 18,
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart_enem'));

                chart.draw(data, options);
            }
            
        </script>

        <!-------------------------------------------------------------------------------------->
        <!------------------------------------ GRÁFICO UNESP ----------------------------------->
        <!-------------------------------------------------------------------------------------->

        <script type="text/javascript">
            /*var div_warning_vunesp = document.getElementById('warning_vunesp');
            div_warning_vunesp.style.display = "none";

            var grafico_vunesp = document.getElementById('curve_chart_vunesp');
            var warning_vunesp = document.getElementById('warning_vunesp');
            var qtd_red_vunesp = document.getElementById('qtd_red_vunesp').value;*/

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Redações', 'Sua Nota'],
                <?php
                    for($i = 0; $i < count($array_notas_vunesp); $i++){

                ?>
                ['<?php echo 'Red '.$i; ?>', <?php echo intval($array_notas_vunesp[$i]); ?>],
                <?php } ?>
                ]);

                var options = {
                    title: 'Notas nas Redações da UNESP',   
                    curveType: 'function',
                    legend: { position: 'bottom' },
                    pointSize: 20,
                    fontSize: 18,
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart_vunesp'));

                chart.draw(data, options);
            }
            
        </script>

        <style>
            div.painel-dados-aluno{
                background-color: transparent;
                display: flex;
                flex-direction: column;
                background-color: transparent;
            }

            div.painel-dados-aluno > h3{
                text-align: center;
                padding: 10px;
            }

            div.painel-dados-aluno > div.painel-notas-categoria{
                display: flex;
                flex-direction: row;
                background-color: transparent;
                justify-content: space-around;
                border-radius: 3px;
                margin: 0px 20px;
            }

            div.painel-dados-aluno > div.painel-notas-categoria > div.categoria{
                margin: 0px 10px;
            }

            div.painel-dados-aluno > div.painel-notas-categoria > div.categoria > div{
                font-family: 'Monoton', cursive;
                font-size: 45px;
                text-align: center;
                padding: 10px;
            }

            div.painel-dados-aluno > div.painel-notas-categoria > div.categoria > div.lbl-categoria{
                background-color: transparent;
                display: flex;
                justify-content:center;
                align-items: center;
                font-weight: bold;
            }

            div.painel-grafico-notas{
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: space-around;
            }

            div.painel-grafico-notas > div{
                padding: 0px;
                width: 800px;
                height: 400px;
                margin-top: 30px;
            }

            div.warning{
                background-color: red;
                display:none;
                justify-content: center;
                align-items: center;
            }

            div.warning > p{
                font-size: 25px;
                color: #212121;
                font-weight: bold;
            }


        </style>

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
                <a href="./index.php" class="active">
                    <i class="fas fa-home iSidenav"></i>
                    <span class="sidenavTxt">Home</span>
                </a>
                <a href="./profile.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Perfil</span>
                </a>
                <a href="./temas.php" class="">
                    <i class="fas fa-user iSidenav"></i>
                    <span class="sidenavTxt">Temas</span>
                </a>
                <!-- <a href="./novaRed.php" class="">
                    <i class="fas fa-file-medical iSidenav"></i>
                    <span class="sidenavTxt">Nova Redação</span>
                </a>
                <a href="./envRed.php" class="">
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
                    <i class="fas fa-comment-dots red iSHortcut"></i>
                </a>
                <a href="#">
                    <i class="fas fa-plus red iSHortcut bigger"></i>
                </a>
                <a href="#">
                    <i class="fas fa-cog red iSHortcut"></i>
                </a>
            </div>-->
        </div>
        
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


            <div class="painel-dados-aluno">
                <h3>Redações enviadas em cada categoria</h3>
                <div class="painel-notas-categoria">

                    <!----------------------------------------------------------->
                    <!------------------------ ENEM ----------------------------->
                    <!----------------------------------------------------------->
                    <div class="categoria">
                        <div class="logo-enem">ENEM</div>
                        <div class="lbl-categoria">
                            <label><?php echo $qtd_red_enem; ?></label>
                        </div>
                    </div>

                    <!----------------------------------------------------------->
                    <!------------------------ FUVEST --------------------------->
                    <!----------------------------------------------------------->
                    <div class="categoria">
                        <div class="logo-fuvest">FUVEST</div>
                        <div class="lbl-categoria">
                            <label><?php echo $qtd_red_fuvest; ?></label>
                        </div>
                    </div>

                    <!-------------------------------------------------------------->
                    <!------------------------ UNICAMP ----------------------------->
                    <!-------------------------------------------------------------->
                    <div class="categoria">
                        <div class="logo-unicamp">UNICAMP</div>
                        <div class="lbl-categoria">
                            <label><?php echo $qtd_red_unicamp; ?></label>
                        </div>
                    </div>

                    <!------------------------------------------------------------->
                    <!------------------------ VUNESP ----------------------------->
                    <!------------------------------------------------------------->
                    <div class="categoria">
                        <div class="logo-vunesp">UNESP</div>
                        <div class="lbl-categoria">
                            <label><?php echo $qtd_red_vunesp; ?></label>
                        </div>
                    </div>
                </div>

                <div class="painel-grafico-notas">
                    <div id="curve_chart_unicamp"></div>
                     <!-- <div class="warning" id="warning_unicamp">
                        <p id='warning_unicamp'>Nenhum redação desta categoria foi enviada ainda</p>
                    </div> -->
                    
                    <div id="curve_chart_fuvest"></div>
                    <!-- <div class="warning" id="warning_fuvest">
                        <p id='warning_fuvest'>Nenhum redação desta categoria foi enviada ainda</p>
                    </div> -->

                    <div id="curve_chart_enem"></div>
                    <!--<div class="warning" id="warning_enem">
                        <p id='warning_enem'>Nenhum redação desta categoria foi enviada ainda</p>
                    </div> -->

                    <div id="curve_chart_vunesp"></div>
                    <!-- <div class="warning" id="warning_vunesp">
                        <p id='warning_vunesp'>Nenhum redação desta categoria foi enviada ainda</p>
                    </div> -->

                </div>
            </div>
        </div>
    </body>
</html>
