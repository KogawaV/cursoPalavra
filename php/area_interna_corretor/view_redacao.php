<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">


    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
    session_start();
    include './../connection.php';
    if(!isset($_SESSION['email_corretor']) && !isset($_SESSION['id_corretor']) && !isset($_SESSION['nome_corretor'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        echo '<input type="hidden" id="id_corretor" value='.$_SESSION['id_corretor'].'>';
        //variáveis
        $tipo_redacao = mysqli_real_escape_string($conn, $_GET['tipo_redacao']);
        //echo $tipo_redacao;
        $nome_aluno;
        $modelo_redacao = mysqli_real_escape_string($conn, $_GET['modelo_redacao']);
        $texto_redacao;
        $tema_redacao;
        $comentario_redacao;

        /*echo $tipo_redacao;
        echo $modelo_redacao;*/

        $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
        
        //passando o id da redação para o javascrit
        echo '<input type="hidden" value='.$id_redacao.' id="id_redacao">';
        //passando o tipo de redação para o js
        echo "<input type='hidden' value='$tipo_redacao' id='tipo_redacao'>";
        //echo $tipo_redacao;

        $sql_selec_dados_redacao = "SELECT * FROM redacoes_enviadas WHERE id_red = $id_redacao";
        $sql_selec_dados_redacao_result = mysqli_query($conn, $sql_selec_dados_redacao);


        $sql_selec_dados_redacao_escrita = "SELECT * FROM redacoes_escritas WHERE id_red = $id_redacao";
        $sql_selec_dados_redacao_escrita_result = mysqli_query($conn, $sql_selec_dados_redacao_escrita);

        $array_entrada = array("'");
        $array_saida = array("");

        if($sql_selec_dados_redacao_result && $tipo_redacao == 1){//REDAÇÕES QUE FORAM ENVIADAS PELOS ALUNOS
            while($row_redacao = mysqli_fetch_array($sql_selec_dados_redacao_result)){
                $nome_aluno = $row_redacao['nome_aluno'];
                $modelo_redacao = $row_redacao['universidade_redacao']; 
                $tipo_redacao = $row_redacao['tipo_redacao'];
                $tema_redacao = $row_redacao['tema_redacao'];
                $caminho_redacao = mysqli_real_escape_string($conn, $_GET['caminho_red']);

                //passando o modelo da redação para o javascript
                echo '<input type="hidden" value='.$modelo_redacao.' id="modelo_redacao">';

                if(strtolower($modelo_redacao) == 'enem'){
                    echo '
                    <div class="box_1">
                    <div class="painel_redacao_1">
                        <div class="dados_redacao_1">
                            <div class="logo_plataforma"></div>
                        </div>
                        <div class="dados-alunos">
                            <label>Tema</label>
                            <p>'.$tema_redacao.'</p>
                            <label>Aluno</label>
                            <p>'.$nome_aluno.'</p>
                        </div>
                        <iframe src="./'.$caminho_redacao.'" width="950px" height="1200px"></iframe>
                    </div>
            
                    <div class="box-painel-criterios">
                        <div class="painel-logo-criterio">
                            <div class="logo-plataforma"></div>
                        </div>
                        <div class="painel-modo-redacao">
                            <div>
                                <div class="logo_enem"></div>
                                <div>
                                    <h3>Escolha o modo de correção</h3>
                                    <button class="btn" id="btn_vizualizar">Vizualizar</button>
                                    <button class="btn" id="btn_comentar">Comentar</button>
                                    <p id="lbl_modo_redacao"></p>
                                </div>
                            </div>
                        </div>
            
                        <h2>Avaliação da redação</h2>
                            <div class="box-criterio box-criterio-1">
                                <label>I. Demonstrar domínio da norma culta da língua escrita.</label>
                                <select name="criterio_1_enem" id="criterio_1_enem">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 pontos</option>
                                    <option value="40">40 pontos</option>
                                    <option value="80">80 pontos</option>
                                    <option value="120">120 pontos</option>
                                    <option value="160">160 pontos</option>
                                    <option value="200">200 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-2">
                                <label>II. Compreender a proposta de redação e aplicar conceitos das várias áreas do conhecimento para desenvolver o tema, dentro dos limites estruturais do texto dissertativo-argumentativo.</label>
                                <select name="criterio_2_enem" id="criterio_2_enem">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 pontos</option>
                                    <option value="40">40 pontos</option>
                                    <option value="80">80 pontos</option>
                                    <option value="120">120 pontos</option>
                                    <option value="160">160 pontos</option>
                                    <option value="200">200 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-3">
                                <label>III. . Selecionar, relacionar, organizar e interpretar informações, fatos, opiniões e argumentos em defesa de um ponto de vista.</label>
                                <select name="criterio_3_enem" id="criterio_3_enem">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 pontos</option>
                                    <option value="40">40 pontos</option>
                                    <option value="80">80 pontos</option>
                                    <option value="120">120 pontos</option>
                                    <option value="160">160 pontos</option>
                                    <option value="200">200 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-4">
                                <label>IV. Demonstrar conhecimento dos mecanismos linguísticos necessários para a construção da argumentação.</label>
                                <select name="criterio_4_enem" id="criterio_4_enem">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 pontos</option>
                                    <option value="40">40 pontos</option>
                                    <option value="80">80 pontos</option>
                                    <option value="120">120 pontos</option>
                                    <option value="160">160 pontos</option>
                                    <option value="200">200 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-5">
                                <label>V. Elaborar proposta de intervenção para o problema abordado, demonstrando respeito aos direitos humanos.</label>
                                <select name="criterio_5_enem" id="criterio_5_enem">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 pontos</option>
                                    <option value="40">40 pontos</option>
                                    <option value="80">80 pontos</option>
                                    <option value="120">120 pontos</option>
                                    <option value="160">160 pontos</option>
                                    <option value="200">200 pontos</option>
                                </select>
                            </div>
                            <div class="painel-nota-total">
                                <p>Nota Final</p><input type="text" name="nota_total_enem" id="nota_total_enem">
                            </div>
            
                            <!-- PAINEL ONDE OS COMETÁRIOS FICARAM ARMAZENADOS -->
                            <div class="painel-comentario" id="painel-comentario">
                                <label>Trecho da redação a ser comentado</label>
                                <div id="trecho_redacao"></div>
                                <label>Comentário</label>
                                    <textarea name="texto_comentario" id="texto_comentario"></textarea>
                                    <button class="btn btn-comentar" id="btn_adicionar_comentario"><a href="#">Comentar</a></button>
                            </div>
                            
                            
                            <div class="painel-btn">
                                <button class="btn btn-comentar" id="btn_salvar_comentario"><a href="#">Salvar Comentário</a></button>
                                <button class="btn btn-cancelar"><a href="#">Cancelar</a></button>
                                <!-- <button id="enviar_comentarios">Enviar comentários</button> -->
                                <button class="btn btn-finalizar-correcao" id="finalizar_correcao">Finalizar Correção</button>
                                <!-- <div id="string_jason"></div> -->
                            </div>
                    </div>';
                }else if(strtolower($modelo_redacao) == 'fuvest'){
                    echo '
                    <div class="box_1">
                    <div class="painel_redacao_1">
                        <div class="dados_redacao_1">
                            <div class="logo_plataforma"></div>
                        </div>
                        <div class="dados-alunos">
                            <label>Tema</label>
                            <p>'.$tema_redacao.'</p>
                            <label>Aluno</label>
                            <p>'.$nome_aluno.'</p>
                        </div>
                        <iframe src="./'.$caminho_redacao.'" width="950px" height="1200px"></iframe>
                        </div>
            
                    <div class="box-painel-criterios">
                        <div class="painel-logo-criterio">
                            <div class="logo-plataforma"></div>
                        </div>
                        <div class="painel-modo-redacao">
                            <div>
                                <div class="logo_fuvest"></div>
                                <div>
                                    <h3>Escolha o modo de correção</h3>
                                    <button class="btn" id="btn_vizualizar">Vizualizar</button>
                                    <button class="btn" id="btn_comentar">Comentar</button>
                                    <p id="lbl_modo_redacao"></p>
                                </div>
                            </div>
                        </div>
            
                        <h2>Avaliação da redação</h2>
                            <div class="box-criterio box-criterio-1">
                            <label>A. Proposta e Abordagem do Tema.</label> 
                                <select name="criterio_1_fuvest" id="criterio_1_fuvest">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 ponto</option>
                                    <option value="1">1 ponto</option>
                                    <option value="2">2 pontos</option>
                                    <option value="3">3 pontos</option>
                                    <option value="4">4 pontos</option>
                                    <option value="5">5 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-2">
                                <label>B. Gênero / Tipo de Texto e Coerência.</label>
                                <select name="criterio_2_fuvest" id="criterio_2_fuvest">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 ponto</option>
                                    <option value="1">1 ponto</option>
                                    <option value="2">2 pontos</option>
                                    <option value="3">3 pontos</option>
                                    <option value="4">4 pontos</option>
                                    <option value="5">5 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-3">
                                <label>C. Elementos Linguísticos (Modalidade e Coesão).</label>
                                <select name="criterio_3_fuvest" id="criterio_3_fuvest">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 ponto</option>
                                    <option value="1">1 ponto</option>
                                    <option value="2">2 pontos</option>
                                    <option value="3">3 pontos</option>
                                    <option value="4">4 pontos</option>
                                    <option value="5">5 pontos</option>
                                </select>
                            </div>
                            <div class="painel-nota-total">
                                <p>Nota Final</p><input type="text" name="nota_total_fuvest" id="nota_total_fuvest">
                            </div>
            
                            <!-- PAINEL ONDE OS COMETÁRIOS FICARAM ARMAZENADOS -->
                            <div class="painel-comentario" id="painel-comentario">
                                <label>Trecho da redação a ser comentado</label>
                                <div id="trecho_redacao"></div>
                                <label>Comentário</label>
                                    <textarea name="texto_comentario" id="texto_comentario"></textarea>
                                    <button class="btn btn-comentar" id="btn_adicionar_comentario"><a href="#">Comentar</a></button>
                            </div>
                            
                            
                            <div class="painel-btn">
                                <button class="btn btn-comentar" id="btn_salvar_comentario"><a href="#">Salvar Comentário</a></button>
                                <button class="btn btn-cancelar"><a href="#">Cancelar</a></button>
                                <!-- <button id="enviar_comentarios">Enviar comentários</button> -->
                                <button class="btn btn-finalizar-correcao" id="finalizar_correcao">Finalizar Correção</button>
                                <!-- <div id="string_jason"></div> -->
                            </div>
                    </div>
                    ';
                }else if(strtolower($modelo_redacao) == 'unicamp'){
                    echo '
                            
                    <div class="box_1">
                    <div class="painel_redacao_1">
                        <div class="dados_redacao_1">
                            <div class="logo_plataforma"></div>
                        </div>
                        <div class="dados-alunos">
                            <label>Tema</label>
                            <p>'.$tema_redacao.'</p>
                            <label>Aluno</label>
                            <p>'.$nome_aluno.'</p>
                        </div>
                        <iframe src="./'.$caminho_redacao.'" width="950px" height="1200px"></iframe>
                        </div>
            
                    <div class="box-painel-criterios">
                        <div class="painel-logo-criterio">
                            <div class="logo-plataforma"></div>
                        </div>
                        <div class="painel-modo-redacao">
                            <div>
                                <div class="logo_unicamp"></div>
                                <div>
                                    <h3>Escolha o modo de correção</h3>
                                    <button class="btn" id="btn_vizualizar">Vizualizar</button>
                                    <button class="btn" id="btn_comentar">Comentar</button>
                                    <p id="lbl_modo_redacao"></p>
                                </div>
                            </div>
                        </div>
            
                        <h2>Avaliação da redação</h2>
                            <div class="box-criterio box-criterio-1">
                                <label>I. Proposta Temática (PT).</label>
                                <select name="criterio_1_unicamp" id="criterio_1_unicamp">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 ponto</option>
                                    <option value="1">1 ponto</option>
                                    <option value="2">2 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-2">
                                <label>II. Gênero (G).</label>
                                <select name="criterio_2_unicamp" id="criterio_2_unicamp">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 ponto</option>
                                    <option value="1">1 ponto</option>
                                    <option value="2">2 pontos</option>
                                    <option value="3">3 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-3" id="criterio_3_unicamp">
                                <label>III. Leitura dos Textos da Prova (LT).</label>
                                <select name="criterio_3_unicamp">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 ponto</option>
                                    <option value="1">1 ponto</option>
                                    <option value="2">2 pontos</option>
                                    <option value="3">3 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-4" id="criterio_4_unicamp">
                                <label>IV. Leitura dos Textos da Prova (LT).</label>
                                <select name="criterio_4_unicamp">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 ponto</option>
                                    <option value="1">1 ponto</option>
                                    <option value="2">2 pontos</option>
                                    <option value="3">3 pontos</option>
                                    <option value="4">4 pontos</option>
                                </select>
                            </div>
                            <div class="painel-nota-total">
                                <p>Nota Final</p><input type="text" name="nota_total_unicamp" id="nota_total_unicamp">
                            </div>
            
                            <!-- PAINEL ONDE OS COMETÁRIOS FICARAM ARMAZENADOS -->
                            <div class="painel-comentario" id="painel-comentario">
                                <label>Trecho da redação a ser comentado</label>
                                <div id="trecho_redacao"></div>
                                <label>Comentário</label>
                                    <textarea name="texto_comentario" id="texto_comentario"></textarea>
                                    <button class="btn btn-comentar" id="btn_adicionar_comentario"><a href="#">Comentar</a></button>
                            </div>
                            
                            
                            <div class="painel-btn">
                                <button class="btn btn-comentar" id="btn_salvar_comentario"><a href="#">Salvar Comentário</a></button>
                                <button class="btn btn-cancelar"><a href="#">Cancelar</a></button>
                                <!-- <button id="enviar_comentarios">Enviar comentários</button> -->
                                <button class="btn btn-finalizar-correcao" id="finalizar_correcao">Finalizar Correção</button>
                                <!-- <div id="string_jason"></div> -->
                            </div>
                    </div>
                    ';
                }else if(strtolower($modelo_redacao) == 'vunesp'){
                    echo '
                    <div class="box_1">
                    <div class="painel_redacao_1">
                        <div class="dados_redacao_1">
                            <div class="logo_plataforma"></div>
                        </div>
                        <div class="dados-alunos">
                            <label>Tema</label>
                            <p>'.$tema_redacao.'</p>
                            <label>Aluno</label>
                            <p>'.$nome_aluno.'</p>
                        </div>
                        <iframe src="./'.$caminho_redacao.'" width="950px" height="1200px"></iframe>
                        </div>
            
                    <div class="box-painel-criterios">
                        <div class="painel-logo-criterio">
                            <div class="logo-plataforma"></div>
                        </div>
                        <div class="painel-modo-redacao">
                            <div>
                                <div class="logo_vunesp"></div>
                                <div>
                                    <h3>Escolha o modo de correção</h3>
                                    <button class="btn" id="btn_vizualizar">Vizualizar</button>
                                    <button class="btn" id="btn_comentar">Comentar</button>
                                    <p id="lbl_modo_redacao"></p>
                                </div>
                            </div>
                        </div>
            
                        <h2>Avaliação da redação</h2>
                            <div class="box-criterio box-criterio-1">
                                <label>A. Tipo de texto e abordagem do tema.</label>
                                <select name="criterio_1_vunesp" id="criterio_1_vunesp">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 ponto</option>
                                    <option value="1">1 ponto</option>
                                    <option value="2">2 pontos</option>
                                    <option value="3">3 pontos</option>
                                    <option value="4">4 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-2" id="criterio_2_vunesp">
                                <label>B. Estrutura</label>
                                <select name="criterio_2_vunesp">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 ponto</option>
                                    <option value="1">1 ponto</option>
                                    <option value="2">2 pontos</option>
                                    <option value="3">3 pontos</option>
                                </select>
                            </div>
                            <div class="box-criterio box-criterio-3" id="criterio_3_vunesp">
                                <label>C. Expressão</label>
                                <select name="criterio_3_vunesp">
                                    <option value="">Selecione uma pontuação</option>
                                    <option value="0">0 ponto</option>
                                    <option value="1">1 ponto</option>
                                    <option value="2">2 pontos</option>
                                    <option value="3">3 pontos</option>
                                </select>
                            </div>
                            <div class="painel-nota-total">
                                <p>Nota Final</p><input type="text" name="nota_total_vunesp" id="nota_total_vunesp">
                            </div>
            
                            <!-- PAINEL ONDE OS COMETÁRIOS FICARAM ARMAZENADOS -->
                            <div class="painel-comentario" id="painel-comentario">
                                <label>Trecho da redação a ser comentado</label>
                                <div id="trecho_redacao"></div>
                                <label>Comentário</label>
                                    <textarea name="texto_comentario" id="texto_comentario"></textarea>
                                    <button class="btn btn-comentar" id="btn_adicionar_comentario"><a href="#">Comentar</a></button>
                            </div>
                            
                            
                            <div class="painel-btn">
                                <button class="btn btn-comentar" id="btn_salvar_comentario"><a href="#">Salvar Comentário</a></button>
                                <button class="btn btn-cancelar"><a href="#">Cancelar</a></button>
                                <!-- <button id="enviar_comentarios">Enviar comentários</button> -->
                                <button class="btn btn-finalizar-correcao" id="finalizar_correcao">Finalizar Correção</button>
                                <!-- <div id="string_jason"></div> -->
                            </div>
                    </div>';
                }
            }
        }else if($sql_selec_dados_redacao_escrita_result && $tipo_redacao == 2){//AQUI VEM AS REDAÇÕES QUE FORAM ESCRITAS PELOS ALUNOS
            while($row_redacao_escrita = mysqli_fetch_array($sql_selec_dados_redacao_escrita_result)){
                $nome_aluno = $row_redacao_escrita['nome_aluno'];
                $modelo_redacao = $row_redacao_escrita['universidade_redacao']; 
                $tipo_redacao = $row_redacao_escrita['tipo_redacao'];
                $tema_redacao = $row_redacao_escrita['tema_redacao'];
                $texto_redacao = str_replace($array_entrada, $array_saida, $row_redacao_escrita['texto_redacao_escrita']);

                //$texto_redacao_sem_caracteres_especiais = str_replace($array_entrada, $array_saida, $texto_redacao);

                //passando o modelo da redação para o javascript
                echo '<input type="hidden" value='.$modelo_redacao.' id="modelo_redacao">';
                echo '<input type="hidden" value='.$row_redacao_escrita['id_aluno_redacao'].' id="id_aluno">';

                if(strtolower($modelo_redacao) == 'enem'){
                    echo '
                    <div class="painel-redacao">
                        <div class="redacao">
                            <div id="redacao" class="container-redacao" style="padding: 10px; text-align: justify; word-spacing: 5px; line-height: 25px;">'.nl2br($texto_redacao).'</div>
                        </div>
                        
                        <div class="navegacao">
                            <nav class="nav_tabs">
                                <ul>
                                    <li>
                                        <input type="radio" name="rb_btn" id="rb_comentarios" class="rd_tab" checked>
                                        <label for="rb_comentarios" class="tab_label" id="lbl-comentario">Comentários</label>
                                        <div class="tab-content">


                                        <button id="btn-verde" class="btn btn-verde"><i class="fas fa-marker"></i></button>
                                        <button id="btn-vermelho" class="btn btn-vermelho"><i class="fas fa-marker"></i></button>
                                        <div id="cor-selecionada"></div>

                                        <div class="card-comentarios" id="painelComentarios">
                                            <div class="card-comentario" id="card-comentario">
                                                <textarea name="comentario_corretor"></textarea>
                                                <div>
                                                    <button class="btnComentar">Comentar</button>
                                                    <button class="btnExcluirComentario" style="display: none;">Excluir</button>
                                                    <span id="msgStatus" style="color: #F2A205;">Clique em "Comentar" para salvar está observação.</span>
                                                </div>
                                            </div>
                                        </div>



                                        </div>
                                    </li>

                                    <li>
                                        <input type="radio" name="rb_btn" id="rb_criterios" class="rd_tab">
                                        <label for="rb_criterios" class="tab_label" id="lbl-criterios-avaliacao">Avaliação Dos Critérios</label>
                                        <div class="tab-content">
                                            
                                            <div>
                                                <label>I. Demonstrar domínio da norma culta da língua escrita.</label>
                                                <select name="criterio_1_enem" id="criterio_1_enem">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 pontos</option>
                                                    <option value="40">40 pontos</option>
                                                    <option value="80">80 pontos</option>
                                                    <option value="120">120 pontos</option>
                                                    <option value="160">160 pontos</option>
                                                    <option value="200">200 pontos</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label>II. Compreender a proposta de redação e aplicar conceitos das várias áreas do conhecimento para desenvolver o tema, dentro dos limites estruturais do texto dissertativo-argumentativo.</label>
                                                <select name="criterio_2_enem" id="criterio_2_enem">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 pontos</option>
                                                    <option value="40">40 pontos</option>
                                                    <option value="80">80 pontos</option>
                                                    <option value="120">120 pontos</option>
                                                    <option value="160">160 pontos</option>
                                                    <option value="200">200 pontos</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label>III. . Selecionar, relacionar, organizar e interpretar informações, fatos, opiniões e argumentos em defesa de um ponto de vista.</label>
                                                <select name="criterio_3_enem" id="criterio_3_enem">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 pontos</option>
                                                    <option value="40">40 pontos</option>
                                                    <option value="80">80 pontos</option>
                                                    <option value="120">120 pontos</option>
                                                    <option value="160">160 pontos</option>
                                                    <option value="200">200 pontos</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label>IV. Demonstrar conhecimento dos mecanismos linguísticos necessários para a construção da argumentação.</label>
                                                <select name="criterio_4_enem" id="criterio_4_enem">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 pontos</option>
                                                    <option value="40">40 pontos</option>
                                                    <option value="80">80 pontos</option>
                                                    <option value="120">120 pontos</option>
                                                    <option value="160">160 pontos</option>
                                                    <option value="200">200 pontos</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label>V. Elaborar proposta de intervenção para o problema abordado, demonstrando respeito aos direitos humanos.</label>
                                                <select name="criterio_5_enem" id="criterio_5_enem">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 pontos</option>
                                                    <option value="40">40 pontos</option>
                                                    <option value="80">80 pontos</option>
                                                    <option value="120">120 pontos</option>
                                                    <option value="160">160 pontos</option>
                                                    <option value="200">200 pontos</option>
                                                </select>
                                            </div>

                                            <div class="painel-nota-total">
                                                <p>Nota Final</p><input type="text" name="nota_total_enem" id="nota_total_enem">
                                            </div>

                                            <div class="comentario-final">
                                                <h2>Conclusão Geral Sobre a Redação</h2>
                                                <textarea name="comentario_final" class="comentario_final" id="comentario_final"></textarea>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <button id="btnFinalizar" style="width: 50%; margin: 10px; padding: 10px;">Finalizar Correção</button>';
                }else if(strtolower($modelo_redacao) == 'fuvest'){
                    echo '
                        <div class="painel-redacao">
                            <div class="redacao">
                                <div id="redacao" class="container-redacao" style="padding: 10px; text-align: justify; word-spacing: 5px; line-height: 25px;">'.nl2br($texto_redacao).'</div>
                            </div>
                            
                            <div class="navegacao">
                                <nav class="nav_tabs">
                                    <ul>
                                        <li>
                                            <input type="radio" name="rb_btn" id="rb_comentarios" class="rd_tab" checked>
                                            <label for="rb_comentarios" class="tab_label" id="lbl-comentario">Comentários</label>
                                            <div class="tab-content">
                                                
                                            <button id="btn-verde" class="btn btn-verde"><i class="fas fa-marker"></i></button>
                                            <button id="btn-vermelho" class="btn btn-vermelho"><i class="fas fa-marker"></i></button>
                                            <div id="cor-selecionada"></div>

                                            <div class="card-comentarios" id="painelComentarios">
                                                <div class="card-comentario" id="card-comentario">
                                                    <textarea name="comentario_corretor"></textarea>
                                                    <div>
                                                        <button class="btnComentar">Comentar</button>
                                                        <button class="btnExcluirComentario" style="display: none;">Excluir</button>
                                                        <span id="msgStatus" style="color: #F2A205;">Clique em "Comentar" para salvar está observação.</span>
                                                    </div>
                                                </div>
                                            </div>

                                            </div>
                                        </li>

                                        <li>
                                            <input type="radio" name="rb_btn" id="rb_criterios" class="rd_tab">
                                            <label for="rb_criterios" class="tab_label" id="lbl-criterios-avaliacao">Avaliação Dos Critérios</label>
                                            <div class="tab-content">
                                                <div>
                                                    <label>A. Proposta e Abordagem do Tema.</label> 
                                                    <select name="criterio_1_fuvest" id="criterio_1_fuvest">
                                                        <option value="">Selecione uma pontuação</option>
                                                        <option value="0">0 ponto</option>
                                                        <option value="1">1 ponto</option>
                                                        <option value="2">2 pontos</option>
                                                        <option value="3">3 pontos</option>
                                                        <option value="4">4 pontos</option>
                                                        <option value="5">5 pontos</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label>B. Gênero / Tipo de Texto e Coerência.</label>
                                                    <select name="criterio_2_fuvest" id="criterio_2_fuvest">
                                                        <option value="">Selecione uma pontuação</option>
                                                        <option value="0">0 ponto</option>
                                                        <option value="1">1 ponto</option>
                                                        <option value="2">2 pontos</option>
                                                        <option value="3">3 pontos</option>
                                                        <option value="4">4 pontos</option>
                                                        <option value="5">5 pontos</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label>C. Elementos Linguísticos (Modalidade e Coesão).</label>
                                                    <select name="criterio_3_fuvest" id="criterio_3_fuvest">
                                                        <option value="">Selecione uma pontuação</option>
                                                        <option value="0">0 ponto</option>
                                                        <option value="1">1 ponto</option>
                                                        <option value="2">2 pontos</option>
                                                        <option value="3">3 pontos</option>
                                                        <option value="4">4 pontos</option>
                                                        <option value="5">5 pontos</option>
                                                    </select>
                                                </div>
                                                <div class="painel-nota-total">
                                                    <p>Nota Final</p><input type="text" name="nota_total_fuvest" id="nota_total_fuvest">
                                                </div>

                                                <div class="comentario-final">
                                                    <h2>Conclusão Geral Sobre a Redação</h2>
                                                    <textarea name="comentario_final" class="comentario_final" id="comentario_final"></textarea>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <button id="btnFinalizar" class="btn btn-finalizar-correcao" style="width: 50%; margin: 10px; padding: 5px;">Finalizar Correção</button>';
                }else if(strtolower($modelo_redacao) == 'unicamp'){
                    echo '
                    <div class="painel-redacao">
                        <div class="redacao">
                            <div id="redacao" class="container-redacao" style="padding: 10px; text-align: justify; word-spacing: 5px; line-height: 25px;">'.nl2br($texto_redacao).'</div>
                        </div>
                        
                        <div class="navegacao">
                            <nav class="nav_tabs">
                                <ul>
                                    <li>
                                        <input type="radio" name="rb_btn" id="rb_comentarios" class="rd_tab" checked>
                                        <label for="rb_comentarios" class="tab_label" id="lbl-comentario">Comentários</label>
                                        <div class="tab-content">
                                            <button id="btn-verde" class="btn btn-verde"><i class="fas fa-marker"></i></button>
                                            <button id="btn-vermelho" class="btn btn-vermelho"><i class="fas fa-marker"></i></button>
                                            <div id="cor-selecionada"></div>

                                            <div class="card-comentarios" id="painelComentarios">
                                                <div class="card-comentario" id="card-comentario">
                                                    <textarea name="comentario_corretor"></textarea>
                                                    <div>
                                                        <button class="btnComentar">Comentar</button>
                                                        <button class="btnExcluirComentario" style="display: none;">Excluir</button>
                                                        <span id="msgStatus" style="color: #F2A205;">Clique em "Comentar" para salvar está observação.</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>

                                    <li>
                                        <input type="radio" name="rb_btn" id="rb_criterios" class="rd_tab">
                                        <label for="rb_criterios" class="tab_label" id="lbl-criterios-avaliacao">Avaliação Dos Critérios</label>
                                        <div class="tab-content">
                                            
                                            <div class="box-criterio box-criterio-1">
                                            <label>I. Proposta Temática (PT).</label>
                                            <select name="criterio_1_unicamp" id="criterio_1_unicamp">
                                                <option value="">Selecione uma pontuação</option>
                                                <option value="0">0 ponto</option>
                                                <option value="1">1 ponto</option>
                                                <option value="2">2 pontos</option>
                                            </select>
                                            </div>
                                            <div class="box-criterio box-criterio-2">
                                                <label>II. Gênero (G).</label>
                                                <select name="criterio_2_unicamp" id="criterio_2_unicamp">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 ponto</option>
                                                    <option value="1">1 ponto</option>
                                                    <option value="2">2 pontos</option>
                                                    <option value="3">3 pontos</option>
                                                </select>
                                            </div>
                                            <div class="box-criterio box-criterio-3">
                                                <label>III. Leitura dos Textos da Prova (LT).</label>
                                                <select name="criterio_3_unicamp" id="criterio_3_unicamp">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 ponto</option>
                                                    <option value="1">1 ponto</option>
                                                    <option value="2">2 pontos</option>
                                                    <option value="3">3 pontos</option>
                                                </select>
                                            </div>
                                            <div class="box-criterio box-criterio-4">
                                                <label>IV. Leitura dos Textos da Prova (LT).</label>
                                                <select name="criterio_4_unicamp" id="criterio_4_unicamp">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 ponto</option>
                                                    <option value="1">1 ponto</option>
                                                    <option value="2">2 pontos</option>
                                                    <option value="3">3 pontos</option>
                                                    <option value="4">4 pontos</option>
                                                </select>
                                            </div>
                                            <div class="painel-nota-total">
                                                <p>Nota Final</p><input type="text" name="nota_total_unicamp" id="nota_total_unicamp">
                                            </div>

                                            <div class="comentario-final">
                                                <h2>Conclusão Geral Sobre a Redação</h2>
                                                <textarea name="comentario_final" class="comentario_final" id="comentario_final"></textarea>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <button id="btnFinalizar" style="width: 200px; margin: 10px; padding: 10px; border-radius: 3px; border: none; background-color: #41B4F5; color: #ffffff; font-weight: bold;">Finalizar Correção</button>';
                }else if(strtolower($modelo_redacao) == 'vunesp'){
                    echo '
                    <div class="painel-redacao">
                        <div class="redacao">
                            <div id="redacao" class="container-redacao" style="padding: 10px; text-align: justify; word-spacing: 5px; line-height: 25px;">'.nl2br($texto_redacao).'</div>
                        </div>
                        
                        <div class="navegacao">
                            <nav class="nav_tabs">
                                <ul>
                                    <li>
                                        <input type="radio" name="rb_btn" id="rb_comentarios" class="rd_tab" checked>
                                        <label for="rb_comentarios" class="tab_label" id="lbl-comentario">Comentários</label>
                                        <div class="tab-content">
                                            <button id="btn-verde" class="btn btn-verde"><i class="fas fa-marker"></i></button>
                                            <button id="btn-vermelho" class="btn btn-vermelho"><i class="fas fa-marker"></i></button>
                                            <div id="cor-selecionada"></div>

                                            <div class="card-comentarios" id="painelComentarios">
                                                <div class="card-comentario" id="card-comentario">
                                                    <textarea name="comentario_corretor"></textarea>
                                                    <div>
                                                        <button class="btnComentar">Comentar</button>
                                                        <button class="btnExcluirComentario" style="display: none;">Excluir</button>
                                                        <span id="msgStatus" style="color: #F2A205;">Clique em "Comentar" para salvar está observação.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <input type="radio" name="rb_btn" id="rb_criterios" class="rd_tab">
                                        <label for="rb_criterios" class="tab_label" id="lbl-criterios-avaliacao">Avaliação Dos Critérios</label>
                                        <div class="tab-content">
                                            
                                            <div class="box-criterio box-criterio-1">
                                                <label>A. Tipo de texto e abordagem do tema.</label>
                                                <select name="criterio_1_vunesp" id="criterio_1_vunesp">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 ponto</option>
                                                    <option value="1">1 ponto</option>
                                                    <option value="2">2 pontos</option>
                                                    <option value="3">3 pontos</option>
                                                    <option value="4">4 pontos</option>
                                                </select>
                                            </div>

                                            <div class="box-criterio box-criterio-2">
                                                <label>B. Estrutura</label>
                                                <select name="criterio_2_vunesp" id="criterio_2_vunesp">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 ponto</option>
                                                    <option value="1">1 ponto</option>
                                                    <option value="2">2 pontos</option>
                                                    <option value="3">3 pontos</option>
                                                </select>
                                            </div>

                                            <div class="box-criterio box-criterio-3">
                                                <label>C. Expressão</label>
                                                <select name="criterio_3_vunesp" id="criterio_3_vunesp">
                                                    <option value="">Selecione uma pontuação</option>
                                                    <option value="0">0 ponto</option>
                                                    <option value="1">1 ponto</option>
                                                    <option value="2">2 pontos</option>
                                                    <option value="3">3 pontos</option>
                                                </select>
                                            </div>
                                            
                                            <div class="painel-nota-total">
                                                <p>Nota Final</p><input type="text" name="nota_total_vunesp" id="nota_total_vunesp">
                                            </div>

                                            <div class="comentario-final">
                                                <h2>Conclusão Geral Sobre a Redação</h2>
                                                <textarea name="comentario_final" class="comentario_final" id="comentario_final"></textarea>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <button id="btnFinalizar" class="btn btn-finalizar-correcao" style="width: 50%; margin: 10px; padding: 5px;">Finalizar Correção</button>';
                }
            }
        }else{
            echo 'Erro ao selecionar dados das redações.';
        }
    }
?>

<!------------------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------ PREENCHER A NOTA TOTAL DO ENEM AUTOMATICAMENTE ------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------->
<script>
    $(document).ready(function(){
        $("#criterio_1_enem, #criterio_2_enem, #criterio_3_enem, #criterio_4_enem, #criterio_5_enem").change(function(){

            var n1 = 0, n2 = 0, n3 = 0, n4 = 0, n5 = 0;
            n1 = $("#criterio_1_enem").val();
            n2 = $("#criterio_2_enem").val();
            n3 = $("#criterio_3_enem").val();
            n4 = $("#criterio_4_enem").val();
            n5 = $("#criterio_5_enem").val();
            
            $.ajax({
                url: "soma_nota_enem.php?n1="+n1+"&n2="+n2+"&n3="+n3+"&n4="+n4+"&n5="+n5, 
                success: function(result){
                    $("#nota_total_enem").val(result);
                }
            });
        });
    });
</script>

<!------------------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------ PREENCHER A NOTA TOTAL DA UNICAMP AUTOMATICAMENTE ---------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------->
<script>
    $(document).ready(function(){
        $("#criterio_1_unicamp, #criterio_2_unicamp, #criterio_3_unicamp, #criterio_4_unicamp").change(function(){

            var n1 = 0, n2 = 0, n3 = 0, n4 = 0, n5 = 0;
            n1 = $("#criterio_1_unicamp").val();
            n2 = $("#criterio_2_unicamp").val();
            n3 = $("#criterio_3_unicamp").val();
            n4 = $("#criterio_4_unicamp").val();
            
            $.ajax({
                url: "soma_nota_unicamp.php?n1="+n1+"&n2="+n2+"&n3="+n3+"&n4="+n4,
                success: function(result){
                    $("#nota_total_unicamp").val(result);
                }
            });
        });
    });
</script>
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------ PREENCHER A NOTA TOTAL DA FUVEST AUTOMATICAMENTE ----------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------->
<script>
    $(document).ready(function(){
        $("#criterio_1_fuvest, #criterio_2_fuvest, #criterio_3_fuvest").change(function(){

            var n1 = 0, n2 = 0, n3 = 0, n4 = 0, n5 = 0;
            n1 = $("#criterio_1_fuvest").val();
            n2 = $("#criterio_2_fuvest").val();
            n3 = $("#criterio_3_fuvest").val();
            $.ajax({
                url: "./soma_nota_fuvest.php?n1="+n1+"&n2="+n2+"&n3="+n3,
                success: function(result){
                    $("#nota_total_fuvest").val(result);
                }
            });
        });
    });
</script>
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------ PREENCHER A NOTA TOTAL DA UNESP AUTOMATICAMENTE ------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------->
<script>
    $(document).ready(function(){
        $("#criterio_1_vunesp, #criterio_2_vunesp, #criterio_3_vunesp").change(function(){

            var n1 = 0, n2 = 0, n3 = 0, n4 = 0, n5 = 0;
            n1 = $("#criterio_1_vunesp").val();
            n2 = $("#criterio_2_vunesp").val();
            n3 = $("#criterio_3_vunesp").val();
            $.ajax({
                url: "soma_nota_vunesp.php?n1="+n1+"&n2="+n2+"&n3="+n3,
                success: function(result){
                    $("#nota_total_vunesp").val(result);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    var arrayTrechos = [];
    var arrayComentario = [];
    var arrayCorTrechos = [];
    var corSelecionada = document.getElementById('cor-selecionada').style.display = "none";
    var cor = "";
    var qtd = 0;
    var verificacao = false;
    var novoCardComentario;
    var card_comentario = document.getElementById('card-comentario');
    card_comentario.style.display = "none";

    document.getElementById('btn-verde').addEventListener("click", ()=>{
        var userSelection = window.getSelection();

        if(userSelection.toString() != ''){
            document.getElementById('btn-vermelho').disabled = true;
            document.getElementById('btn-verde').disabled = true;

            document.getElementById('btn-verde').style.backgroundColor = "green";
            document.getElementById('btn-verde').children[0].style.color = "white";

            document.getElementById('btn-vermelho').style.backgroundColor = "white";
            document.getElementById('btn-vermelho').children[0].style.color = "red";
            //console.log(corSelecionada.innerHTML);
            cor = "green-mark";

            arrayTrechos.push(userSelection.toString());
            for(var i = 0; i < userSelection.rangeCount; i++) {
                highlightRange(userSelection.getRangeAt(i), cor);
            }

            qtd++;
            novoCardComentario = card_comentario.cloneNode(true);
            novoCardComentario.id = "CardComentario_trecho_"+(qtd);
            novoCardComentario.children[0].id = "textoComentarioCorretor"+(qtd);
            novoCardComentario.children[1].children[0].id = "btnComentar"+(qtd);
            novoCardComentario.children[1].children[2].id = "msgStatus"+(qtd);
            novoCardComentario.children[1].children[1].id = "btnExcluirComentario"+qtd;

            novoCardComentario.style.border = "2px solid #4E7329";

            document.getElementById('painelComentarios').parentNode.insertBefore(novoCardComentario, null);
            novoCardComentario.style.display = "flex";
            novoCardComentario.children[0].focus();

            getComentario(qtd);
        }else{
            alert('Nenhum trecho selecionado.');
        }
    });

    document.getElementById('btn-vermelho').addEventListener("click", ()=>{
        var userSelection = window.getSelection();
        //console.log(userSelection.toString());

        if(userSelection.toString() != ''){
            document.getElementById('btn-vermelho').disabled = true;
            document.getElementById('btn-verde').disabled = true;

            corSelecionada.innerHTML = "VERMELHO selecionado!! Grife um trecho do texto.";
            document.getElementById('btn-vermelho').style.backgroundColor = "red";
            document.getElementById('btn-vermelho').children[0].style.color = "white";

            document.getElementById('btn-verde').style.backgroundColor = "white";
            document.getElementById('btn-verde').children[0].style.color = "green";
            //console.log(corSelecionada.innerHTML);
            cor = "red-mark";

            //chamando a função para grifar o texto
            arrayTrechos.push(userSelection.toString());
            for(var i = 0; i < userSelection.rangeCount; i++) {
                highlightRange(userSelection.getRangeAt(i), cor);
            }

            qtd++;
            novoCardComentario = card_comentario.cloneNode(true);
            novoCardComentario.id = "CardComentario_trecho_"+(qtd);
            novoCardComentario.children[0].id = "textoComentarioCorretor"+(qtd);
            novoCardComentario.children[1].children[0].id = "btnComentar"+(qtd);
            novoCardComentario.children[1].children[2].id = "msgStatus"+(qtd);
            novoCardComentario.children[1].children[1].id = "btnExcluirComentario"+qtd;

            novoCardComentario.style.border = "2px solid #7F1912";

            document.getElementById('painelComentarios').parentNode.insertBefore(novoCardComentario, null);
            novoCardComentario.style.display = "flex";
            novoCardComentario.children[0].focus();

            getComentario(qtd);

        }else{
            alert('Nenhum trecho selecionado.');
        }


    });
 
    function highlightRange(range, color) {
        var newNode = document.createElement("span");
        var corSelecionada = "";

        //console.log(color);

        if(color == 'green-mark'){
            corSelecionada = 'green';
        }else if(color == 'red-mark'){
            corSelecionada = 'red';
        }
        arrayCorTrechos.push(corSelecionada);
        //console.log(cor)
        newNode.setAttribute(
            "class",
            color
        );
        newNode.setAttribute(
            "id",
            "trecho_"+arrayTrechos.length
        );
        newNode.setAttribute(
            "onmouseover",
            "onMouseOverTrecho(this)"
        );
        newNode.setAttribute(
        "onmouseout",
        "onMouseOutTrechos(this)"
        );
        range.surroundContents(newNode);
    }

    function onMouseOverTrecho(x){
        var trechoSelecionado = document.getElementById(x.id);
        if(trechoSelecionado.className == 'green-mark'){
            var cardComentario = document.getElementById('CardComentario_'+trechoSelecionado.id);
            cardComentario.style.backgroundColor = "#4E7329";

        }else if(trechoSelecionado.className == 'red-mark'){
            var cardComentario = document.getElementById('CardComentario_'+trechoSelecionado.id);
            cardComentario.style.backgroundColor = "#FF6055";
        }
    }

    function onMouseOutTrechos(x){
        var trechoSelecionado = document.getElementById(x.id);
        if(trechoSelecionado.className == 'green-mark'){
            var cardComentario = document.getElementById('CardComentario_'+trechoSelecionado.id);
            cardComentario.style.backgroundColor = "#ffffff";
            cardComentario.style.border = "2px solid #4E7329";

        }else if(trechoSelecionado.className == 'red-mark'){
            var cardComentario = document.getElementById('CardComentario_'+trechoSelecionado.id);
            cardComentario.style.backgroundColor = "#ffffff";
            cardComentario.style.border = "2px solid #7F1912";
        }
    }


    document.getElementById('btnFinalizar').addEventListener("click", ()=>{
        if(arrayComentario.lenght == arrayTrechos.lenght){
                var string_obj_jason = JSON.stringify(arrayComentario);
                var string_obj_jason_trechos = JSON.stringify(arrayTrechos);
                var comentario_final = document.getElementById('comentario_final').value;
                var id_corretor = document.getElementById('id_corretor').value;

                var redacaoAlterada = document.getElementById('redacao').innerHTML;
                console.log(redacaoAlterada);

                id_aluno = document.getElementById('id_aluno').value;

                if(modelo_redacao.value == 'Enem'){
                    var n1 = document.getElementById('criterio_1_enem').value;
                    var n2 = document.getElementById('criterio_2_enem').value;
                    var n3 = document.getElementById('criterio_3_enem').value;
                    var n4 = document.getElementById('criterio_4_enem').value;
                    var n5 = document.getElementById('criterio_5_enem').value;
                    var nota_total = document.getElementById('nota_total_enem').value;

                    obj_jason = {"n1": n1, "n2": n2, "n3": n3, "n4": n4, "n5": n5, "nota_total": nota_total, "comentarios": arrayComentario, "trechos": arrayTrechos, "redacao_alterada": redacaoAlterada, "id_aluno": id_aluno, "id_redacao": id_redacao.value, "modelo_redacao": modelo_redacao.value, "comentario_final": comentario_final, "id_corretor": id_corretor, "cores": arrayCorTrechos};
                    json = JSON.stringify(obj_jason);

                    $.ajax({
                        type: 'POST',
                        url: 'salvar_redacao.php',
                        data: {string_json: json},
                        success: ()=>{
                            window.location.href="./minhas_correcoes.php";
                        }
                    });
                }else if(modelo_redacao.value == 'Fuvest'){
                    var n1 = document.getElementById('criterio_1_fuvest').value;
                    var n2 = document.getElementById('criterio_2_fuvest').value;
                    var n3 = document.getElementById('criterio_3_fuvest').value;
                    var nota_total = document.getElementById('nota_total_fuvest').value;

                    obj_jason = {"n1": n1, "n2": n2, "n3": n3, "nota_total": nota_total, "comentarios": arrayComentario, "trechos": arrayTrechos, "redacao_alterada": redacaoAlterada, "id_aluno": id_aluno, "id_redacao": id_redacao.value, "modelo_redacao": modelo_redacao.value, "comentario_final": comentario_final, "id_corretor": id_corretor, "cores": arrayCorTrechos};
                    json = JSON.stringify(obj_jason);

                    //console.log(json);

                    $.ajax({
                        type: 'POST',
                        url: 'salvar_redacao.php',
                        data: {string_json: json},
                        success: ()=>{
                            window.location.href="./minhas_correcoes.php";
                        }
                    });

                }else if(modelo_redacao.value == 'Unicamp'){
                    var n1 = document.getElementById('criterio_1_unicamp').value;
                    var n2 = document.getElementById('criterio_2_unicamp').value;
                    var n3 = document.getElementById('criterio_3_unicamp').value;
                    var n4 = document.getElementById('criterio_4_unicamp').value;
                    var nota_total = document.getElementById('nota_total_unicamp').value;

                    obj_jason = {"n1": n1, "n2": n2, "n3": n3,"n4": n4, "nota_total": nota_total, "comentarios": arrayComentario, "trechos": arrayTrechos, "redacao_alterada": redacaoAlterada, "id_aluno": id_aluno, "id_redacao": id_redacao.value, "modelo_redacao": modelo_redacao.value, "comentario_final": comentario_final, "id_corretor": id_corretor, "cores": arrayCorTrechos};
                    json = JSON.stringify(obj_jason);

                    $.ajax({
                        type: 'POST',
                        url: 'salvar_redacao.php',
                        data:{string_json: json},
                        success: ()=>{
                            window.location.href="./minhas_correcoes.php";
                        }
                    });
                }else if(modelo_redacao.value == 'Vunesp'){
                    var n1 = document.getElementById('criterio_1_vunesp').value;
                    var n2 = document.getElementById('criterio_2_vunesp').value;
                    var n3 = document.getElementById('criterio_3_vunesp').value;
                    var nota_total = document.getElementById('nota_total_vunesp').value;

                    obj_jason = {"n1": n1, "n2": n2, "n3": n3, "nota_total": nota_total, "comentarios": arrayComentario, "trechos": arrayTrechos, "redacao_alterada": redacaoAlterada, "id_aluno": id_aluno, "id_redacao": id_redacao.value, "modelo_redacao": modelo_redacao.value, "comentario_final": comentario_final,"id_corretor": id_corretor, "cores": arrayCorTrechos};
                    json = JSON.stringify(obj_jason);

                    $.ajax({
                        type: 'POST',
                        url: 'salvar_redacao.php',
                        data: {string_json: json},
                        success: ()=>{
                            window.location.href="./minhas_correcoes.php";
                        }
                    });
                }
            }else{
                alert('Nenhum comentário a ser enviado');
            }
    });


    function getComentario(idComentario){
        var btnComentario = document.getElementById('btnComentar'+idComentario);
        var btnExcluirComentario = document.getElementById('btnExcluirComentario'+idComentario);
        var trechoSelecionadoHTML = document.getElementById('trecho_'+idComentario);
        //console.log(btnExcluirComentario);

        btnComentario.addEventListener("click", ()=>{
                if(idComentario == 1){
                    console.log('card'+idComentario)
                    var textoComentarioCorretor = document.getElementById('textoComentarioCorretor'+idComentario).value;
                    if(textoComentarioCorretor != ''){
                        arrayComentario.push(textoComentarioCorretor);
                        document.getElementById('msgStatus'+qtd).innerHTML = "<span style='color: green'>Observação salva com Sucesso.</span>";
                        btnComentario.style.display = "none";

                        document.getElementById('btn-vermelho').disabled = false;
                        document.getElementById('btn-verde').disabled = false;
                        btnExcluirComentario.style.display = "block";

                        //function do botão de excluir
                        btnExcluirComentario.addEventListener("click", ()=>{
                            console.log('Trecho a ser excluido: '+ arrayTrechos[idComentario - 1] +'\n')
                            console.log('Comentario a ser excluido: '+ arrayComentario[idComentario - 1] +'\n')
                            console.log('HTML do trecho a ser excluido: ' + trechoSelecionadoHTML)
                            console.log('Classe do elemento HTML: ' + trechoSelecionadoHTML.className)
                            arrayTrechos[idComentario - 1] = 'undefined'
                            if(trechoSelecionadoHTML.className == 'green-mark'){
                                trechoSelecionadoHTML.classList.remove('green-mark')
                                document.getElementById('CardComentario_trecho_'+idComentario).style.display = "none"
                            }else if(trechoSelecionadoHTML.className == 'red-mark'){
                                trechoSelecionadoHTML.className.classList.remove('red-mark')
                                document.getElementById('CardComentario_trecho_'+idComentario).style.display = "none"
                            }

                            /*for(var i = 0; i < arrayTrechos.length; i++){
                                console.log(arrayTrechos[i] + "\n")
                            }

                            for(var i = 0; i < arrayComentario.length; i++){
                                console.log(arrayComentario[i] + "\n")
                            }*/
                        });
                    }else{
                        document.getElementById('msgStatus'+qtd).innerHTML = "<span style='color: red'>Nada foi digitado</span>";
                    }
                    console.log(arrayComentario);
                    console.log(novoCardComentario.children[1].children[1])
                }else{
                    console.log('card'+idComentario)
                    var textoComentarioCorretor = document.getElementById('textoComentarioCorretor'+idComentario).value;
                    var textoComentarioCorretorAnterior = document.getElementById('textoComentarioCorretor'+(idComentario - 1)).value;
                    if(textoComentarioCorretorAnterior != ''){
                        if(textoComentarioCorretor != ''){
                            arrayComentario.push(textoComentarioCorretor);
                            document.getElementById('msgStatus'+qtd).innerHTML = "<span style='color: green'>Observação salva com Sucesso.</span>";
                            btnComentario.style.display = "none";

                            document.getElementById('btn-vermelho').disabled = false;
                            document.getElementById('btn-verde').disabled = false;
                            btnExcluirComentario.style.display = "block";

                            //function do botão de excluir
                            btnExcluirComentario.addEventListener("click", ()=>{                                
                                console.log('Trecho a ser excluido: '+ arrayTrechos[idComentario - 1] +'\n')
                                console.log('Comentario a ser excluido: '+ arrayComentario[idComentario - 1] +'\n')
                                console.log('HTML do trecho a ser excluido: ' + trechoSelecionadoHTML)
                                console.log('Classe do elemento HTML: ' + trechoSelecionadoHTML.className)
                                arrayTrechos[idComentario - 1] = 'undefined'
                                if(trechoSelecionadoHTML.className == 'green-mark'){
                                    trechoSelecionadoHTML.classList.remove('green-mark')
                                    document.getElementById('CardComentario_trecho_'+idComentario).style.display = "none"
                                }else if(trechoSelecionadoHTML.className == 'red-mark'){
                                    trechoSelecionadoHTML.classList.remove('red-mark')
                                    document.getElementById('CardComentario_trecho_'+idComentario).style.display = "none"
                                }
                                /*for(var i = 0; i < arrayTrechos.length; i++){
                                    console.log(arrayTrechos[i] + "\n")
                                }

                                for(var i = 0; i < arrayComentario.length; i++){
                                    console.log(arrayComentario[i] + "\n")
                                }*/
                            });
                        }else{
                            document.getElementById('msgStatus'+qtd).innerHTML = "<span style='color: red'>Nada foi digitado</span>";
                        }
                        console.log(arrayComentario);
                        console.log(novoCardComentario.children[1].children[1])
                    }else{
                        alert('Você ainda não comentou o trecho anterior.');
                    }
                }
            });
        }

</script>


<style> 
    *{
        margin: 0px;
        padding: 0px;
        font-family: Arial;
    }

    div.painel-redacao-super{
        display: flex;
        flex-direction: column;
    }

    div.navegacao-super{
        display: flex;
        flex: 50%;
        flex-direction: column;
    }

    .painel-redacao{
        display: flex;
        flex-direction: row;
        padding:  10px;
    }

    div.navegacao{
        flex: 40%;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    div.redacao{
        flex: 60%;
    }

    .nav_tabs{
		width: 600px;
		height: 400px;
		background-color: white;
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

    div.tab-content div label{
        font-size: 15px;
    }

    div.tab-content div select{
        width: 60%;
        padding: 10px;
        border-radius: 3px;
        margin: 10px 0px 30px 0px;
    }

    div.tab-content div.painel-nota-total p{
        font-weight: bold;
        font-size: 15px;
    }

    div.tab-content div.painel-nota-total input{
        width: 40%;
        padding: 8px;
        margin: 10px 0px;
    }

    nav ul li label{
        font-weight: bold;
    }


    mark{
        background-color: #F29F05;
    }

    .comentario-final{
        display: flex;
        flex-direction: row;
        margin: 20px 0px;
    }

    .comentario-final > textarea{
        min-height: 100px;
        width: 90%;
        outline: none;
        resize: none;
        margin-top: 10px;
        padding: 20px;
    }

    .btn{
        padding: 10px;
        border-radius : 10px;
        font-size: 20px;
        color: #ffffff;
        transition-duration: 0.4s;
    }

    .btn:hover{
        cursor: pointer;
        opacity: 0.9;
    }


    .btn{
        border-radius: 5px;
        padding: 5px;
        font-weight: bold;
        font-size: 16px;
        border: none;
    }


    .btn-finalizar-correcao{
        background-color: #41B4F5;
        padding: 10px;
        width: 50%;
    }

    ::selection{
        color: #212121;
        background-color: yellow;   
    }



    .green-mark{
        background-color: green;
        color: #ffffff;
    }

    .red-mark{
        background-color: red;
        color: #ffffff;
    }

    .btn{
        border: none;
        border-radius: 3px;
        width: 25px;
        height: 25px;
    }

    .btn-verde{
        border: 2px solid green;
        background-color: #ffffff;
        outline: none;
    }

    .btn-verde i{
        color: green;
    }

    .btn-vermelho{  
        border: 2px solid red;
        background-color: #ffffff;
        outline: none;
    }

    .btn-vermelho i{
        color: red;
    }

    textarea{
        outline: none;
        resize: none;
    }

    span{
        cursor:pointer;
    }

    div.container{
        display: flex;
        flex-direction: row;
        width: 100vw;
        height: 100vh;
    }

    div.container div.redacao{
        flex: 50%;
    }

    div.container div.correcao{
        flex: 50%;
    }

    div.container div.correcao div.card-comentarios{
        margin: 10px;
    }  

    div.container-alert div.alert{
        font-weight: bold;
        width: 30%;
    }

    div.card-comentarios{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    div.card-comentario{
        border-radius: 5px;
        padding: 5px;

        display: flex;
        flex-direction: column;
        width: 80%;
        margin: 20px;
    }

    div.card-comentario div{
        display: flex;
        flex-direction: row;
    }

    div.card-comentario div span{
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #f1f1f1;
        background-color: #f1f1f1;
        padding: 2px;
        border-radius: 3px;
    }

    div.card-comentario textarea{
        border-radius: 3px;
        min-height: 50px;
        resize: none;
        outline: none;
        padding: 10px;
    }

    div.card-comentario div{
        margin: 5px 0px;
    }

    div.card-comentario div button{
        border-radius: 3px;
        padding: 5px;
        margin: 0px 5px;
        outline: none;
        border: none;
        color: #ffffff;
        font-weight: bold;
        transition-duration: 0.4s;
    }

    button.btnComentar{
        background-color: #E1289B;
    }

    div.card-comentario div button:hover{
        opacity: 0.9;
        cursor: pointer;
    }

    div.msg_status{
        width: 200px;
        height: 30px;
    }

    button.btnExcluirComentario{
        background-color: #7F0100;
    }
</style>

<script type="text/javascript">

</script>
