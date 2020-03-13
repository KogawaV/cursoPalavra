<?php
    include './../connection.php';

    //verificando de qual vestibular vem a redação
    $modelo_redacao = mysqli_real_escape_string($conn, $_GET['modelo_redacao']);
    $redacao_alterada = mysqli_real_escape_string($conn, $_GET['redacao_alterada']);
    if($modelo_redacao == "Enem"){
        //variaveis das notas
        $n1 = mysqli_real_escape_string($conn, $_GET['n1']);
        $n2 = mysqli_real_escape_string($conn, $_GET['n2']);
        $n3 = mysqli_real_escape_string($conn, $_GET['n3']);
        $n4 = mysqli_real_escape_string($conn, $_GET['n4']);
        $n5 = mysqli_real_escape_string($conn, $_GET['n5']);
        $nota_total = mysqli_real_escape_string($conn, $_GET['nota_total']);

        echo "<input type='hidden' value='$n1' id='n1'>";
        echo "<input type='hidden' value='$n2' id='n2'>";
        echo "<input type='hidden' value='$n3' id='n3'>";
        echo "<input type='hidden' value='$n4' id='n4'>";
        echo "<input type='hidden' value='$n5' id='n5'>";
        echo "<input type='hidden' value='$nota_total' id='nota_total'>";

    }else if($modelo_redacao == "Fuvest"){
        //variaveis das notas
        $n1 = mysqli_real_escape_string($conn, $_GET['n1']);
        $n2 = mysqli_real_escape_string($conn, $_GET['n2']);
        $n3 = mysqli_real_escape_string($conn, $_GET['n3']);
        $nota_total = mysqli_real_escape_string($conn, $_GET['nota_total']);

        echo "<input type='hidden' value='$n1' id='n1'>";
        echo "<input type='hidden' value='$n2' id='n2'>";
        echo "<input type='hidden' value='$n3' id='n3'>";
        echo "<input type='hidden' value='$nota_total' id='nota_total'>";
    }else if($modelo_redacao == "Unicamp"){
        //variaveis das notas
        $n1 = mysqli_real_escape_string($conn, $_GET['n1']);
        $n2 = mysqli_real_escape_string($conn, $_GET['n2']);
        $n3 = mysqli_real_escape_string($conn, $_GET['n3']);
        $n4 = mysqli_real_escape_string($conn, $_GET['n4']);
        $nota_total = mysqli_real_escape_string($conn, $_GET['nota_total']);

        echo "<input type='hidden' value='$n1' id='n1'>";
        echo "<input type='hidden' value='$n2' id='n2'>";
        echo "<input type='hidden' value='$n3' id='n3'>";
        echo "<input type='hidden' value='$n4' id='n4'>";
        echo "<input type='hidden' value='$nota_total' id='nota_total'>";
    }else if($modelo_redacao == "Vunesp"){
        //variaveis das notas
        $n1 = mysqli_real_escape_string($conn, $_GET['n1']);
        $n2 = mysqli_real_escape_string($conn, $_GET['n2']);
        $n3 = mysqli_real_escape_string($conn, $_GET['n3']);
        $nota_total = mysqli_real_escape_string($conn, $_GET['nota_total']);

        echo "<input type='hidden' value='$n1' id='n1'>";
        echo "<input type='hidden' value='$n2' id='n2'>";
        echo "<input type='hidden' value='$n3' id='n3'>";
        echo "<input type='hidden' value='$nota_total' id='nota_total'>";
    }

    $jason = $_GET['jason'];
    $id_redacao = mysqli_real_escape_string($conn, $_GET['id_redacao']);
    $id_aluno = mysqli_real_escape_string($conn, $_GET['id_aluno']);
    $array_comentarios = array(mysqli_real_escape_string($conn, $_GET['array_comentarios']));
    $jason_trechos = $_GET['jason_trechos'];

    echo var_dump($array_comentarios);
    echo "<br>".$jason;
    echo '<br>Redação alterada: '.$redacao_alterada;

    /*$array_entrada = array('[', ']', '"', '"');
    $array_saida = array('','','','');
    $jason_sem_char_especiais = str_replace($array_entrada, $array_saida, $jason);
    echo $jason_sem_char_especiais;*/

    echo "<input type='hidden' value='$jason' id='jason'>";
    echo "<input type='hidden' value='$jason_trechos' id='jason_trechos'>";
    echo "<input type='hidden' value='$id_redacao' id='id_redacao'>";
    echo "<input type='hidden' value='$modelo_redacao' id='modelo_redacao'>";
    echo "<input type='hidden' value='$id_aluno' id='id_aluno'>";
    echo "<input type='text' value='$redacao_alterada' id='redacao_alterada'>";

    if(empty($redacao_alterada)){
        echo 'empty';
    }else if(!isset($redacao_alterada)){
        echo 'isset';
    }else{
        echo 'redação iniciada';
    }
    
    
    //$string_trechos = mysqli_real_escape_string($conn, $_GET['string_trechos']);
    //$redacao_alterada = mysqli_real_escape_string($conn, $_GET['redacao_alterada']);
    //$tipo_redacao = mysqli_real_escape_string($conn, $_GET['tipo_redacao']);
    
    //echo $jason;
    //passando o valor das variaveis para o javascript
    /*echo "<input type='hidden' value='$jason' id='jason'>";
    echo "<input type='hidden' value='$id_redacao' id='id_redacao'>";
    echo "<input type='hidden' value='$modelo_redacao' id='modelo_redacao'>";
    echo "<input type='hidden' value='$tipo_redacao' id='tipo_redacao'>";
    //echo "<input type='hidden' value='$string_trechos' id='string_trechos'>";
    //echo "<input type='hidden' value='$redacao_alterada' id='redacao_alterada'>";
    echo "<input type='hidden' value='$id_aluno' id='id_aluno'>" */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- <input type="text" name="trechos" id="trechos"> -->
