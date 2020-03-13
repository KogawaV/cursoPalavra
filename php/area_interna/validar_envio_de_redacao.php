<?php
    /*********** STATUS DA CORREÇÃO DAS REDAÇÕES ***********/
    /*
        1 - corrigida
        2 - sendo corrigida
        0 - não corrigida
    */

    function retiraAcentos($string){
        $acentos  =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ:?\/*|<>';
        $sem_acentos  =  'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------';
        $string = strtr($string, utf8_decode($acentos), $sem_acentos);
        $string = str_replace(" ","-",$string);
        return utf8_decode($string);
    }

    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../connection.php';

        if(isset($_FILES['redacao_file']) && isset($_POST['temas_redacoes']) && isset($_POST['universidade_redacao'])){
            date_default_timezone_set('Brazil/East');//Definido horario padrão do fusu horário
    
            $universidade_redacao = $_POST['universidade_redacao'];
            $tema_da_redacao = $_POST['temas_redacoes'];
            $tema_sem_acento   =   retiraAcentos(utf8_decode($tema_da_redacao));
            

            //echo 'Universidade redação: '.$universidade_redacao.'<br>Tema sem acento: '.$tema_sem_acento.'<br>Tema com acento: '.$tema_da_redacao;

            //echo 'Tema:'.$tema_sem_acento.'<br>Universidade:'.$universidade_redacao.'<br>Modelo:'.$modelo_redacao.'<br>';
            
            $qtd_redacao_enviada = 0;
            $limite_envio_red = 0;
            $id_redacao = 0;
            //echo $tema_da_redacao;
            //echo '<br>'.$tipo_redacao;

            //capturando a quantidade de redações enviadas pelo aluno e verificando se está dentro do limite do plano
            $sql_select_qtd_red_env = "SELECT * FROM redacoes_enviadas WHERE id_aluno_redacao = '{$_SESSION['id_aluno']}'";
            $sql_select_qtd_red_env_result = mysqli_query($conn, $sql_select_qtd_red_env);

            //capturando número de redações  escritas enviadas para o sistema deste aluno
            $sql_select_qtd_red_escrita_env = "SELECT * FROM redacoes_escritas WHERE id_aluno_redacao = '{$_SESSION['id_aluno']}'";
            $sql_select_qtd_red_escrita_env_result = mysqli_query($conn, $sql_select_qtd_red_escrita_env);

            $sql_select_limite_envios = "SELECT * FROM aluno WHERE id_aluno = '{$_SESSION['id_aluno']}'";
            $sql_select_limite_envios_result = mysqli_query($conn, $sql_select_limite_envios);

            if($sql_select_qtd_red_env_result && $sql_select_limite_envios_result && $sql_select_qtd_red_escrita_env_result){
                while($row_qtd_redacao = mysqli_fetch_array($sql_select_qtd_red_env_result)){
                    //$qtd_redacao_enviada = $row_qtd_redacao['numero_redacoes_enviadas'];
                    $id_redacao = $row_qtd_redacao['id_red'];
                }

                while($row_limite_redacao = mysqli_fetch_array($sql_select_limite_envios_result)){
                    $limite_envio_red = $row_limite_redacao['limite_redacoes'];
                }

                $qtd_red_env = mysqli_num_rows($sql_select_qtd_red_env_result);
                $qtd_red_escrita_env = mysqli_num_rows($sql_select_qtd_red_escrita_env_result);
                $qtd_redacao_enviada = $qtd_red_env + $qtd_red_escrita_env;
                //echo 'Tema:'.$tema_sem_acento.'<br>Universidade:'.$universidade_redacao.'<br>Modelo:'.$modelo_redacao.'<br>';

                //echo $qtd_redacao_enviada;
                //echo '<br>'.$limite_envio_red;
                 if($qtd_redacao_enviada >= $limite_envio_red){
                    //echo 'Você já enviou o número de redações limites.';
                    header('Location: ./../../html/aviso_limite_redacoes.html');
                 }else{
                     $sql_select_id_red = "SELECT id_red FROM redacoes_enviadas";
                     $sql_id_red_result = mysqli_query($conn, $sql_select_id_red);
                     if($sql_id_red_result){
                         while($row_id_red = mysqli_fetch_array($sql_id_red_result)){
                            $id_redacao = $row_id_red['id_red'];
                         }
                        //echo $id_redacao;
                        if($id_redacao == null){
                            $id_redacao = 1;
                        }else{
                            $id_redacao += 1;
                        }
                        //echo $id_redacao;
                    }else{
                        echo 'Erro ao selecionar id da redação na base de dados.';
                    }

                    //array com as extensões permitidas
                    $_UP['extensoes_permitidas'] = array('.jpeg', '.jpg', '.pdf');
                    $extensao_arquivo = strtolower(substr($_FILES['redacao_file']['name'], -4)); //pegando a extensão do arquivo

                    if(array_search($extensao_arquivo, $_UP['extensoes_permitidas']) == false){
                        echo '  <div class="painel">
                                    <label>O arquivo da redação tem que estar em um destes formatos: PDF ou JPG/JPEG</label>
                                    <button><a href="./envRed.php">Enviar minha redação</button>
                                </div>';
                    }else{
                        $new_name = 'idred'.$id_redacao.'_aluno'.$_SESSION['id_aluno'].'_'.$universidade_redacao.'_'.strtolower(utf8_decode($tema_sem_acento)).$extensao_arquivo;
                        $diretorio_arquivo = 'Redacoes_enviadas/';//diretorio para onde o arquivo será enviado
    
                        echo 'Nome final do arquivo: '.$new_name;
                        
                        $new_qtd = $qtd_redacao_enviada + 1;
                        $sql_insert_redacao_bd = "INSERT INTO redacoes_enviadas(nome_aluno, caminho_redacao, universidade_redacao, tema_redacao, tema_sem_acento,  nome_corretor, id_corretor, id_aluno_redacao, status_corrigida, numero_redacoes_enviadas, tipo_redacao)VALUES('{$_SESSION['nome_aluno']}', '$diretorio_arquivo$new_name', '$universidade_redacao', '$tema_da_redacao', '$tema_sem_acento', 'aguardando' , 0, '{$_SESSION['id_aluno']}', 0, $new_qtd, 1)";
                        $sql_insert_redacao_bd_result = mysqli_query($conn, $sql_insert_redacao_bd);
                        if($sql_insert_redacao_bd_result){
                            echo 'Redação enviada com sucesso.';
                            move_uploaded_file($_FILES['redacao_file']['tmp_name'], $diretorio_arquivo.$new_name);//Está função realiza o upload do arquivo para o diretório escolhido
                            header('Location: ./oldRed.php');
                        }else{
                            echo 'Falha ao enviar redação.';
                            header('Location: ./envRed.php');
                        }
                    }
                 }
            }else{
                echo 'Erro ao selecionar a quantidade de redações enviadas pelo aluno.';
            }
        }else{
            echo 'Selecione todos os campos corretamente.';
            //header('Location: ./envRed.php');
        }
    }
?>

<style type="text/css">
    *{
        margin: 0px;
        padding: 0px;
    }

    html, body{
        font-family: Arial;
    }

    div.painel{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
    }

    div.painel > label{
        font-weight: bold;
        font-size: 27px;
    }

    div.painel > button{
        border: none;
        border-radius: 3px;
        padding: 10px;
        width: 300px;
        margin: 20px;
        background-color: #379c69;
        transition-duration: 0.4s;
    }

    div.painel > button:hover{
        opacity: 0.9;
        cursor: pointer;
    }

    div.painel > button > a{
        text-decoration: none;
        font-size: 17px;
        color: #ffffff;
    }
</style>