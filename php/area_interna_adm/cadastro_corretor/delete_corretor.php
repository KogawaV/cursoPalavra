<?php
    session_start();
    if(!isset($_SESSION['email_adm'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../../connection.php';
        $id_corretor = mysqli_real_escape_string($conn, $_GET['id_corretor']);
        echo $id_corretor;

        $sql_delete_corretor = "DELETE FROM dados_corretor WHERE id_corretor = $id_corretor";
        $sql_delete_corretor_result = mysqli_query($conn, $sql_delete_corretor);
        if($sql_delete_corretor_result){
            echo 'Corretor excluido da plataforma com sucesso.';
            header('Location: ./../corretores_cadastrados.php');
        }else{
            echo 'Falha ao excluir este corretor da base de dados.';
            header('Location: ./../corretores_cadastrados.php');
        }
    }
?>