<?php
    include './../connection.php';

    $json = $_POST['string_json'];
    $array_json = json_decode($json);

    $id_aluno = $array_json->{'id_aluno'};
    $id_redacao = $array_json->{'id_redacao'};
    $id_corretor = $array_json->{'id_corretor'};
    $modelo_redacao = $array_json->{'modelo_redacao'};
    $redacao_alterada = $array_json->{'redacao_alterada'};
    $inserir;

    //var_dump($array_json); 

    //echo $modelo_redacao;
    //echo $id_aluno;
    //echo $id_redacao;
    
    //salvar as notas e comentários da redação
    if($modelo_redacao == 'Enem'){
        $n1 = $array_json->{'n1'};
        $n2 = $array_json->{'n2'};
        $n3 = $array_json->{'n3'};
        $n4 = $array_json->{'n4'};
        $n5 = $array_json->{'n5'};
        $nota_total = $array_json->{'nota_total'};

        $comentario_final = $array_json->{'comentario_final'};
    
        $array_comentarios = $array_json->{'comentarios'};
        $array_trechos = $array_json->{'trechos'};

        //variaveis de verificação
        $inserir;


        for($i = 0; $i < count($array_comentarios); $i++){
            $sql_insert_notas_enem = "INSERT INTO correcao_enem(id_aluno_redacao, id_redacao, criterio_1, criterio_2, criterio_3, criterio_4, criterio_5, nota_final, trecho_selecionado, comentario)VALUES($id_aluno, $id_redacao, $n1, $n2, $n3, $n4, $n5, $nota_total, '$array_trechos[$i]', '$array_comentarios[$i]')";
            $sql_insert_notas_enem_result = mysqli_query($conn, $sql_insert_notas_enem);
            if($sql_insert_notas_enem_result){
                $inserir = true;
                echo 'Dados inseridos com sucesso.';
            }else{
                $inserir = false;
                echo 'Falha ao inserir dados.';
            }
        }

        if($inserir == true){
            $sql_update_status_redacao_corrigida = "UPDATE redacoes_escritas SET status_corrigida = 1 , redacao_alterada = '$redacao_alterada', comentario_final = '$comentario_final' WHERE id_aluno_redacao = $id_aluno AND id_red = $id_redacao";
            $sql_update_status_redacao_corrigida_result = mysqli_query($conn, $sql_update_status_redacao_corrigida);
            if($sql_update_status_redacao_corrigida_result){
                echo 'Status atualizado com sucesso.';

                $qtd_red_corrigidas_bd = 0;
                $qtd_red_corrigidas_new = 0;

                $sql_select_qtd_red_corrigidas = "SELECT * FROM dados_corretor WHERE id_corretor = $id_corretor";
                $sql_select_qtd_red_corrigidas_result = mysqli_query($conn, $sql_select_qtd_red_corrigidas);
                if($sql_select_qtd_red_corrigidas_result){
                    while($row = mysqli_fetch_array($sql_select_qtd_red_corrigidas_result)){
                        $qtd_red_corrigidas_bd  = $row['qtd_red_corrigidas']; 
                    }
                    $qtd_red_corrigidas_new = $qtd_red_corrigidas_bd + 1;
                }else{
                    echo 'Falha ao selecionar número de redações corrigidas por este corretor.';
                }

                $sql_update_num_red_corrigidas = "UPDATE dados_corretor SET qtd_red_corrigidas = $qtd_red_corrigidas_new WHERE id_corretor = $id_corretor";
                $sql_update_num_red_corrigidas_result = mysqli_query($conn, $sql_update_num_red_corrigidas);
                echo $qtd_red_corrigidas_new;

                $mes_envio = date("F");
                $sql_insert_dados_graficos = "INSERT INTO dados_graficos(id_aluno, universidade, nota_total, mes_envio)VALUES($id_aluno, '$modelo_redacao', $nota_total, '$mes_envio')";
                $sql_insert_dados_graficos_result = mysqli_query($conn, $sql_insert_dados_graficos);
                if($sql_insert_dados_graficos){
                    echo 'Dados enviados com sucesso para a tabela dados_graficos';
                }else{
                    echo 'Erro ao enviar dados para tabela gráficos.';
                }
            }else{
                echo 'Erro ao atualizar status de correção da redação.';
            }
        }
    }else if($modelo_redacao == 'Unicamp'){ 
        $n1 = $array_json->{'n1'};
        $n2 = $array_json->{'n2'};
        $n3 = $array_json->{'n3'};
        $n4 = $array_json->{'n4'};
        $nota_total = $array_json->{'nota_total'};

        $comentario_final = $array_json->{'comentario_final'};

        $array_comentarios = $array_json->{'comentarios'};
        $array_trechos = $array_json->{'trechos'};

        for($i = 0; $i < count($array_comentarios); $i++){
            $sql_insert_notas_enem = "INSERT INTO correcao_unicamp(id_aluno_redacao, id_redacao, criterio_1, criterio_2, criterio_3, criterio_4, nota_final, trecho_selecionado, comentario)VALUES($id_aluno, $id_redacao, $n1, $n2, $n3, $n4, $nota_total, '$array_trechos[$i]', '$array_comentarios[$i]')";
            $sql_insert_notas_enem_result = mysqli_query($conn, $sql_insert_notas_enem);
            if($sql_insert_notas_enem_result){
                $inserir = true;
                echo 'Dados inseridos com sucesso.';
            }else{
                $inserir = false;
                echo 'Falha ao inserir dados.';
            }
        }

        if($inserir == true){
            $sql_update_status_redacao_corrigida = "UPDATE redacoes_escritas SET status_corrigida = 1 , redacao_alterada = '$redacao_alterada', comentario_final = '$comentario_final' WHERE id_aluno_redacao = $id_aluno AND id_red = $id_redacao";
            $sql_update_status_redacao_corrigida_result = mysqli_query($conn, $sql_update_status_redacao_corrigida);
            if($sql_update_status_redacao_corrigida_result){
                echo 'Status atualizado com sucesso.';

                $qtd_red_corrigidas_bd = 0;
                $qtd_red_corrigidas_new = 0;

                $sql_select_qtd_red_corrigidas = "SELECT * FROM dados_corretor WHERE id_corretor = $id_corretor";
                $sql_select_qtd_red_corrigidas_result = mysqli_query($conn, $sql_select_qtd_red_corrigidas);
                if($sql_select_qtd_red_corrigidas_result){
                    while($row = mysqli_fetch_array($sql_select_qtd_red_corrigidas_result)){
                        $qtd_red_corrigidas_bd  = $row['qtd_red_corrigidas']; 
                    }
                    $qtd_red_corrigidas_new = $qtd_red_corrigidas_bd + 1;
                }else{
                    echo 'Falha ao selecionar número de redações corrigidas por este corretor.';
                }

                $sql_update_num_red_corrigidas = "UPDATE dados_corretor SET qtd_red_corrigidas = $qtd_red_corrigidas_new WHERE id_corretor = $id_corretor";
                $sql_update_num_red_corrigidas_result = mysqli_query($conn, $sql_update_num_red_corrigidas);
                echo $qtd_red_corrigidas_new;

                $mes_envio = date("F");
                $sql_insert_dados_graficos = "INSERT INTO dados_graficos(id_aluno, universidade, nota_total, mes_envio)VALUES($id_aluno, '$modelo_redacao', $nota_total, '$mes_envio')";
                $sql_insert_dados_graficos_result = mysqli_query($conn, $sql_insert_dados_graficos);
                if($sql_insert_dados_graficos){
                    echo 'Dados enviados com sucesso para a tabela dados_graficos';
                }else{
                    echo 'Erro ao enviar dados para tabela gráficos.';
                }
            }else{
                echo 'Erro ao atualizar status de correção da redação.';
            }
        }

    }else if($modelo_redacao == 'Fuvest'){
        $n1 = $array_json->{'n1'};
        $n2 = $array_json->{'n2'};
        $n3 = $array_json->{'n3'};
        $nota_total = $array_json->{'nota_total'};

        $comentario_final = $array_json->{'comentario_final'};

        $array_comentarios = $array_json->{'comentarios'};
        $array_trechos = $array_json->{'trechos'};
        $array_cores = $array_json->{'cores'};
        //variaveis de verificação
        $inserir;


        for($i = 0; $i < count($array_comentarios); $i++){
            $sql_insert_notas = "INSERT INTO correcao_fuvest(id_aluno_redacao, id_redacao, criterio_a, criterio_b, criterio_c, nota_final, trecho_selecionado, comentario, cor_comentario)VALUES($id_aluno, $id_redacao, $n1, $n2, $n3, $nota_total, '$array_trechos[$i]', '$array_comentarios[$i]', '$array_cores[$i]')";
            $sql_insert_notas_result = mysqli_query($conn, $sql_insert_notas);
            if($sql_insert_notas_result){
                $inserir = true;
                echo 'Dados inseridos com sucesso.';
            }else{
                $inserir = false;
                echo 'Falha ao inserir dados.';
            }
        }

        if($inserir == true){
            $sql_update_status_redacao_corrigida = "UPDATE redacoes_escritas SET status_corrigida = 1 , redacao_alterada = '$redacao_alterada', comentario_final = '$comentario_final' WHERE id_aluno_redacao = $id_aluno AND id_red = $id_redacao";
            $sql_update_status_redacao_corrigida_result = mysqli_query($conn, $sql_update_status_redacao_corrigida);
            if($sql_update_status_redacao_corrigida_result){
                echo 'Status atualizado com sucesso.';

                $qtd_red_corrigidas_bd = 0;
                $qtd_red_corrigidas_new = 0;

                $sql_select_qtd_red_corrigidas = "SELECT * FROM dados_corretor WHERE id_corretor = $id_corretor";
                $sql_select_qtd_red_corrigidas_result = mysqli_query($conn, $sql_select_qtd_red_corrigidas);
                if($sql_select_qtd_red_corrigidas_result){
                    while($row = mysqli_fetch_array($sql_select_qtd_red_corrigidas_result)){
                        $qtd_red_corrigidas_bd  = $row['qtd_red_corrigidas']; 
                    }
                    $qtd_red_corrigidas_new = $qtd_red_corrigidas_bd + 1;
                }else{
                    echo 'Falha ao selecionar número de redações corrigidas por este corretor.';
                }

                $sql_update_num_red_corrigidas = "UPDATE dados_corretor SET qtd_red_corrigidas = $qtd_red_corrigidas_new WHERE id_corretor = $id_corretor";
                $sql_update_num_red_corrigidas_result = mysqli_query($conn, $sql_update_num_red_corrigidas);
                echo $qtd_red_corrigidas_new;

                $mes_envio = date("F");
                $sql_insert_dados_graficos = "INSERT INTO dados_graficos(id_aluno, universidade, nota_total, mes_envio)VALUES($id_aluno, '$modelo_redacao', $nota_total, '$mes_envio')";
                $sql_insert_dados_graficos_result = mysqli_query($conn, $sql_insert_dados_graficos);
                if($sql_insert_dados_graficos){
                    echo 'Dados enviados com sucesso para a tabela dados_graficos';
                }else{
                    echo 'Erro ao enviar dados para tabela gráficos.';
                }
            }else{
                echo 'Erro ao atualizar status de correção da redação.';
            }
        }
    }else if($modelo_redacao == 'Vunesp'){
        $n1 = $array_json->{'n1'};
        $n2 = $array_json->{'n2'};
        $n3 = $array_json->{'n3'};
        $nota_total = $array_json->{'nota_total'};

        $comentario_final = $array_json->{'comentario_final'};

        $array_comentarios = $array_json->{'comentarios'};
        $array_trechos = $array_json->{'trechos'};

        //variaveis de verificação
        $inserir;


        for($i = 0; $i < count($array_comentarios); $i++){
            $sql_insert_notas = "INSERT INTO correcao_vunesp(id_aluno_redacao, id_redacao, criterio_a, criterio_b, criterio_c, nota_final, trecho_selecionado, comentario)VALUES($id_aluno, $id_redacao, $n1, $n2, $n3, $nota_total, '$array_trechos[$i]', '$array_comentarios[$i]')";
            $sql_insert_notas_result = mysqli_query($conn, $sql_insert_notas);
            if($sql_insert_notas_result){
                $inserir = true;
                echo 'Dados inseridos com sucesso.';
            }else{
                $inserir = false;
                echo 'Falha ao inserir dados.';
            }
        }

        if($inserir == true){
            $sql_update_status_redacao_corrigida = "UPDATE redacoes_escritas SET status_corrigida = 1 , redacao_alterada = '$redacao_alterada',comentario_final = '$comentario_final' WHERE id_aluno_redacao = $id_aluno AND id_red = $id_redacao";
            $sql_update_status_redacao_corrigida_result = mysqli_query($conn, $sql_update_status_redacao_corrigida);
            if($sql_update_status_redacao_corrigida_result){
                echo 'Status atualizado com sucesso.';

                $qtd_red_corrigidas_bd = 0;
                $qtd_red_corrigidas_new = 0;

                $sql_select_qtd_red_corrigidas = "SELECT * FROM dados_corretor WHERE id_corretor = $id_corretor";
                $sql_select_qtd_red_corrigidas_result = mysqli_query($conn, $sql_select_qtd_red_corrigidas);
                if($sql_select_qtd_red_corrigidas_result){
                    while($row = mysqli_fetch_array($sql_select_qtd_red_corrigidas_result)){
                        $qtd_red_corrigidas_bd  = $row['qtd_red_corrigidas']; 
                    }
                    $qtd_red_corrigidas_new = $qtd_red_corrigidas_bd + 1;
                }else{
                    echo 'Falha ao selecionar número de redações corrigidas por este corretor.';
                }

                $sql_update_num_red_corrigidas = "UPDATE dados_corretor SET qtd_red_corrigidas = $qtd_red_corrigidas_new WHERE id_corretor = $id_corretor";
                $sql_update_num_red_corrigidas_result = mysqli_query($conn, $sql_update_num_red_corrigidas);
                echo $qtd_red_corrigidas_new;

                $mes_envio = date("F");
                $sql_insert_dados_graficos = "INSERT INTO dados_graficos(id_aluno, universidade, nota_total, mes_envio)VALUES($id_aluno, '$modelo_redacao', $nota_total, '$mes_envio')";
                $sql_insert_dados_graficos_result = mysqli_query($conn, $sql_insert_dados_graficos);
                if($sql_insert_dados_graficos){
                    echo 'Dados enviados com sucesso para a tabela dados_graficos';
                }else{
                    echo 'Erro ao enviar dados para tabela gráficos.';
                }
    
            }else{
                echo 'Erro ao atualizar status de correção da redação.';
            }
        }
    }

    function SalvarDadosGrafico(){
        //enviar os dados para a tabela de gráficos
    }
    