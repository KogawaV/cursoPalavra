
<?php
    $nota1 = ($_GET['n1'] == "" || $_GET['n1'] == -1)?0:$_GET['n1'];
    $nota2 = ($_GET['n2'] == "" || $_GET['n2'] == -1)?0:$_GET['n2'];
    $nota3 = ($_GET['n3'] == "" || $_GET['n3'] == -1)?0:$_GET['n3'];
    $nota4 = ($_GET['n4'] == "" || $_GET['n4'] == -1)?0:$_GET['n4'];

    $soma = $nota1 + $nota2 + $nota3 + $nota4;

    echo $soma;