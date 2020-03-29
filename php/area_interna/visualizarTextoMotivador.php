<?php
    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['id_aluno']) || !isset($_SESSION['nome_aluno'])){
        echo 'Sessões não existem';
        header('Location: ./../../html/login.html');
    }else{
        include './../connection.php';

        $caminho =  mysqli_real_escape_string($conn, $_GET['caminho']);
        //echo $caminho;

        echo '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Textos Motivadores</title>
    <style type="text/css">
        *{
            margin: 0px;
            padding: 0px;
        }

        html,body{
            font-family: Arial;
        }

        div.container{
            display: flex;
            flex-direction: column;
            width: 100vw;
            height: 100vh;
            background-color: white;
            justify-content: center;
            align-items: center;
        }

        div.container iframe{
            width: 50%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <iframe src="<?php echo $caminho?>">
    </div>
</body>
</html>

