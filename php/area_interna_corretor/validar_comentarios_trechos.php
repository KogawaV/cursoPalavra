<?php
    include './../connection.php';

    $array_entrada = array('separador_explode');
    $array_saida = array('');

    $trechos = $_GET['trechos'];
    $comentarios = $_GET['comentarios'];
    $enviado = false;
    //echo $trechos;
    $trechos_arr = array_filter(explode("separador_explode,", $trechos));
    $comentarios_arr = array_filter(explode("separador_explode,", $comentarios));

    for($i = 0; $i < count($trechos_arr); $i++){
        $trechos_arr[$i] = str_replace($array_entrada, $array_saida, $trechos_arr[$i]);
        $comentarios_arr[$i] = str_replace($array_entrada, $array_saida, $comentarios_arr[$i]);
    }

    $id_aluno = mysqli_real_escape_string($conn, $_GET['id_aluno']);
    $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
    $modelo_redacao = mysqli_real_escape_string($conn, $_GET['modelo_redacao']); 
    $tipo_redacao = 2;   
    //$tipo_redacao = mysqli_real_escape_string($conn, $_GET['tipo_redacao']);
    $redacao_alterada = mysqli_real_escape_string($conn, $_GET['redacao_alterada']);
    
    echo $id_redacao;
    echo $modelo_redacao;
    echo $id_aluno;
    //echo $tipo_redacao;

    //var_dump($trechos_arr);
    /*echo 'Array com caracteres especiais: ';
    var_dump($comentarios_arr);
    echo '<br>Array sem caracteres especiais: ';
    var_dump($array_comentario_sem_char_especial);
    echo '<br>Array trechos: ';
    print_r($trechos_arr);*/

    for($i = 0; $i < count($trechos_arr); $i++){
       echo 'Comentário ('.($i+1).'): '.$comentarios_arr[$i].'<br>Trecho Selecionado('.($i+1).'): '.$trechos_arr[$i].'<br><br>';
    }
    
    if($modelo_redacao == 'Enem'){
        echo 'entrou';
        $n1 = mysqli_real_escape_string($conn, $_GET['n1']);
        $n2 = mysqli_real_escape_string($conn, $_GET['n2']);
        $n3 = mysqli_real_escape_string($conn, $_GET['n3']);
        $n4 = mysqli_real_escape_string($conn, $_GET['n4']);
        $n5 = mysqli_real_escape_string($conn, $_GET['n5']);
        $nota_total = mysqli_real_escape_string($conn, $_GET['nota_total']);

        echo '<br>'.$n1.'<br>'.$n2.'<br>'.$n3.'<br>'.$n4.'<br>'.$n5.'<br>'.$nota_total;

        for($i = 0; $i < count($trechos_arr); $i++){
            $sql_insert = "INSERT INTO correcao_enem(id_aluno_redacao, id_redacao, criterio_1, criterio_2, criterio_3, criterio_4, criterio_5, nota_final, trecho_selecionado, comentario)VALUES($id_aluno, $id_redacao, $n1, $n2, $n3, $n4, $n5, $nota_total, '$trechos_arr[$i]', '$comentarios_arr[$i]')";
            $sql_insert_result = mysqli_query($conn, $sql_insert);
            if($sql_insert_result){
                $enviado = true;
            }else{
                echo 'Falha ao enviar dados.';
                $enviado = false;
            }
        }

        if($enviado == true){
            if($tipo_redacao == 2){
                $sql_insert_dados_grafico = "INSERT INTO dados_graficos(id_aluno, universidade, nota_total, mes_envio)VALUES($id_aluno, '$modelo_redacao', $nota_total, now())";
                $sql_insert_dados_grafico_result = mysqli_query($conn, $sql_insert_dados_grafico);
                if($sql_insert_dados_grafico_result){
                    echo 'Tabela de dados e de correção preenchidas com sucesso.';
                                     
                    $sql_update_status_redacao = "UPDATE redacoes_escritas SET redacao_alterada = '$redacao_alterada', status_corrigida = 1 WHERE id_red = $id_redacao";
                    $sql_update_status_redacao_result = mysqli_query($conn, $sql_update_status_redacao);
                    if($sql_update_status_redacao_result){
                        echo 'Dados atualizados com sucesso.';
                        header('Location: ./minhas_correcoes.php');
                    }else{
                        echo 'Falha ao atualizar os dados.';
                    }
                }else{
                    echo 'Falha ao preencher tabela para alimentar o graficos.';
                } 
            }else if($tipo_redacao == 1){
                $sql_update_status_redacao = "UPDATE redacoes_enviadas SET redacao_alterada = '$redacao_alterada', status_corrigida = 1 WHERE id_red = $id_redacao";
                $sql_update_status_redacao_result = mysqli_query($conn, $sql_update_status_redacao);
                if($sql_update_status_redacao_result){
                    echo 'Dados atualizados com sucesso.';
                    header('Location: ./minhas_correcoes.php');
                }else{
                    echo 'Falha ao atualizar os dados.';
                }
            }
        }
    }else if($modelo_redacao == 'Fuvest'){
        $n1 = mysqli_real_escape_string($conn, $_GET['n1']);
        $n2 = mysqli_real_escape_string($conn, $_GET['n2']);
        $n3 = mysqli_real_escape_string($conn, $_GET['n3']);
        $nota_total = mysqli_real_escape_string($conn, $_GET['nota_total']);

        for($i = 0; $i < count($trechos_arr); $i++){
            $sql_insert = "INSERT INTO correcao_fuvest(id_aluno_redacao, id_redacao, criterio_a, criterio_b, criterio_c, nota_final, trecho_selecionado, comentario)VALUES($id_aluno, $id_redacao, $n1, $n2, $n3, $nota_total, '$trechos_arr[$i]', '$comentarios_arr[$i]')";
            $sql_insert_result = mysqli_query($conn, $sql_insert);
            if($sql_insert_result){
                $enviado = true;
            }else{
                echo 'Falha ao enviar dados.';
                $enviado = false;
            }
        }

        if($enviado == true){
            if($tipo_redacao == 2){
                $sql_insert_dados_grafico = "INSERT INTO dados_graficos(id_aluno, universidade, nota_total, mes_envio)VALUES($id_aluno, '$modelo_redacao', $nota_total, '$mes_envio')";
                $sql_insert_dados_grafico_result = mysqli_query($conn, $sql_insert_dados_grafico);
                if($sql_insert_dados_grafico_result){
                    echo 'Tabela de dados e de correção preenchidas com sucesso.';
                                     
                    $sql_update_status_redacao = "UPDATE redacoes_escritas SET redacao_alterada = '$redacao_alterada', status_corrigida = 1 WHERE id_red = $id_redacao";
                    $sql_update_status_redacao_result = mysqli_query($conn, $sql_update_status_redacao);
                    if($sql_update_status_redacao_result){
                        echo 'Dados atualizados com sucesso.';
                        header('Location: ./minhas_correcoes.php');
                    }else{
                        echo 'Falha ao atualizar os dados.';
                    }
                }else{
                    echo 'Falha ao preencher tabela para alimentar o graficos.';
                } 
            }else if($tipo_redacao == 1){
                echo 'Redação enviada';
                $sql_update_status_redacao = "UPDATE redacoes_enviadas SET redacao_alterada = '$redacao_alterada', status_corrigida = 1 WHERE id_red = $id_redacao";
                $sql_update_status_redacao_result = mysqli_query($conn, $sql_update_status_redacao);
                if($sql_update_status_redacao_result){
                    echo 'Dados atualizados com sucesso.';
                    header('Location: ./minhas_correcoes.php');
                }else{
                    echo 'Falha ao atualizar os dados.';
                }
            }
        }else{
            echo 'Variavel $enviado com valor false';
            echo $enviado;
        }

    }else if($modelo_redacao == 'Unicamp'){
        $n1 = mysqli_real_escape_string($conn, $_GET['n1']);
        $n2 = mysqli_real_escape_string($conn, $_GET['n2']);
        $n3 = mysqli_real_escape_string($conn, $_GET['n3']);
        $n4 = mysqli_real_escape_string($conn, $_GET['n4']);
        $nota_total = mysqli_real_escape_string($conn, $_GET['nota_total']);

        for($i = 0; $i < count($trechos_arr); $i++){
            $sql_insert = "INSERT INTO correcao_unicamp(id_aluno_redacao, id_redacao, criterio_1, criterio_2, criterio_3, criterio_4, nota_final, trecho_selecionado, comentario)VALUES($id_aluno, $id_redacao, $n1, $n2, $n3, $n4, $nota_total, '$trechos_arr[$i]', '$comentarios_arr[$i]')";
            $sql_insert_result = mysqli_query($conn, $sql_insert);
            if($sql_insert_result){
                $enviado = true;
            }else{
                echo 'Falha ao enviar dados.';
                echo '<br>'.$n1.'<br>'.$n2.'<br>'.$n3.'<br>'.$n4.'<br>'.$nota_total;
                $enviado = false;
            }
        }

        if($enviado == true){
            if($tipo_redacao == 2){
                $sql_insert_dados_grafico = "INSERT INTO dados_graficos(id_aluno, universidade, nota_total, mes_envio)VALUES($id_aluno, '$modelo_redacao', $nota_total, '$mes_envio')";
                $sql_insert_dados_grafico_result = mysqli_query($conn, $sql_insert_dados_grafico);
                if($sql_insert_dados_grafico_result){
                    echo 'Tabela de dados e de correção preenchidas com sucesso.';
                                     
                    $sql_update_status_redacao = "UPDATE redacoes_escritas SET redacao_alterada = '$redacao_alterada', status_corrigida = 1 WHERE id_red = $id_redacao";
                    $sql_update_status_redacao_result = mysqli_query($conn, $sql_update_status_redacao);
                    if($sql_update_status_redacao_result){
                        echo 'Dados atualizados com sucesso.';
                        header('Location: ./minhas_correcoes.php');
                    }else{
                        echo 'Falha ao atualizar os dados.';
                    }
                }else{
                    echo 'Falha ao preencher tabela para alimentar o graficos.';
                } 
            }else if($tipo_redacao == 1){
                $sql_update_status_redacao = "UPDATE redacoes_enviadas SET redacao_alterada = '$redacao_alterada', status_corrigida = 1 WHERE id_red = $id_redacao";
                $sql_update_status_redacao_result = mysqli_query($conn, $sql_update_status_redacao);
                if($sql_update_status_redacao_result){
                    echo 'Dados atualizados com sucesso.';
                    header('Location: ./minhas_correcoes.php');
                }else{
                    echo 'Falha ao atualizar os dados.';
                }
            }
        }
    }else if($modelo_redacao == 'Vunesp'){
        $n1 = mysqli_real_escape_string($conn, $_GET['n1']);
        $n2 = mysqli_real_escape_string($conn, $_GET['n2']);
        $n3 = mysqli_real_escape_string($conn, $_GET['n3']);
        $nota_total = mysqli_real_escape_string($conn, $_GET['nota_total']);

        for($i = 0; $i < count($trechos_arr); $i++){
            $sql_insert = "INSERT INTO correcao_vunesp(id_aluno_redacao, id_redacao, criterio_a, criterio_b, criterio_c, nota_final, trecho_selecionado, comentario)VALUES($id_aluno, $id_redacao, $n1, $n2, $n3, $nota_total, '$trechos_arr[$i]', '$comentarios_arr[$i]')";
            $sql_insert_result = mysqli_query($conn, $sql_insert);
            if($sql_insert_result){
                $enviado = true;
            }else{
                echo 'Falha ao enviar dados.';
                $enviado = false;
            }
        }

        if($enviado == true){
            if($tipo_redacao == 2){
                $sql_insert_dados_grafico = "INSERT INTO dados_graficos(id_aluno, universidade, nota_total, mes_envio)VALUES($id_aluno, '$modelo_redacao', $nota_total, '$mes_envio')";
                $sql_insert_dados_grafico_result = mysqli_query($conn, $sql_insert_dados_grafico);
                if($sql_insert_dados_grafico_result){
                    echo 'Tabela de dados e de correção preenchidas com sucesso.';
                                     
                    $sql_update_status_redacao = "UPDATE redacoes_escritas SET redacao_alterada = '$redacao_alterada', status_corrigida = 1 WHERE id_red = $id_redacao";
                    $sql_update_status_redacao_result = mysqli_query($conn, $sql_update_status_redacao);
                    if($sql_update_status_redacao_result){
                        echo 'Dados atualizados com sucesso.';
                        header('Location: ./minhas_correcoes.php');
                    }else{
                        echo 'Falha ao atualizar os dados.';
                    }
                }else{
                    echo 'Falha ao preencher tabela para alimentar o graficos.';
                } 
            }else if($tipo_redacao == 1){
                $sql_update_status_redacao = "UPDATE redacoes_enviadas SET redacao_alterada = '$redacao_alterada', status_corrigida = 1 WHERE id_red = $id_redacao";
                $sql_update_status_redacao_result = mysqli_query($conn, $sql_update_status_redacao);
                if($sql_update_status_redacao_result){
                    echo 'Dados atualizados com sucesso.';
                    header('Location: ./minhas_correcoes.php');
                }else{
                    echo 'Falha ao atualizar os dados.';
                }
            }
        }
    }
?>