</body>
<script>
        var id_redacao = document.getElementById('id_redacao').value;
        var modelo_redacao = document.getElementById('modelo_redacao').value;
        var redacao_alterada = document.getElementById('redacao_alterada').value;
        var id_aluno = document.getElementById('id_aluno').value;
        //var string_trechos = document.getElementById('string_trechos').value;

        var jason = document.getElementById('jason').value;
        var jason_trechos = document.getElementById('jason_trechos').value;
        var obj_jason = JSON.parse(jason);
        var obj_jason_trechos = JSON.parse(jason_trechos);

        var tamanho_array = obj_jason.length;
        var texto_trechos_comentarios = [];
        var texto_trechos = [];

        for(var i = 0; i < tamanho_array; i++){
            texto_trechos.push(obj_jason_trechos[i]+"separador_explode");
            texto_trechos_comentarios.push(obj_jason[i]+"separador_explode");
        }

        
        if(modelo_redacao == 'Enem'){
            var n1 = document.getElementById('n1').value;
            var n2 = document.getElementById('n2').value;
            var n3 = document.getElementById('n3').value;
            var n4 = document.getElementById('n4').value;
            var n5 = document.getElementById('n5').value;
            var nota_total = document.getElementById('nota_total').value;

            //window.location.href = "./validar_comentarios_trechos.php?trechos="+texto_trechos+"&comentarios="+texto_trechos_comentarios+"&n1="+n1+"&n2="+n2+"&n3="+n3+"&n4="+n4+"&n5="+n5+"&nota_total="+nota_total+"&modelo_redacao="+modelo_redacao+"&id_redacao="+id_redacao+"&tipo_redacao="+tipo_redacao.value+"&redacao_alterada="+redacao_alterada+"&id_aluno="+id_aluno;
            window.location.href="./validar_comentarios_trechos.php?comentarios="+texto_trechos_comentarios+"&id_aluno="+id_aluno+"&id_redacao="+id_redacao+"&modelo_redacao="+modelo_redacao+"&trechos="+texto_trechos+"&n1="+n1+"&n2="+n2+"&n3="+n3+"&n4="+n4+"&n5="+n5+"&nota_total="+nota_total+"&redacao_alterada="+redacao_alterada;
        }else if(modelo_redacao == 'Fuvest'){
            var n1 = document.getElementById('n1').value;
            var n2 = document.getElementById('n2').value;
            var n3 = document.getElementById('n3').value;
            var nota_total = document.getElementById('nota_total').value;
            obj_jason_trechos.responseType = "text";
            window.location.href = "./validar_comentarios_trechos.php?trechos="+texto_trechos+"&comentarios="+texto_trechos_comentarios+"&n1="+n1+"&n2="+n2+"&n3="+n3+"&nota_total="+nota_total+"&modelo_redacao="+modelo_redacao+"&id_redacao="+id_redacao+"&tipo_redacao="+tipo_redacao.value+"&redacao_alterada="+redacao_alterada+"&id_aluno="+id_aluno;

        }else if(modelo_redacao == 'Unicamp'){
            var n1 = document.getElementById('n1').value;
            var n2 = document.getElementById('n2').value;
            var n3 = document.getElementById('n3').value;
            var n4 = document.getElementById('n4').value;
            var nota_total = document.getElementById('nota_total').value;

            window.location.href = "./validar_comentarios_trechos.php?trechos="+texto_trechos+"&comentarios="+texto_trechos_comentarios+"&n1="+n1+"&n2="+n2+"&n3="+n3+"&n4="+n4+"&nota_total="+nota_total+"&modelo_redacao="+modelo_redacao+"&id_redacao="+id_redacao+"&tipo_redacao="+tipo_redacao.value+"&redacao_alterada="+redacao_alterada+"&id_aluno="+id_aluno;

        }else if(modelo_redacao == 'Vunesp'){
            var n1 = document.getElementById('n1').value;
            var n2 = document.getElementById('n2').value;
            var n3 = document.getElementById('n3').value;
            var nota_total = document.getElementById('nota_total').value;

            window.location.href = "./validar_comentarios_trechos.php?trechos="+texto_trechos+"&comentarios="+texto_trechos_comentarios+"&n1="+n1+"&n2="+n2+"&n3="+n3+"&nota_total="+nota_total+"&modelo_redacao="+modelo_redacao+"&id_redacao="+id_redacao+"&tipo_redacao="+tipo_redacao.value+"&redacao_alterada="+redacao_alterada+"&id_aluno="+id_aluno;

        }
        //alert(obj_jason.texto_trechos[0]);
    </script>
</html>

<script>
    var jason = document.getElementById('jason');
    var array_jason = jason.value.split(',');
</script>