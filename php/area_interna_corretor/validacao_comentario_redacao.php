<?php
    include './../connection.php';
    session_start();

    if(!isset($_SESSION['email_corretor']) && !isset($_SESSION['id_corretor']) && !isset($_SESSION['nome_corretor'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        if(isset($_POST['comentario_redacao']) && isset($_GET['id_redacao'])){
            $comentario_redacao = nl2br(mysqli_real_escape_string($conn, $_POST['comentario_redacao']));
            $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
            $universidade_redacao = strtolower(mysqli_real_escape_string($conn, $_GET['universidade_redacao']));
            $comentario_redacao_bd;

            //echo $comentario_redacao;
            //VERIFICAR SE EXISTE UM COMENTARIO PARA ESTA REDAÇÃO
            if(!empty($comentario_redacao)){
                if($universidade_redacao == 'enem'){
                    $sql_verifica_comentario_redacao_enem = "SELECT * FROM comentario_redacoes WHERE id_redacao = $id_redacao";
                    $sql_select_verifica_comentario_redacao_enem_result = mysqli_query($conn, $sql_verifica_comentario_redacao_enem);
                    if($sql_select_verifica_comentario_redacao_enem_result){
                        //verificando se a redação já possui algum comentário
                        $row = mysqli_num_rows($sql_select_verifica_comentario_redacao_enem_result);
                        if($row >= 1){
                            $sql_update_comentario_redacao = "UPDATE comentario_redacoes SET texto_comentario = '$comentario_redacao' WHERE id_redacao = $id_redacao";
                            $sql_update_comentario_redacao_result = mysqli_query($conn, $sql_update_comentario_redacao);
                            if($sql_update_comentario_redacao_result){
                                echo '
                                <div class="painel">
                                    <p>Comentário enviado com sucesso</p>
                                    <button><a href="./minhas_correcoes.php">Minhas Correções</a></button>
                                </div>';
                            }else{
                                echo 'Erro ao atualizar o comentário desta redação';
                            }
                        }else{
                            //verificando se o campo de comentário está vazio ou n
                            while($row_comentario_redacao = mysqli_fetch_array($sql_select_verifica_comentario_redacao_enem_result)){
                                $comentario_redacao_bd = $row_comentario_redacao['texto_comentario_redacao'];
                            }
        
                            if(empty($comentario_redacao_bd)){
                                //pode inserir o comentario na base de dados.
                                //echo 'Comentário: '.$comentario_redacao.'<br>Id redação: '.$id_redacao;
    
                                $sql_insert_comentario_redacao = "INSERT INTO comentario_redacoes(texto_comentario, id_redacao)VALUES('$comentario_redacao', $id_redacao)";
                                $sql_insert_comentario_redacao_result = mysqli_query($conn, $sql_insert_comentario_redacao);
                                if($sql_insert_comentario_redacao_result){
                                    echo '
                                        <div class="painel">
                                            <p>Comentário enviado com sucesso</p>
                                            <button><a href="./minhas_correcoes.php">Minhas Correções</a></button>
                                        </div>';
                                }else{
                                    echo 'Erro ao inserir comentário para esta redação na base de dados.';
                                }
                            }else{
                                //não pode inserir comentário na base de dados.
                                echo 'Essa redação já está comentada.';
                            }
                        }
                    }else{
                        echo 'Erro na query select comentário redação';
                    }
                }else if($universidade_redacao == 'unicamp'){
                    $sql_verifica_comentario_redacao_unicamp = "SELECT * FROM comentario_redacoes WHERE id_redacao = $id_redacao";
                    $sql_verifica_comentario_redacao_unicamp_result = mysqli_query($conn, $sql_verifica_comentario_redacao_unicamp);
                    if($sql_verifica_comentario_redacao_unicamp_result){
                        //verificando se a redação já possui algum comentário
                        $row = mysqli_num_rows($sql_verifica_comentario_redacao_unicamp_result);
                        if($row >= 1){
                            $sql_update_comentario_redacao = "UPDATE comentario_redacoes SET texto_comentario = '$comentario_redacao' WHERE id_redacao = $id_redacao";
                            $sql_update_comentario_redacao_result = mysqli_query($conn, $sql_update_comentario_redacao);
                            if($sql_update_comentario_redacao_result){
                                echo '
                                <div class="painel">
                                    <p>Comentário enviado com sucesso</p>
                                    <button><a href="./minhas_correcoes.php">Minhas Correções</a></button>
                                </div>';
                            }else{
                                echo 'Erro ao atualizar o comentário desta redação';
                            }
                        }else{
                            //verificando se o campo de comentário está vazio ou n
                            while($row_comentario_redacao = mysqli_fetch_array($sql_verifica_comentario_redacao_unicamp_result)){
                                $comentario_redacao_bd = $row_comentario_redacao['texto_comentario_redacao'];
                            }
        
                            if(empty($comentario_redacao_bd)){
                                //pode inserir o comentario na base de dados.
                                //echo 'Comentário: '.$comentario_redacao.'<br>Id redação: '.$id_redacao;
    
                                $sql_insert_comentario_redacao = "INSERT INTO comentario_redacoes(texto_comentario, id_redacao)VALUES('$comentario_redacao', $id_redacao)";
                                $sql_insert_comentario_redacao_result = mysqli_query($conn, $sql_insert_comentario_redacao);
                                if($sql_insert_comentario_redacao_result){
                                    echo '
                                        <div class="painel">
                                            <p>Comentário enviado com sucesso</p>
                                            <button><a href="./minhas_correcoes.php">Minhas Correções</a></button>
                                        </div>';
                                }else{
                                    echo 'Erro ao inserir comentário para esta redação na base de dados.';
                                }
                            }else{
                                //não pode inserir comentário na base de dados.
                                echo 'Essa redação já está comentada.';
                            }
                        }
                    }
                }else if($universidade_redacao == 'fuvest'){
                    $sql_verifica_comentario_redacao_fuvest = "SELECT * FROM comentario_redacoes WHERE id_redacao = $id_redacao";
                    $sql_verifica_comentario_redacao_fuvest_result = mysqli_query($conn, $sql_verifica_comentario_redacao_fuvest);
                    if($sql_verifica_comentario_redacao_fuvest_result){
                        //verificando se a redação já possui algum comentário
                        $row = mysqli_num_rows($sql_verifica_comentario_redacao_fuvest_result);
                        if($row >= 1){
                            $sql_update_comentario_redacao = "UPDATE comentario_redacoes SET texto_comentario = '$comentario_redacao' WHERE id_redacao = $id_redacao";
                            $sql_update_comentario_redacao_result = mysqli_query($conn, $sql_update_comentario_redacao);
                            if($sql_update_comentario_redacao_result){
                                echo '
                                <div class="painel">
                                    <p>Comentário enviado com sucesso</p>
                                    <button><a href="./minhas_correcoes.php">Minhas Correções</a></button>
                                </div>';
                            }else{
                                echo 'Erro ao atualizar o comentário desta redação';
                            }
                        }else{
                            //verificando se o campo de comentário está vazio ou n
                            while($row_comentario_redacao = mysqli_fetch_array($sql_verifica_comentario_redacao_fuvest_result)){
                                $comentario_redacao_bd = $row_comentario_redacao['texto_comentario_redacao'];
                            }
        
                            if(empty($comentario_redacao_bd)){
                                //pode inserir o comentario na base de dados.
                                //echo 'Comentário: '.$comentario_redacao.'<br>Id redação: '.$id_redacao;
    
                                $sql_insert_comentario_redacao = "INSERT INTO comentario_redacoes(texto_comentario, id_redacao)VALUES('$comentario_redacao', $id_redacao)";
                                $sql_insert_comentario_redacao_result = mysqli_query($conn, $sql_insert_comentario_redacao);
                                if($sql_insert_comentario_redacao_result){
                                    echo '
                                        <div class="painel">
                                            <p>Comentário enviado com sucesso</p>
                                            <button><a href="./minhas_correcoes.php">Minhas Correções</a></button>
                                        </div>';
                                }else{
                                    echo 'Erro ao inserir comentário para esta redação na base de dados.';
                                }
                            }else{
                                //não pode inserir comentário na base de dados.
                                echo 'Essa redação já está comentada.';
                            }
                        }
                    }
                }else if($universidade_redacao == 'vunesp'){
                    $sql_verifica_comentario_redacao_vunesp = "SELECT * FROM comentario_redacoes WHERE id_redacao = $id_redacao";
                    $sql_verifica_comentario_redacao_vunesp_result = mysqli_query($conn, $sql_verifica_comentario_redacao_vunesp);
                    if($sql_verifica_comentario_redacao_vunesp_result){
                        //verificando se a redação já possui algum comentário
                        $row = mysqli_num_rows($sql_verifica_comentario_redacao_vunesp_result);
                        
                        if($row >= 1){
                            $sql_update_comentario_redacao = "UPDATE comentario_redacoes SET texto_comentario = '$comentario_redacao' WHERE id_redacao = $id_redacao";
                            $sql_update_comentario_redacao_result = mysqli_query($conn, $sql_update_comentario_redacao);
                            if($sql_update_comentario_redacao_result){
                                echo '
                                <div class="painel">
                                    <p>Comentário enviado com sucesso</p>
                                    <button><a href="./minhas_correcoes.php">Minhas Correções</a></button>
                                </div>';
                            }else{
                                echo 'Erro ao atualizar o comentário desta redação';
                            }
                        }else{
                            //verificando se o campo de comentário está vazio ou n
                            while($row_comentario_redacao = mysqli_fetch_array($sql_verifica_comentario_redacao_vunesp_result)){
                                $comentario_redacao_bd = $row_comentario_redacao['texto_comentario_redacao'];
                            }
        
                            if(empty($comentario_redacao_bd)){
                                //pode inserir o comentario na base de dados.
                                //echo 'Comentário: '.$comentario_redacao.'<br>Id redação: '.$id_redacao;
    
                                $sql_insert_comentario_redacao = "INSERT INTO comentario_redacoes(texto_comentario, id_redacao)VALUES('$comentario_redacao', $id_redacao)";
                                $sql_insert_comentario_redacao_result = mysqli_query($conn, $sql_insert_comentario_redacao);
                                if($sql_insert_comentario_redacao_result){
                                    echo '
                                        <div class="painel">
                                            <p>Comentário enviado com sucesso</p>
                                            <button><a href="./minhas_correcoes.php">Minhas Correções</a></button>
                                        </div>';
                                }else{
                                    echo 'Erro ao inserir comentário para esta redação na base de dados.';
                                }
                            }else{
                                //não pode inserir comentário na base de dados.
                                echo 'Essa redação já está comentada.';
                            }
                        }
                    }
                }
            }else{
                echo '
                <div class="painel">
                    <p>Nenhum comentário para ser enviado.</p>
                    <button><a href="./minhas_correcoes.php">Ir para minhas redações</a></button>
                </div>';
            }

        }else{
            echo 'Campo de comentário está vazio.';
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
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        width: 100vw;
        height: 100vh;
    }

    div.painel > p{
        margin: 10px;
        font-weight: bold;
        font-size: 30px;
    }

    div.painel > button{
        width: 200px;
        border:none;
        border-radius: 3px;
        background-color: #379c69;
        padding: 10px;
    }

    div.painel > button:hover{
        cursor: pointer;
        opacity: 0.9;
    }

    div.painel > button > a{
        text-decoration: none;
        color: #ffffff;
    }
</style>