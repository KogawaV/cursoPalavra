<?php
include './config.php';
include './../connection.php';
session_start();
if(!isset($_SESSION['id_aluno']) || !isset($_SESSION['data_compra'])){
    echo 'Sessões não existem';
    header('Location: ./../../html/login.html');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Celke - PagSeguro</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
        <link rel="stylesheet" href="css/p2.css">
    </head>
    <body >
        <div class="container">
            <div class="row">
                <h1 class="display-4">Finalizar a Compra</h1>
                <div class="col-md-4 order-md-2 mb-4">
                    Produtos
                </div>
                <div class="col-md-8 order-md-1">
                    <span class="endereco" data-endereco="<?php echo URL; ?>"></span>
                    <form action="" id="formPagemento" name="formPagemento">
                    <div id="msg"></div>
                        <!--Dados ocultos-->
                        <input type="hidden" name="receiverEmail" id="receiverEmail" value="<?php echo EMAIL_LOJA; ?>">
                        <input type="hidden" name="currency" id="currency" value="<?php echo MOEDA_PAGAMENTO;?>">
                        <input type="hidden" name="extraAmount" id="extraAmount">
                        <input type="hidden" name="noInterestInstallmentQuantity" id="noInterestInstallmentQuantity" value="3">
                        <input type="hidden" name="notificationURL" id="notificationURL" value="<?php echo URL_NOTIFICACAO;?>">
                        <?php
                        $identificador_carrinho;
                        $total_venda;

                        $nome_plano;
                        $id_plano;
                        //apagar carrinho anteriores
                        //$apagar_carrinho = "DELETE FROM carrinho WHERE id_aluno = {$_SESSION['id_aluno']} AND data_compra < {$_SESSION['data_compra']}";
                        //$apagar_carrinho_result = mysqli_query($conn, $apagar_carrinho);

                        
                        $query_car = "SELECT * FROM carrinho car INNER JOIN tipos_planos tp ON car.identificador_compra = tp.id_tipo_plano WHERE id_aluno = {$_SESSION['id_aluno']}";

                        $resultado_car = mysqli_query($conn, $query_car);
                        while($row = mysqli_fetch_array($resultado_car)){
                            $identificador_carrinho = $row['identificador_carrinho'];
                            $total_venda = $row['valor_venda'];

                            $nome_plano = $row['nome_plano'];
                            $id_plano = $row['id_tipo_plano'];
                        }
                        //echo $identificador_carrinho;
                        //echo $total_venda;
                        //echo $nome_plano;
                        //echo $id_plano
                        ?>

                        <input type="hidden" name="nome_plano" id="nome_plano" value="<?php echo $nome_plano; ?>">
                        <input type="hidden" name="id_plano" value="<?php echo $id_plano; ?>">

                        <input type="hidden" name="reference" id="reference" value="<?PHP echo $identificador_carrinho?>">
                        <input type="hidden" name="amount" id="amount" value="<?php echo $total_venda?>">

                        <input type="hidden" value="1" id="msg-p">

                        <h4 class="mb-3">Dados do Comprador</h4>

                        <div class=" mb-3">
                            <label >Nome</label>
                            <input type="text" name="senderName" class="form-control" id="senderName" placeholder="Nome completo" value="Jose Comprador" required>
                        </div>
                        <div class=" mb-3">
                            <label >CPF</label>
                            <input type="text" name="senderCPF" class="form-control" id="senderCPF" placeholder="CPF somente os numeros" value="22111944785" required>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>DDD</label>
                                <input type="text" name="senderAreaCode" class="form-control" id="senderAreaCode" placeholder="DDD" value="11" required>
                            </div>
                            
                            <div class="col-md-9 mb-3">
                                <label>Telefone</label>
                                <input type="text" name="senderPhone" class="form-control" id="senderPhone" placeholder="Somente número" value="56273440" required>
                            </div>
                        </div>

                        <div class=" mb-3">
                            <label >E-mail</label>
                            <input type="text" name="senderEmail" class="form-control" id="senderEmail" placeholder="E-mail do comprador" value="c43990837523442502165@sandbox.pagseguro.com.br" required>
                        </div>
                        <input type="hidden" name="shippingAddressRequired" id="shippingAddressRequired" value="false">

                        <h4 class="mb-3">Escolha forma de pagamento</h4>

                        <div class="custom-control custom-radio">
                            <input type="radio" name="paymentMethod" class="custom-control-input" id="creditCard" value="creditCard" onclick="tipoPagamento('creditCard')">
                            <label class="custom-control-label" for="creditCard">Cartão de Crédito</label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input type="radio" name="paymentMethod" class="custom-control-input" id="boleto" value="boleto" onclick="tipoPagamento('boleto')">
                            <label class="custom-control-label" for="boleto">Boleto</label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input type="radio" name="paymentMethod" class="custom-control-input" id="eft" value="eft" onclick="tipoPagamento('eft')">
                            <label class="custom-control-label" for="eft">Débito Online</label>
                        </div>
                        
                        <!-- PAGAMENTO COM DÉBITO ONLINE-->

                        <div class="mb-3 bankName">
                            <label class="bankName">Banco:</label>
                            <select name="bankName" id="bankName" class="form-control select-bank-name bankName" required></select>
                        </div>
                         
                         <!-- PAGAMENTO COM CARTÃO DE CREDITO-->
                         <input type="hidden" name="bandeiraCartao" id="bandeiraCartao">
                         <input type="hidden" name="installmentValue" id="valorParcela">
                         <input type="hidden" name="creditCardToken" id="tokenCartao">
                         <input type="hidden" name="hashCartao" id="hashCartao"> 

                        <h4 class="mb-3 creditCard">Dados do Cartão</h4>

                        <div class=" mb-3 creditCard">
                            <label class="creditCard">Numero do Cartão</label>
                            <div class="input-group">
                            <input type="text" name="numCartao" class="form-control creditCard" id="numCartao"class="creditCard">
                            <div class="input-group-prepend">
                                <span class="form-control bandeira-cartao creditCard"></span>
                            </div>
                            </div>
                            <small id="numCartao" class="form-text text-muted">
                                Preencha para ver o parcelamento
                            </small> 
                        </div>

                        <div class=" mb-3 creditCard">
                            <label class="creditCard">Quantidade de Parcelas</label>
                            <select name="installmentQuantity" id="qtdParcelas" class="form-control select-qtd-parcelas creditCard"></select>
                        </div>

                        <div class=" mb-3 creditCard">
                            <label class="creditCard">Nome do titular</label>
                            <input type="text" class="form-control creditCard" name="creditCardHolderName" id="creditCardHolderName" value="Jose Comprador">
                            <small id="creditCardHolderName" class="form-text text-muted">
                                Como está gravado no cartão
                            </small>
                        </div>

                        <div class="row creditCard">
                            <div class="col-md-6 mb-3 creditCard">
                                <label class="creditCard">Mês de vencimento</label>
                                <input type="text" class="form-control creditCard" name="mesVencimentoCartao" id="mesVencimentoCartao" maxlength="2" value="12">
                            </div>
                            <div class="col-md-6 mb-3 creditCard">
                                <label class="creditCard">Ano de vencimento</label>
                                <input type="text" class="form-control creditCard" name="anoVencimentoCartao" id="anoVencimentoCartao" maxlength="4" value="2030">
                            </div>
                        </div>

                        <div class=" mb-3 creditCard">
                            <label class="creditCard">CVV do Cartão</label>
                            <input type="text" class="form-control creditCard" name="cvvCartao" id="cvvCartao" maxlength="3" value="123"> 
                            <small id="cvvCartao" class="form-text text-muted creditCard">
                                Código de 3 digitos impresso no verso do cartão
                            </small>       
                        </div>

                        <div class="row creditCard">
                            <div class="col-md-6 mb-3 creditCard">
                                <label class="creditCard">CPF do dono do Cartão</label>
                                <input type="text" class="form-control creditCard" name="creditCardHolderCPF" id="creditCardHolderCPF" placeholder="CPF sem traço" value="22111944785">
                            </div>
                            <div class="col-md-6 mb-3 creditCard">
                                <label class="creditCard">Data de Nascimento</label>
                                <input type="text" class="form-control creditCard" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" value="27/10/1987" placeholder="Data de Nascimento. Ex: 12/12/1912">
                            </div>
                        </div>

                        <h4 class="mb-3 creditCard">Endereço do Cartão</h4>

                        <div class="row creditCard">
                            <div class="col-md-9 mb-3 creditCard">
                                <label class="creditCard">Endereço</label>
                                <input type="text" class="form-control creditCard" name="billingAddressStreet" id="billingAddressStreet" value="Av. Brig. Faria Lima" placeholder="Av. Rua">
                            </div>
                            <div class="col-md-3 mb-3 creditCard">
                                <label class="creditCard">Numero</label>
                                <input type="text" class="form-control creditCard" name="billingAddressNumber" id="billingAddressNumber" value="1384" placeholder="Número">   
                            </div>
                        </div>

                        <div class="mb-3 creditCard">
                            <label class="creditCard">Complemento</label>
                            <input type="text" class="form-control creditCard" name="billingAddressComplement" id="billingAddressComplement"  placeholder="Complemento" value="5o andar">
                        </div>

                        <div class="row creditCard">
                            <div class="col-md-5 mb-3 creditCard">
                                <label class="creditCard">Bairro</label>
                                <input type="text" class="form-control creditCard" name="billingAddressDistrict" id="billingAddressDistrict" value="Jardim Paulistano">
                            </div>
                            <div class="col-md-5 mb-3 creditCard">
                                <label class="creditCard">Cidade</label>
                                <input type="text" class="form-control creditCard" name="billingAddressCity" id="billingAddressCity" value="Sao Paulo">
                            </div>
                            <div class="col-md-2 mb-3 creditCard">
                            <label class="creditCard">Estado</label>
                            <select name="billingAddressState" class="custom-select d-block w-100 creditCard" id="billingAddressState">
                            <option value="">Selecione</option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AP">AP</option>
                                <option value="AM">AM</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MT">MT</option>
                                <option value="MS">MS</option>
                                <option value="MG">MG</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PR">PR</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SP">SP</option>
                                <option value="SE">SE</option>
                                <option value="TO">TO</option>
                            </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="creditCard">CEP</label>
                            <input type="text" class="form-control creditCard" name="billingAddressPostalCode" id="billingAddressPostalCode" value="01452002">
                        </div>

                        <input type="hidden" name="billingAddressCountry" id="billingAddressCountry" value="<?php echo PAIS_CARTAO;?>">
                        <input type="submit" name="btnComprar" id="btnComprar" value="Comprar">
                    </form>
                </div>
            </div>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo SCRIPT_PAGSEGURO; ?>"></script>
        <script src="js/p.js"></script>
    </body>
</html>

<script>
    var msg = document.getElementById('msg').innerText;
    var msg_p = document.getElementById('msg-p').value;
    var reference = document.getElementById('reference').value;

    /*if(msg == 'Erro ao realizar a transação'){
        window.location.href="./erro_transacao.php?reference="+reference;
    }*/
</script>