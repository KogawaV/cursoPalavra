<?php

//TESTE NO SERVIDOR
/*$servername = "cursopalavra.mysql.dbaas.com.br";
$username = "cursopalavra";
$password = "cursoPalavra";
$dbname = "cursopalavra";

$conn = mysqli_connect($servername, $username, $password, $dbname);*/



//TESTE LOCAL
$servername = "localhost:3307";
$username = "root";
$password = "1234";
$dbname = "curso_palavra";

$conn = mysqli_connect($servername, $username, $password, $dbname);

/*if($conn){
    echo 'Conectado ao banco de dados com sucesso.';
}else{
    echo 'Falha ao se conectar com a base de dados';
}*/

?>