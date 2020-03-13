let amount = $('#amount').val();

pagamento()
function pagamento(){

    $('.bankName').hide();
    $('.creditCard').hide();

    var endereco = jQuery('.endereco').attr("data-endereco");
    $.ajax({
        url: endereco + "pagamento.php",
        type: 'POST',
        dataType: 'json',
        success: function (retorno) {
            //console.log(retorno);
            PagSeguroDirectPayment.setSessionId(retorno.id);
        },
        complete: function(retorno) {
            listandoMeiosPag()
        }
    });
}

function listandoMeiosPag(){
    PagSeguroDirectPayment.getPaymentMethods({
        amount: amount, 
        success: function(retorno) {
            console.log(retorno)
            $('.meio-pag').append("<div>Cartão de Credito</div>")
            $.each(retorno.paymentMethods.CREDIT_CARD.options, function(i,obj){
                //$('.meio-pag').append("<span>"+obj.name+"</span>")
                //$('.meio-pag').append("<span><img src='https://stc.pagseguro.uol.com.br"+ obj.images.SMALL.path +"'>"+obj.name+"</span>")
                $('.meio-pag').append("<span class='img-band'><img src='https://stc.pagseguro.uol.com.br"+ obj.images.SMALL.path +"'></span>")
            })
            $('.meio-pag').append("<div>Boleto</div>")
            $('.meio-pag').append("<span class='img-band'><img src='https://stc.pagseguro.uol.com.br"+retorno.paymentMethods.BOLETO.options.BOLETO.images.SMALL.path+"'></span>")
            $('.meio-pag').append("<div>Débito Online</div>")
            $.each(retorno.paymentMethods.ONLINE_DEBIT.options, function(i,obj){
                $('.meio-pag').append("<span class='img-band'><img src='https://stc.pagseguro.uol.com.br"+obj.images.SMALL.path+"'></span>")
                $('#bankName').show().append("<option value='"+obj.name+"'>"+obj.displayName+"</option>")
                $('.bankName').hide();
            })
        },
        error: function(retorno) {
            // Callback para chamadas que falharam.
        },
        complete: function(retorno) {
            //recupTokenCartao()
        }
    });
}

$('#numCartao').on('keyup', function(){
    let numCartao = $(this).val();
    let qtdNumero = numCartao.length
    //console.log(numCartao)

    if( qtdNumero == 6){
        PagSeguroDirectPayment.getBrand({
            cardBin: numCartao,
            success: function(retorno) {
              //console.log(retorno)
              $('#msg').empty()
              let imgBand = retorno.brand.name
              $('.bandeira-cartao').html("<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/"+imgBand+".png'>");
              $('#bandeiraCartao').val(imgBand)
              recupParcelas(imgBand)
            },
            error: function(retorno) {
                $('.bandeira-cartao').empty()
                $('#msg').html("Cartão Inválido")
            },
            complete: function(retorno) {
              //tratamento comum para todas chamadas
            }
        });
    }
    
})

function recupParcelas (bandeira){
    let noInterestInstallmentQuantity = $('#noInterestInstallmentQuantity').val();
    $('#qtdParcelas').html('<option value="">Selecione</option>')
    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        maxInstallmentNoInterest: noInterestInstallmentQuantity,
        brand: bandeira,
        success: function(retorno){
            
       	    $.each(retorno.installments, function ( ia, obja){
                $.each(obja, function ( ib, objb){
                    let valorParcela = objb.installmentAmount.toFixed(2).replace(".",",")
                    let valorParcelaDouble = objb.installmentAmount.toFixed(2)
                  $('#qtdParcelas').show().append("<option value='"+objb.quantity+"' data-parcela='"+valorParcelaDouble+"'>"+objb.quantity+" parcelas de R$"+valorParcela+"</option>") 
                })
               })
       },
        error: function(retorno) {
       	    // callback para chamadas que falharam.
       },
        complete: function(retorno){
            // Callback para todas chamadas.
       }
});
}

$('#qtdParcelas').change(function(){
    $('#valorParcela').val($('#qtdParcelas').find(':selected').attr('data-parcela'))
})

$("#formPagemento").on("submit", function(event){
    event.preventDefault()
    let paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
    console.log(paymentMethod);

    if(paymentMethod == 'creditCard'){
        PagSeguroDirectPayment.createCardToken({
            cardNumber: $('#numCartao').val(), // Número do cartão de crédito
            brand: $('#bandeiraCartao').val(), // Bandeira do cartão
            cvv: $('#cvvCartao').val(), // CVV do cartão
            expirationMonth: $('#mesVencimentoCartao').val(), // Mês da expiração do cartão   
            expirationYear: $('#anoVencimentoCartao').val(), // Ano da expiração do cartão, é necessário os 4 dígitos.
            success: function(retorno) {
                 $('#tokenCartao').val(retorno.card.token)
                 recupHashCartao()
            },
            error: function(retorno) {
                     // Callback para chamadas que falharam.
            },
            complete: function(retorno) {
                 
            }
         });
    }else if(paymentMethod == 'boleto'){
        recupHashCartao();
    }else if(paymentMethod == 'eft'){
        recupHashCartao();
    }  
})

function recupHashCartao(){
    PagSeguroDirectPayment.onSenderHashReady(function(retorno){
        if(retorno.status == 'error') {
            console.log(response.message);
            return false;
        }else{
        $("#hashCartao").val(retorno.senderHash) //Hash estará disponível nesta variável.
            let dados = $('#formPagemento').serialize();
            console.log(dados)

            let endereco = jQuery('.endereco').attr("data-endereco")
            console.log(endereco)
            $.ajax({
                method: "POST",
                url: endereco + "proc_pag.php",
                data: dados,
                dataType: 'json',
                success: function(retorna){
                    console.log("Sucesso " + JSON.stringify(retorna)); 
                    $("#msg").html('<p style="color: green">Transação realizada com sucesso</p>');   
                    //window.location.href = retorna['dados']['paymentLink'];          
                },
                error: function(retorna){
                    console.log("Erro");
                    $("#msg").html('<p style="color: red">Erro ao realizar a transação </p>')
                }
            });
    }
    });
}

function tipoPagamento(paymentMethod){
    if(paymentMethod == "creditCard"){
        $('.bankName').hide()
        $('.creditCard').show()
    }
    if(paymentMethod == "boleto"){
        $('.bankName').hide()
        $('.creditCard').hide()
    }
    if(paymentMethod == "eft"){
        $('.bankName').show()
        $('.creditCard').hide()
    }
}