<?php
    include './config.php';
    include './../connection.php';

    $reference = $_GET['reference'];
    $id_aluno;

    $pegar_id_aluno = "SELECT * FROM carrinho WHERE identificador_carrinho = $reference";
    $pegar_id_aluno_result = mysqli_query($conn, $pegar_id_aluno);

    while($row = mysqli_fetch_array($pegar_id_aluno_result)){
        $id_aluno = $row['id_aluno']; 
    }

    $apagar_carrinho = "DELETE FROM carrinho WHERE identificador_carrinho = $reference";
    $apagar_carrinho_result = mysqli_query($conn, $apagar_carrinho);

    $apagar_aluno = "DELETE FROM aluno WHERE id_aluno = $id_aluno";
    $apagar_aluno_result = mysqli_query($conn, $apagar_aluno);

    header('Location: ./../../html/login.html');

?>