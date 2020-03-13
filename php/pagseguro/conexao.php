<?php
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('BDNAME', 'pagseguro');

    $conn = new PDO('mysql:host='. HOST .'; dbname='. BDNAME .';',USER,PASS);