<?php
    include './../../connection.php';

    $id_tema = $_GET['id_tema'];
    //echo $id_tema;

    $sql_delete_tema = "DELETE FROM temas_redacao WHERE id_tema = $id_tema";
    $sql_delete_tema_result = mysqli_query($conn, $sql_delete_tema);

    if($sql_delete_tema_result){
        echo 'Tema excluido com sucesso.';
        header('Location: ./temas_cadastrados.php');
    }else{
        echo 'Falha ao excluir tema.';
    }
?>