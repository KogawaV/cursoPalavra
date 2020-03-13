<?php
    /*
        Precisa bolar um algoritmo para calcular a média das redações sozinho.
    */
    include './../connection.php';
    session_start();
    if(!isset($_SESSION['email_corretor']) && !isset($_SESSION['id_corretor']) && !isset($_SESSION['nome_corretor'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
            $universidade_redacao = strtolower(mysqli_real_escape_string($conn, $_GET['universidade_redacao']));
            $tipo_redacao = mysqli_real_escape_string($conn, $_GET['tipo_redacao']);

            if($tipo_redacao == 1){//REDAÇÕES ENVIADAS
                if(isset($universidade_redacao)){
                    if($universidade_redacao == 'enem'){//INSERT ENEM
                        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
                        $criterio_enem_1 = mysqli_real_escape_string($conn, $_POST['criterio_1_enem']);
                        $criterio_enem_2 = mysqli_real_escape_string($conn, $_POST['criterio_2_enem']);
                        $criterio_enem_3 = mysqli_real_escape_string($conn, $_POST['criterio_3_enem']);
                        $criterio_enem_4 = mysqli_real_escape_string($conn, $_POST['criterio_4_enem']);
                        $criterio_enem_5 = mysqli_real_escape_string($conn, $_POST['criterio_5_enem']);
                        $nota_total_enem = mysqli_real_escape_string($conn, $_POST['nota_total_enem']);
                        $texto_comentario = mysqli_real_escape_string($conn, $_POST['texto_comentario']);
        
                        //echo 'Id redação:'.$id_redacao.'<br>Nota 1: '.$criterio_enem_1.'<br>Nota 2:'.$criterio_enem_2.'<br>Nota 3:'.$criterio_enem_3.'<br>Nota 4: '.$criterio_enem_4.'<br>Nota 5: '.$criterio_enem_5.'<br>Nota Final: '.$nota_total_enem.'<br>';
                        
                        //verificando se a correção desta redação redação já existe na base de dados
                        $sql_select_correcao_enem = "SELECT * FROM correcao_enem WHERE id_redacao = $id_redacao";
                        $sql_select_correcao_enem_result = mysqli_query($conn, $sql_select_correcao_enem);
    
                        if($sql_select_correcao_enem_result){
                            
                            $row_correcao_enem = mysqli_num_rows($sql_select_correcao_enem_result);
    
                            if($row_correcao_enem == 1){
                                //realizar o update
                                $sql_update_redacao_enem = "UPDATE correcao_enem SET criterio_1 = $criterio_enem_1, criterio_2 = $criterio_enem_2, criterio_3 = $criterio_enem_3, criterio_4 = $criterio_enem_4, criterio_5 = $criterio_enem_5, nota_final = $nota_total_enem,  comentario = '$texto_comentario' WHERE id_redacao = $id_redacao";
                                if($sql_update_redacao_enem_result = mysqli_query($conn, $sql_update_redacao_enem)){
                                    echo 'Dados de correção desta redação atualizados realizados com sucesso.';
                                    $sql_update_enem = "UPDATE redacoes_enviadas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_enem_result = mysqli_query($conn, $sql_update_enem)){
                                        echo 'Status da redação atualizado com sucesso.'; 
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro ao atualizar o status de correção da redação.';
                                    }
                                }else{
                                    echo 'Não foi possível atualizar os dados de correção desta redação na base da dados.';
                                    header('Location: ./minhas_correcoes.php');
                                }
                            }else{
                                //perguntar para o pessoal da plataforma se o comentário para cada redação será obrigatório ou vai de acordo com cada corretor.
                                
                                //realizar o insert desta correção na base de dados
                                $sql_insert_enem = "INSERT INTO correcao_enem(id_redacao, criterio_1, criterio_2, criterio_3, criterio_4, criterio_5, nota_final, comentario)VALUES($id_redacao, $criterio_enem_1, $criterio_enem_2, $criterio_enem_3, $criterio_enem_4, $criterio_enem_5, $nota_total_enem, '$texto_comentario')";
                                if($sql_insert_enem_result = mysqli_query($conn, $sql_insert_enem)){
                                    echo 'Notas enviadas com sucesso.';
                                    $sql_update_enem = "UPDATE redacoes_enviadas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_enem_result = mysqli_query($conn, $sql_update_enem)){
                                        echo 'Status da redação atualizado com sucesso.'; 
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro ao atualizar o status de correção da redação.';
                                    }
                                }else{
                                    echo 'Erro ao enviar notas para a base de dados.';
                                }
                            }
                        }else{
                            //echo 'Erro na query $sql_select_correcao_enem';
                            echo '
                            <div class="painel">
                                <p>Nenhum comentário para ser enviado.</p>
                                <button><a href="./minhas_correcoes.php">Ir para minhas redações</a></button>
                            </div>';
                        }
                    }else if($universidade_redacao == 'unicamp'){//INSERT UNICAMP
                        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
                        $criterio_unicamp_1 = mysqli_real_escape_string($conn, $_POST['criterio_1_unicamp']);
                        $criterio_unicamp_2 = mysqli_real_escape_string($conn, $_POST['criterio_2_unicamp']);
                        $criterio_unicamp_3 = mysqli_real_escape_string($conn, $_POST['criterio_3_unicamp']);
                        $criterio_unicamp_4 = mysqli_real_escape_string($conn, $_POST['criterio_4_unicamp']);
                        $nota_total_unicamp = mysqli_real_escape_string($conn, $_POST['nota_total_unicamp']);
                        $texto_comentario = mysqli_real_escape_string($conn, $_POST['texto_comentario']);
    
                        //verificar e não existe uma correção desta redação na base de dados
                        $sql_select_correcao_unicamp = "SELECT * FROM correcao_unicamp WHERE id_redacao = $id_redacao";
                        if($sql_select_correcao_unicamp_result = mysqli_query($conn, $sql_select_correcao_unicamp)){
                            $row_correcao_unicamp = mysqli_num_rows($sql_select_correcao_unicamp_result);
                            if($row_correcao_unicamp == 1){
                                //realizar o update
                                $sql_update_correcao_unicamp = "UPDATE correcao_unicamp SET criterio_1 = $criterio_unicamp_1, criterio_2 = $criterio_unicamp_2, criterio_3 = $criterio_unicamp_3, criterio_4 = $criterio_unicamp_4, nota_final = $nota_total_unicamp, comentario = '$texto_comentario' WHERE id_redacao = $id_redacao";
                                if($sql_update_correcao_unicamp_result = mysqli_query($conn, $sql_update_correcao_unicamp)){
                                    echo 'Dados de correção desta redação realizados com sucesso.';
                                    $sql_update_status_correcao_unicamp = "UPDATE redacoes_enviadas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_unicamp_result = mysqli_query($conn, $sql_update_status_correcao_unicamp)){
                                        echo 'Status de correção desta redação atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Falha ao atualizar status desta redação.';
                                    }
                                }else{
                                    echo 'Não foi possível atualizar os dados de correção desta redação na base da dados.';
                                    header('Location: ./minhas_correcoes.php');
                                }
                            }else{
                                //realizar o insert
                                $sql_insert_unicamp = "INSERT INTO correcao_unicamp(id_redacao, criterio_1, criterio_2, criterio_3, criterio_4, nota_final, comentario)VALUES($id_redacao, $criterio_unicamp_1, $criterio_unicamp_2, $criterio_unicamp_3, $criterio_unicamp_4, $nota_total_unicamp, '$texto_comentario')";
                                if($sql_insert_unicamp_result = mysqli_query($conn, $sql_insert_unicamp)){
                                    echo 'Notas enviadas com sucesso.';
                                    $sql_update_status_correcao_unicamp = "UPDATE redacoes_enviadas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_unicamp_result = mysqli_query($conn, $sql_update_status_correcao_unicamp)){
                                        echo 'Status de correção desta redação atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Falha ao atualizar status desta redação.';
                                    }
                                }else{
                                    echo 'Erro ao enviar notas para a base de dados.';
                                }
                            }
                        }else{
                            echo 'Erro na query $sql_select_correcao_unicamp';
                        }  
                    }else if($universidade_redacao == 'fuvest'){//INSERT FUVEST
                        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
                        $criterio_fuvest_1 = mysqli_real_escape_string($conn, $_POST['criterio_1_fuvest']);
                        $criterio_fuvest_2 = mysqli_real_escape_string($conn, $_POST['criterio_2_fuvest']);
                        $criterio_fuvest_3 = mysqli_real_escape_string($conn, $_POST['criterio_3_fuvest']);
                        $nota_total_fuvest = mysqli_real_escape_string($conn, $_POST['nota_total_fuvest']);
                        $texto_comentario = mysqli_real_escape_string($conn, $_POST['texto_comentario']);
                        
                        //echo $id_redacao.'<br>'.$criterio_fuvest_1.'<br>'.$criterio_fuvest_2.'<br>'.$criterio_fuvest_3.'<br>'.$nota_total_fuvest;
    
                        //verificar se não existe uma coreção desta redação na base de dados
                        $sql_select_correcao_fuvest = "SELECT * FROM correcao_fuvest WHERE id_redacao = $id_redacao";
                        if($sql_select_correcao_fuvest_result = mysqli_query($conn, $sql_select_correcao_fuvest)){
                            $row_correcao_fuvest = mysqli_num_rows($sql_select_correcao_fuvest_result);
                            if($row_correcao_fuvest == 1){
                                //realizar update
                                $sql_update_correcao_fuvest = "UPDATE correcao_fuvest SET criterio_a = $criterio_fuvest_1, criterio_b = $criterio_fuvest_2, criterio_c = $criterio_fuvest_3, nota_final = $nota_total_fuvest, comentario = '$texto_comentario' WHERE id_redacao = $id_redacao";
                                if($sql_update_correcao_fuvest_result = mysqli_query($conn, $sql_update_correcao_fuvest)){
                                    echo 'Dados de correção desta redação atualizados com sucesso.';
                                    $sql_update_status_correcao_fuvest = "UPDATE redacoes_enviadas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_fuvest_result = mysqli_query($conn, $sql_update_status_correcao_fuvest)){
                                        echo 'Status de correção desta redação foram atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro na query $sql_update_status_correcao_fuvest';
                                    }
                                }else{
                                    echo 'Erro na query $sql_update_correcao_fuvest';
                                }
                            }else{
                                //realizar insert -> realizar update do status corrigida
                                $sql_insert_fuvest = "INSERT INTO correcao_fuvest(id_redacao, criterio_a, criterio_b, criterio_c, nota_final, comentario)VALUES($id_redacao, $criterio_fuvest_1, $criterio_fuvest_2, $criterio_fuvest_3, $nota_total_fuvest, '$texto_comentario')";
                                if($sql_insert_fuvest_result = mysqli_query($conn, $sql_insert_fuvest)){
                                    echo 'Notas enviadas com sucesso.';
                                    $sql_update_status_correcao_fuvest = "UPDATE redacoes_enviadas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_fuvest_result = mysqli_query($conn, $sql_update_status_correcao_fuvest)){
                                        echo 'Status de correção desta redação foram atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro na query $sql_update_status_correcao_fuvest';
                                    }
                                }else{
                                    echo 'Erro ao enviar notas para a base de dados.';
                                }
                            }
                        }else{
                            echo 'Erro na query $sql_select_correcao_fuvest';
                        }
                    }else if($universidade_redacao == 'vunesp'){//INSERT VUNESP
                        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
                        $criterio_vunesp_1 = mysqli_real_escape_string($conn, $_POST['criterio_1_vunesp']);
                        $criterio_vunesp_2 = mysqli_real_escape_string($conn, $_POST['criterio_2_vunesp']);
                        $criterio_vunesp_3 = mysqli_real_escape_string($conn, $_POST['criterio_3_vunesp']);
                        $nota_total_vunesp = mysqli_real_escape_string($conn, $_POST['nota_total_vunesp']);
                        $texto_comentario = mysqli_real_escape_string($conn, $_POST['texto_comentario']);
    
    
                        //verificar se não existe uma correção desta redação na base de dados
                        $sql_select_correcao_vunesp = "SELECT * FROM correcao_vunesp WHERE id_redacao = $id_redacao";
                        if($sql_select_correcao_vunesp_result = mysqli_query($conn, $sql_select_correcao_vunesp)){
                            $row_correcao_vunesp = mysqli_num_rows($sql_select_correcao_vunesp_result);
                            if($row_correcao_vunesp == 1){
                                //realizar update
                                $sql_update_correcao_vunesp = "UPDATE correcao_vunesp SET criterio_a = $criterio_vunesp_1, criterio_b = $criterio_vunesp_2, criterio_c = $criterio_vunesp_3, nota_final = $nota_total_vunesp, comentario = '$texto_comentario' WHERE id_redacao = $id_redacao";
                                if($sql_update_correcao_vunesp_result = mysqli_query($conn, $sql_update_correcao_vunesp)){
                                    echo 'Dados de correção desta redação foram atualizados com sucesso.';
                                    $sql_update_status_correcao_vunesp = "UPDATE redacoes_enviadas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_vunesp_result = mysqli_query($conn, $sql_update_status_correcao_vunesp)){
                                        echo 'Status de correção atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro ao atualizar o status de correção desta redação.';
                                    }
                                }else{
                                    echo 'Falha ao atualizar os dados de correção desta redação';
                                }
                            }else{
                                //realiza insert -> realiza o update do status de correção desta redação
                                $sql_insert_vunesp = "INSERT INTO correcao_vunesp(id_redacao, criterio_a, criterio_b, criterio_c, nota_final, comentario)VALUES($id_redacao, $criterio_vunesp_1, $criterio_vunesp_2, $criterio_vunesp_3, $nota_total_vunesp, '$texto_comentario')";
                                if($sql_insert_vunesp_result = mysqli_query($conn, $sql_insert_vunesp)){
                                    echo 'Notas enviadas com sucesso.';
                                    $sql_update_status_correcao_vunesp = "UPDATE redacoes_enviadas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_vunesp_result = mysqli_query($conn, $sql_update_status_correcao_vunesp)){
                                        echo 'Status de correção atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro ao atualizar o status de correção desta redação.';
                                    }
                                }else{
                                    echo 'Erro ao enviar notas para a base de dados.';
                                }
                            }
                        }else{
                            echo 'Erro na query $sql_select_correcao_vunesp';
                        }
                    }
                }else{
                    echo 'Nenhuma universidade selecionada.';
                    header('Location: ./minhas_correcoes.php');
            }
            }else if($tipo_redacao == 2){//REDAÇÕES ESCRITAS
                if(isset($universidade_redacao)){
                    if($universidade_redacao == 'enem'){//INSERT ENEM
                        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
                        $criterio_enem_1 = mysqli_real_escape_string($conn, $_POST['criterio_1_enem']);
                        $criterio_enem_2 = mysqli_real_escape_string($conn, $_POST['criterio_2_enem']);
                        $criterio_enem_3 = mysqli_real_escape_string($conn, $_POST['criterio_3_enem']);
                        $criterio_enem_4 = mysqli_real_escape_string($conn, $_POST['criterio_4_enem']);
                        $criterio_enem_5 = mysqli_real_escape_string($conn, $_POST['criterio_5_enem']);
                        $nota_total_enem = mysqli_real_escape_string($conn, $_POST['nota_total_enem']);
                        $texto_comentario = mysqli_real_escape_string($conn, $_POST['texto_comentario']);
        
                        //echo 'Id redação:'.$id_redacao.'<br>Nota 1: '.$criterio_enem_1.'<br>Nota 2:'.$criterio_enem_2.'<br>Nota 3:'.$criterio_enem_3.'<br>Nota 4: '.$criterio_enem_4.'<br>Nota 5: '.$criterio_enem_5.'<br>Nota Final: '.$nota_total_enem.'<br>';
                        
                        //verificando se a correção desta redação redação já existe na base de dados
                        $sql_select_correcao_enem = "SELECT * FROM correcao_enem WHERE id_redacao = $id_redacao";
                        $sql_select_correcao_enem_result = mysqli_query($conn, $sql_select_correcao_enem);
    
                        if($sql_select_correcao_enem_result){
                            
                            $row_correcao_enem = mysqli_num_rows($sql_select_correcao_enem_result);
    
                            if($row_correcao_enem == 1){
                                //realizar o update
                                $sql_update_redacao_enem = "UPDATE correcao_enem SET criterio_1 = $criterio_enem_1, criterio_2 = $criterio_enem_2, criterio_3 = $criterio_enem_3, criterio_4 = $criterio_enem_4, criterio_5 = $criterio_enem_5, nota_final = $nota_total_enem,  comentario = '$texto_comentario' WHERE id_redacao = $id_redacao";
                                if($sql_update_redacao_enem_result = mysqli_query($conn, $sql_update_redacao_enem)){
                                    echo 'Dados de correção desta redação atualizados realizados com sucesso.';
                                    $sql_update_enem = "UPDATE redacoes_escritas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_enem_result = mysqli_query($conn, $sql_update_enem)){
                                        echo 'Status da redação atualizado com sucesso.'; 
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro ao atualizar o status de correção da redação.';
                                    }
                                }else{
                                    echo 'Não foi possível atualizar os dados de correção desta redação na base da dados.';
                                    header('Location: ./minhas_correcoes.php');
                                }
                            }else{
                                //perguntar para o pessoal da plataforma se o comentário para cada redação será obrigatório ou vai de acordo com cada corretor.
                                
                                //realizar o insert desta correção na base de dados
                                $sql_insert_enem = "INSERT INTO correcao_enem(id_redacao, criterio_1, criterio_2, criterio_3, criterio_4, criterio_5, nota_final, comentario)VALUES($id_redacao, $criterio_enem_1, $criterio_enem_2, $criterio_enem_3, $criterio_enem_4, $criterio_enem_5, $nota_total_enem, '$texto_comentario')";
                                if($sql_insert_enem_result = mysqli_query($conn, $sql_insert_enem)){
                                    echo 'Notas enviadas com sucesso.';
                                    $sql_update_enem = "UPDATE redacoes_escritas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_enem_result = mysqli_query($conn, $sql_update_enem)){
                                        echo 'Status da redação atualizado com sucesso.'; 
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro ao atualizar o status de correção da redação.';
                                    }
                                }else{
                                    echo 'Erro ao enviar notas para a base de dados.';
                                }
                            }
                        }else{
                            //echo 'Erro na query $sql_select_correcao_enem';
                            echo '
                            <div class="painel">
                                <p>Nenhum comentário para ser enviado.</p>
                                <button><a href="./minhas_correcoes.php">Ir para minhas redações</a></button>
                            </div>';
                        }
                    }else if($universidade_redacao == 'unicamp'){//INSERT UNICAMP
                        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
                        $criterio_unicamp_1 = mysqli_real_escape_string($conn, $_POST['criterio_1_unicamp']);
                        $criterio_unicamp_2 = mysqli_real_escape_string($conn, $_POST['criterio_2_unicamp']);
                        $criterio_unicamp_3 = mysqli_real_escape_string($conn, $_POST['criterio_3_unicamp']);
                        $criterio_unicamp_4 = mysqli_real_escape_string($conn, $_POST['criterio_4_unicamp']);
                        $nota_total_unicamp = mysqli_real_escape_string($conn, $_POST['nota_total_unicamp']);
                        $texto_comentario = mysqli_real_escape_string($conn, $_POST['texto_comentario']);
    
                        //verificar e não existe uma correção desta redação na base de dados
                        $sql_select_correcao_unicamp = "SELECT * FROM correcao_unicamp WHERE id_redacao = $id_redacao";
                        if($sql_select_correcao_unicamp_result = mysqli_query($conn, $sql_select_correcao_unicamp)){
                            $row_correcao_unicamp = mysqli_num_rows($sql_select_correcao_unicamp_result);
                            if($row_correcao_unicamp == 1){
                                //realizar o update
                                $sql_update_correcao_unicamp = "UPDATE correcao_unicamp SET criterio_1 = $criterio_unicamp_1, criterio_2 = $criterio_unicamp_2, criterio_3 = $criterio_unicamp_3, criterio_4 = $criterio_unicamp_4, nota_final = $nota_total_unicamp, comentario = '$texto_comentario' WHERE id_redacao = $id_redacao";
                                if($sql_update_correcao_unicamp_result = mysqli_query($conn, $sql_update_correcao_unicamp)){
                                    echo 'Dados de correção desta redação realizados com sucesso.';
                                    $sql_update_status_correcao_unicamp = "UPDATE redacoes_escritas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_unicamp_result = mysqli_query($conn, $sql_update_status_correcao_unicamp)){
                                        echo 'Status de correção desta redação atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Falha ao atualizar status desta redação.';
                                    }
                                }else{
                                    echo 'Não foi possível atualizar os dados de correção desta redação na base da dados.';
                                    header('Location: ./minhas_correcoes.php');
                                }
                            }else{
                                //realizar o insert
                                $sql_insert_unicamp = "INSERT INTO correcao_unicamp(id_redacao, criterio_1, criterio_2, criterio_3, criterio_4, nota_final, comentario)VALUES($id_redacao, $criterio_unicamp_1, $criterio_unicamp_2, $criterio_unicamp_3, $criterio_unicamp_4, $nota_total_unicamp, '$texto_comentario')";
                                if($sql_insert_unicamp_result = mysqli_query($conn, $sql_insert_unicamp)){
                                    echo 'Notas enviadas com sucesso.';
                                    $sql_update_status_correcao_unicamp = "UPDATE redacoes_escritas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_unicamp_result = mysqli_query($conn, $sql_update_status_correcao_unicamp)){
                                        echo 'Status de correção desta redação atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Falha ao atualizar status desta redação.';
                                    }
                                }else{
                                    echo 'Erro ao enviar notas para a base de dados.';
                                }
                            }
                        }else{
                            echo 'Erro na query $sql_select_correcao_unicamp';
                        }  
                    }else if($universidade_redacao == 'fuvest'){//INSERT FUVEST
                        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
                        $criterio_fuvest_1 = mysqli_real_escape_string($conn, $_POST['criterio_1_fuvest']);
                        $criterio_fuvest_2 = mysqli_real_escape_string($conn, $_POST['criterio_2_fuvest']);
                        $criterio_fuvest_3 = mysqli_real_escape_string($conn, $_POST['criterio_3_fuvest']);
                        $nota_total_fuvest = mysqli_real_escape_string($conn, $_POST['nota_total_fuvest']);
                        $texto_comentario = mysqli_real_escape_string($conn, $_POST['texto_comentario']);
                        
                        //echo $id_redacao.'<br>'.$criterio_fuvest_1.'<br>'.$criterio_fuvest_2.'<br>'.$criterio_fuvest_3.'<br>'.$nota_total_fuvest;
    
                        //verificar se não existe uma coreção desta redação na base de dados
                        $sql_select_correcao_fuvest = "SELECT * FROM correcao_fuvest WHERE id_redacao = $id_redacao";
                        if($sql_select_correcao_fuvest_result = mysqli_query($conn, $sql_select_correcao_fuvest)){
                            $row_correcao_fuvest = mysqli_num_rows($sql_select_correcao_fuvest_result);
                            if($row_correcao_fuvest == 1){
                                //realizar update
                                $sql_update_correcao_fuvest = "UPDATE correcao_fuvest SET criterio_a = $criterio_fuvest_1, criterio_b = $criterio_fuvest_2, criterio_c = $criterio_fuvest_3, nota_final = $nota_total_fuvest, comentario = '$texto_comentario' WHERE id_redacao = $id_redacao";
                                if($sql_update_correcao_fuvest_result = mysqli_query($conn, $sql_update_correcao_fuvest)){
                                    echo 'Dados de correção desta redação atualizados com sucesso.';
                                    $sql_update_status_correcao_fuvest = "UPDATE redacoes_escritas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_fuvest_result = mysqli_query($conn, $sql_update_status_correcao_fuvest)){
                                        echo 'Status de correção desta redação foram atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro na query $sql_update_status_correcao_fuvest';
                                    }
                                }else{
                                    echo 'Erro na query $sql_update_correcao_fuvest';
                                }
                            }else{
                                //realizar insert -> realizar update do status corrigida
                                $sql_insert_fuvest = "INSERT INTO correcao_fuvest(id_redacao, criterio_a, criterio_b, criterio_c, nota_final, comentario)VALUES($id_redacao, $criterio_fuvest_1, $criterio_fuvest_2, $criterio_fuvest_3, $nota_total_fuvest, '$texto_comentario')";
                                if($sql_insert_fuvest_result = mysqli_query($conn, $sql_insert_fuvest)){
                                    echo 'Notas enviadas com sucesso.';
                                    $sql_update_status_correcao_fuvest = "UPDATE redacoes_escritas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_fuvest_result = mysqli_query($conn, $sql_update_status_correcao_fuvest)){
                                        echo 'Status de correção desta redação foram atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro na query $sql_update_status_correcao_fuvest';
                                    }
                                }else{
                                    echo 'Erro ao enviar notas para a base de dados.';
                                }
                            }
                        }else{
                            echo 'Erro na query $sql_select_correcao_fuvest';
                        }
                    }else if($universidade_redacao == 'vunesp'){//INSERT VUNESP
                        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
                        $criterio_vunesp_1 = mysqli_real_escape_string($conn, $_POST['criterio_1_vunesp']);
                        $criterio_vunesp_2 = mysqli_real_escape_string($conn, $_POST['criterio_2_vunesp']);
                        $criterio_vunesp_3 = mysqli_real_escape_string($conn, $_POST['criterio_3_vunesp']);
                        $nota_total_vunesp = mysqli_real_escape_string($conn, $_POST['nota_total_vunesp']);
                        $texto_comentario = mysqli_real_escape_string($conn, $_POST['texto_comentario']);
    
    
                        //verificar se não existe uma correção desta redação na base de dados
                        $sql_select_correcao_vunesp = "SELECT * FROM correcao_vunesp WHERE id_redacao = $id_redacao";
                        if($sql_select_correcao_vunesp_result = mysqli_query($conn, $sql_select_correcao_vunesp)){
                            $row_correcao_vunesp = mysqli_num_rows($sql_select_correcao_vunesp_result);
                            if($row_correcao_vunesp == 1){
                                //realizar update
                                $sql_update_correcao_vunesp = "UPDATE correcao_vunesp SET criterio_a = $criterio_vunesp_1, criterio_b = $criterio_vunesp_2, criterio_c = $criterio_vunesp_3, nota_final = $nota_total_vunesp, comentario = '$texto_comentario' WHERE id_redacao = $id_redacao";
                                if($sql_update_correcao_vunesp_result = mysqli_query($conn, $sql_update_correcao_vunesp)){
                                    echo 'Dados de correção desta redação foram atualizados com sucesso.';
                                    $sql_update_status_correcao_vunesp = "UPDATE redacoes_escritas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_vunesp_result = mysqli_query($conn, $sql_update_status_correcao_vunesp)){
                                        echo 'Status de correção atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro ao atualizar o status de correção desta redação.';
                                    }
                                }else{
                                    echo 'Falha ao atualizar os dados de correção desta redação';
                                }
                            }else{
                                //realiza insert -> realiza o update do status de correção desta redação
                                $sql_insert_vunesp = "INSERT INTO correcao_vunesp(id_redacao, criterio_a, criterio_b, criterio_c, nota_final, comentario)VALUES($id_redacao, $criterio_vunesp_1, $criterio_vunesp_2, $criterio_vunesp_3, $nota_total_vunesp, '$texto_comentario')";
                                if($sql_insert_vunesp_result = mysqli_query($conn, $sql_insert_vunesp)){
                                    echo 'Notas enviadas com sucesso.';
                                    $sql_update_status_correcao_vunesp = "UPDATE redacoes_escritas SET status_corrigida = 1 WHERE id_red = $id_redacao";
                                    if($sql_update_status_correcao_vunesp_result = mysqli_query($conn, $sql_update_status_correcao_vunesp)){
                                        echo 'Status de correção atualizados com sucesso.';
                                        header('Location: ./minhas_correcoes.php');
                                    }else{
                                        echo 'Erro ao atualizar o status de correção desta redação.';
                                    }
                                }else{
                                    echo 'Erro ao enviar notas para a base de dados.';
                                }
                            }
                        }else{
                            echo 'Erro na query $sql_select_correcao_vunesp';
                        }
                    }
                }else{
                    echo 'Nenhuma universidade selecionada.';
                    header('Location: ./minhas_correcoes.php');
            }
            }else{
                echo 'Falha ao pegar o tipo da redação.';
            }

    }
?>