<?php
include './../connection.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Planos</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="../Login_v17/images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/animsition/css/animsition.min.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/select2/select2.min.css">	
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/css/util.css">
        <link rel="stylesheet" type="text/css" href="../pagseguro_slide/configuracoes/css/main.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script>

            

            function enviaPagseguro(){

                $.post('pagseguro.php',{idPedido: document.getElementById("plano").value, cpf: document.getElementById("cpf").value},function(data){
                $('#code').val(data);
                $('#comprar').submit();
                })
            }
            
        </script>
        <style>
                th{
                    border: 1px solid black;
                    text-align: center;
                    background-color: #F5F5F5;
                    font-size: 15px;
                    width: 300px;
                }
                td{
                    border: 1px solid black;
                    height: 70px;
                }
                p{
                    font-size: 25px;
                }
            </style>
    </head>
    <body >
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <form class="cadastro100-form validate-form" id="comprar" action="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
                        <span class="cadastro100-form-title p-b-34">
                            PLANOS
                        </span>
                        <div id="presentation" style="width: 100%;">
                            <table  style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="border: 0px solid black;background-color: white;"></th>
                                        <th>Enem Básico</th>
                                        <th style="padding: 2px;">Enem Intermediàrio</th>
                                        <th>Enem Mais</th>
                                        <th>Unicamp</th>
                                        <th>Unicamp Mais</th>
                                        <th>Fuvest/Unesp</th>
                                        <th>Medicina e Áreas voltadas a saúde</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><p style="font-size: 13px;">
                                            Quntidade de redações
                                        </p></td>
                                        <td><p>3</p></td>
                                        <td><p>5</p></td>
                                        <td><p>10</p></td>
                                        <td><p>5</p></td>
                                        <td><p>10</p></td>
                                        <td><p>8</p></td>
                                        <td><p>8</p></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><p style="font-size: 13px;">
                                            Correção em 7 dias
                                        </p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><p style="font-size: 13px;">
                                            Correção personalizada
                                        </p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><p style="font-size: 13px;">
                                            Mapa de Desempenho
                                        </p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><p style="font-size: 13px;">
                                            Temas Variados
                                        </p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><p style="font-size: 13px;">
                                            Atendiemnto Personalizado Online
                                        </p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                    </tr>
                                    <tr>
                                        <td><p style="font-size: 13px;">
                                            Áudios/videos recomendados
                                        </p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                        <td><p><i class="fa fa-times" style="color: red;"></i></p></td>
                                        <td><p><i class="fa fa-check" style="color: green;"></i></p></td>
                                    </tr>
                                    <tr>
                                        <td ><p style="font-size: 15px;">
                                            Validade
                                        </p></td>
                                        <td><p style="font-size: 13px; color: black;">Janeiro de 2021</p></td>
                                        <td><p style="font-size: 13px; color: black;">Janeiro de 2021</p></td>
                                        <td><p style="font-size: 13px; color: black;">Janeiro de 2021</p></td>
                                        <td><p style="font-size: 13px; color: black;">Janeiro de 2021</p></td>
                                        <td><p style="font-size: 13px; color: black;">Janeiro de 2021</p></td>
                                        <td><p style="font-size: 13px; color: black;">Janeiro de 2021</p></td>
                                        <td><p style="font-size: 13px; color: black;">Janeiro de 2021</p></td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #F5F5F5;">Preço</td>
                                        <td>
                                            <span >R$27,00</span>
                                        </td>
                                        <td>
                                            <span >R$40,00</span>
                                        </td>
                                        <td>
                                            <span >R$70,00</span>
                                        </td>
                                        <td>
                                            <span >R$50,00</span>
                                        </td>
                                        <td>
                                            <span >R$80,00</span>
                                        </td>
                                        <td>
                                            <span >R$64,00</span>
                                        </td>
                                        <td>
                                            <span >R$64,00</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0px solid black;background-color: white;"></td>
                                        <td><button id="plano1">Comprar</button></td>
                                        <td><button id="plano7">Comprar</button></td>
                                        <td><button id="plano2">Comprar</button></td>
                                        <td><button id="plano3">Comprar</button></td>
                                        <td><button id="plano4">Comprar</button></td>
                                        <td><button id="plano5">Comprar</button></td>
                                        <td><button id="plano6">Comprar</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                        <input type="hidden" name="code" id="code" value="2" />  
                        <input type="hidden" name="plano" id="plano" value=""/>
                        <input type="hidden" name="cpf" id="cpf" value="330.672.988-45"/>   

                    </form>
                
                    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
                
                </div>
            </div>
        </div>      
    </body>
</html>
<script>
    document.getElementById("plano1").addEventListener("click",()=>{
        document.getElementById("plano").value="1";
        console.log(document.getElementById("plano").value);
        enviaPagseguro();
    })
    document.getElementById("plano2").addEventListener("click",()=>{
        document.getElementById("plano").value="2";
        console.log(document.getElementById("plano").value);
        enviaPagseguro();
    })
    document.getElementById("plano3").addEventListener("click",()=>{
        document.getElementById("plano").value="3";
        console.log(document.getElementById("plano").value);
        enviaPagseguro();
    })
    document.getElementById("plano4").addEventListener("click",()=>{
        document.getElementById("plano").value="4";
        console.log(document.getElementById("plano").value);
        enviaPagseguro();
    })
    document.getElementById("plano5").addEventListener("click",()=>{
        document.getElementById("plano").value="5";
        console.log(document.getElementById("plano").value);
        enviaPagseguro();
    })
    document.getElementById("plano6").addEventListener("click",()=>{
        document.getElementById("plano").value="6";
        console.log(document.getElementById("plano").value);
        enviaPagseguro();
    })
    document.getElementById("plano7").addEventListener("click",()=>{
        document.getElementById("plano").value="7";
        console.log(document.getElementById("plano").value);
        enviaPagseguro();
    })
</script>
