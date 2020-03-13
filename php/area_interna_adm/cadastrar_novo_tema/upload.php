<?php
    session_start();
    if(!isset($_SESSION['email_adm'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../../connection.php';

        $id_tema = 0;

        function retiraAcentos($string){//FUNÇÃO RETIRADA DA INTERNET
            $acentos  =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ:?\/*|<>';
            $sem_acentos  =  'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------';
            $string = strtr($string, utf8_decode($acentos), $sem_acentos);
            $string = str_replace(" ","-",$string);
            return utf8_decode($string);
        }

        if(isset($_POST['titulo_tema']) && isset($_POST['modelo'])){
            $titulo_tema = mysqli_real_escape_string($conn, $_POST['titulo_tema']);
            $universidade = mysqli_real_escape_string($conn, $_POST['modelo']);

            $titulo_tema_sem_acento = retiraAcentos(utf8_decode($titulo_tema));
            $nome_arquivo_tema = $_FILES['arquivo_tema']['name'];
            $nome_arquivo_tema_sem_acento = retiraAcentos(utf8_decode($nome_arquivo_tema));
            $extensao = strtolower(substr($_FILES['arquivo_tema']['name'], -4));
            echo 'Extensão: '.$extensao;
            //echo $nome_arquivo_tema;
            $diretorio = "arquivo_temas/";
            $new_name;
            
            $sql_select_id_tema = "SELECT * FROM temas_redacao";
            $sql_select_id_tema_result = mysqli_query($conn, $sql_select_id_tema);
            if($sql_select_id_tema_result){ 
                $row = mysqli_num_rows($sql_select_id_tema_result);
                if($row == 0){
                    //echo 'Título: '.$titulo_tema.'<br>Título sem acento: '.$titulo_tema_sem_acento.'<br>Universidade: '.$universidade.'<br>Nome arquivo tema: '.$nome_arquivo_tema;
                    $new_name = "tema_1_".$universidade.$extensao;
                    $sql_insert_tema = "INSERT INTO temas_redacao(nome_tema, nome_tema_sem_acento, modelo_tema, caminho_arquivo_tema)VALUES('$titulo_tema', '$titulo_tema_sem_acento', '$universidade', '$diretorio$new_name')";
                    $sql_insert_tema_result = mysqli_query($conn, $sql_insert_tema);
                    if($sql_insert_tema_result){
                        echo 'Tema cadastrado com sucesso.';
                        if(move_uploaded_file($_FILES['arquivo_tema']['tmp_name'], $diretorio.$new_name)){
                            echo 'Upload realizado com sucesso.';
                            header('Location: ./temas_cadastrados.php');
                        }else{
                            echo 'Falha ao realizar o upload do arquivo.';
                        }

                        //REDIRECIONAR PARA PÁGINA QUE MOSTRA TODOS OS TEMAS CADASTRADOS
                    }else{
                        echo 'Erro ao inserir novo tema na base de dados. if1';
                    }  
                }else{
                    //echo 'Título: '.$titulo_tema.'<br>Título sem acento: '.$titulo_tema_sem_acento.'<br>Universidade: '.$universidade.'<br>Nome arquivo tema: '.$nome_arquivo_tema;
                    while($row_tema = mysqli_fetch_array($sql_select_id_tema_result)){
                        /*if($row_tema['id_tema'] == null || $row_tema['id_tema'] == 0){
                            $id_tema = 1;
                        }else{
                            $id_tema += 1;
                        }*/
                        $id_tema = $row_tema['id_tema'] + 1;
                    }

                    //echo $id_tema;

                    //echo 'Título: '.$titulo_tema.'<br>Modelo: '.$universidade.'<br>Id do tema: '.$id_tema;
        
                    $diretorio  = "arquivo_temas/";
                    $new_name = "idtema_".$id_tema."_".$universidade.$extensao;
                    //echo 'New name: '.$new_name;
                    $sql_insert_tema = "INSERT INTO temas_redacao(nome_tema, nome_tema_sem_acento, modelo_tema, caminho_arquivo_tema)VALUES('$titulo_tema', '$titulo_tema_sem_acento', '$universidade', '$diretorio$new_name')";
                    $sql_insert_tema_result = mysqli_query($conn, $sql_insert_tema);
                    if($sql_insert_tema_result){
                        echo 'Tema cadastrado com sucesso.';
                        if(move_uploaded_file($_FILES['arquivo_tema']['tmp_name'], $diretorio.$new_name)){
                            echo 'Upload realizado com sucesso.';
                            header('Location: ./temas_cadastrados.php');
                        }else{
                            echo 'Falha ao realizar o upload do arquivo.';
                        }
                    }else{
                        echo 'Erro ao inserir na base de dados. if2';
                    }
                }
            }else{
                echo 'Erro no select';
            }    
       }else{
            echo 'Preencha todos os campos.';
        }
    }
?>