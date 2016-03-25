<?php if($modo==0){ ?>
<script type='text/javascript'>var s=document.createElement('script');s.type='text/javascript';var v=parseInt(Math.random()*1000000);s.src='https://sandbox.gerencianet.com.br/v1/cdn/<?php echo $conta;?>/'+v;s.async=false;s.id='<?php echo $conta;?>';if(!document.getElementById('<?php echo $conta;?>')){document.getElementsByTagName('head')[0].appendChild(s);};$gn={validForm:true,processed:false,done:{},ready:function(fn){$gn.done=fn;}};</script>
<?php }else{ ?>
<script type='text/javascript'>var s=document.createElement('script');s.type='text/javascript';var v=parseInt(Math.random()*1000000);s.src='https://api.gerencianet.com.br/v1/cdn/<?php echo $conta;?>/'+v;s.async=false;s.id='<?php echo $conta;?>';if(!document.getElementById('<?php echo $conta;?>')){document.getElementsByTagName('head')[0].appendChild(s);};$gn={validForm:true,processed:false,done:{},ready:function(fn){$gn.done=fn;}};</script>
<?php } ?>

<style>
label.ops_campo_erro {
  color: #a94442;
}
</style>

<div id="tela-full-gn5" role="tabpanel">

<!-- <?php print_r($charge);?> -->

<?php if($cc){ ?>
<div class="row">

<div class="col-md-12">

<span id="erros"></span>

<div class="alert alert-info attention" role="alert"><i class="glyphicon glyphicon-info-sign"></i> Os dados informados abaixo deveram corresponder ao titular do endere&ccedil;o de cobran&ccedil;a informado no momento do cadastro na loja.</div>

<form id="creditCardForm" onsubmit="return false;" action="<?php echo $url_criar;?>" method="post" class="form_pagamento_cartao_gn5 form-horizontal">

<input type="hidden" name="pedido" value="<?php echo $pedido['order_id'];?>">
<input type="hidden" name="orderid" value="<?php echo $charge['data']['charge_id'];?>">
<input type="hidden" name="meio" value="cartao">
<input type="hidden" name="bandeira" value="">
<input type="hidden" name="token_cartao" value="">

<div class="form-group">
<label class="col-xs-3 control-label">Selecione</label>
<div class="col-xs-9">
<img style="display: inline; width:50px; cursor:pointer" src="app/gn5/img/visa.gif" onclick="bandeira_gn('visa')"  class="cartaoes visa img-responsive">
<img style="display: inline; width:50px; cursor:pointer" src="app/gn5/img/mastercard.gif" onclick="bandeira_gn('mastercard')"  class="cartaoes mastercard img-responsive">
<img style="display: inline; width:50px; cursor:pointer" src="app/gn5/img/elo.gif" onclick="bandeira_gn('elo')"  class="cartaoes elo img-responsive">
<img style="display: inline; width:50px; cursor:pointer" src="app/gn5/img/amex.gif" onclick="bandeira_gn('amex')"  class="cartaoes amex img-responsive">
<img style="display: inline; width:50px; cursor:pointer" src="app/gn5/img/diners.gif" onclick="bandeira_gn('diners')"  class="cartaoes diners img-responsive">
<img style="display: inline; width:50px; cursor:pointer" src="app/gn5/img/discover.gif" onclick="bandeira_gn('discover')"  class="cartaoes discover img-responsive">
<img style="display: inline; width:50px; cursor:pointer" src="app/gn5/img/jcb.gif" onclick="bandeira_gn('jcb')"  class="cartaoes jcb img-responsive">
<img style="display: inline; width:50px; cursor:pointer" src="app/gn5/img/aura.gif" onclick="bandeira_gn('aura')"  class="cartaoes aura img-responsive">
</div>
</div>

<div class="form-group">
<label class="col-xs-3 control-label">Titular</label>
<div class="col-xs-9">
<input type="text" value="<?php echo $pedido['payment_firstname'];?> <?php echo $pedido['payment_lastname'];?>" data-checkout="cardholderName" onkeyup="upGn5(this)" onkeydown="upGn5(this)" style="width:50%" class="form-control" id="titular" name="titular" />
</div>
</div>

<div class="form-group">
<label class="col-xs-3 control-label">Aniversario</label>
<div class="col-xs-9">
<input type="text" onclick='$(this).mask("99/99/9999")' maxlength="10" style="width:40%" value="" class="form-control" id="data" name="data" />
</div>
</div>

<div class="form-group">
<label class="col-xs-3 control-label">CPF</label>
<div class="col-xs-9">
<input type="text" onkeypress="return isNumberKeyGn5(event)" maxlength="14" style="width:40%" value="<?php echo $fiscal;?>" class="form-control" id="fiscal" name="fiscal" />
</div>
</div>

<div class="form-group">
<label class="col-xs-3 control-label">Telefone (com DDD)</label>
<div class="col-xs-9">
<input type="text" onclick='$(this).mask("(99)99999999?9")' data-checkout="telNumber" maxlength="13" style="width:40%" value="<?php echo $pedido['telephone'];?>" class="form-control" id="telefone" name="telefone" />
</div>
</div>

<div class="form-group">
<label class="col-xs-3 control-label">N&uacute;mero do Cart&atilde;o</label>
<div class="col-xs-9">
<input type="text" value="" data-checkout="cardNumber" onkeypress="return isNumberKeyGn5(event)" maxlength="19" style="width:50%" class="form-control numero_cartao" id="numero_cartao" name="numero_cartao" />
</div>
</div>

<div class="form-group">
<label class="col-xs-3 control-label">Validade MM/AAAA</label>
<div class="col-xs-9">
<input type="number" min="1" max="12" style="width:60px;display:inline;" value="" onkeypress="return isNumberKeyGn5(event)" data-checkout="cardExpirationMonth" maxlength="2" class="form-control" id="validadem" name="validadem" />/<input min="<?php echo date('Y');?>" type="number" value="" style="width:100px;display:inline;" onkeypress="return isNumberKeyGn5(event)" data-checkout="cardExpirationYear" maxlength="4" class="form-control" id="validadea" name="validadea" />
</div>
</div>

<div class="form-group">
<label class="col-xs-3 control-label">C&oacute;digo (CVV)</label>
<div class="col-xs-9">
<input type="text" value="" data-checkout="securityCode" onkeypress="return isNumberKeyGn5(event)" maxlength="4" style="width:40%" class="form-control" id="codigo" name="codigo" />
</div>
</div>

<div class="form-group">
<label class="col-xs-3 control-label">Parcelas</label>
<div class="col-xs-9">
<select name="parcelas" style="width:40%" class="form-control" id="parcelas">
<option value="">Selecione um cart&atilde;o!</option>
</select>
</div>
</div>

<div class="form-group">
<div class="col-xs-9 col-xs-offset-3">
<div class="buttons"><input type="submit" class="btn btn-success" id="button-confirm" value="Concluir Pagamento"></div>
</div>
</div>
</form>

</div>

</div>
<?php } ?>

<?php 
if($bo){
?>
<div class="row">
<div class="col-md-12">

<form id="boletoForm" method="post" action="<?php echo $url_criar;?>" class="form_pagamento_boleto_gn5 form-horizontal">

<input type="hidden" name="pedido" value="<?php echo $pedido['order_id'];?>">
<input type="hidden" name="orderid" value="<?php echo $charge['data']['charge_id'];?>">
<input type="hidden" name="meio" value="boleto">

<div class="form-group">
<label class="col-xs-3 control-label"></label>
<div class="col-xs-3 selectContainer">
<img src="app/gn5/img/boleto-128px.png">
</div>
</div>

<div class="form-group">
<label class="col-xs-3 control-label">CPF</label>
<div class="col-xs-9">
<input type="text" onkeypress="return isNumberKeyGn5(event)" maxlength="14" style="width:40%" value="<?php echo $fiscal;?>" class="form-control" id="fiscal" name="fiscal" />
</div>
</div>

<div class="form-group">
<label class="col-xs-3 control-label">Telefone (com DDD)</label>
<div class="col-xs-9">
<input type="text" onclick='$(this).mask("(99)99999999?9")' data-checkout="telNumber" maxlength="13" style="width:40%" value="<?php echo $pedido['telephone'];?>" class="form-control" id="telefone" name="telefone" />
</div>
</div>

<div class="form-group">
<div class="col-xs-9 col-xs-offset-3">
<div class="buttons"><input type="submit" class="btn btn-success" id="button-confirm" value="Concluir Pagamento"></div>
</div>
</div>
</form>


</div>
</div>
<?php } ?>

</div>

<script type="text/javascript" src="app/gn5/mascaras.js?<?php echo time();?>"></script>
<script type="text/javascript" src="app/gn5/jquery.validate.js?<?php echo time();?>"></script>
<script type="text/javascript" src="app/gn5/additional-methods.js?<?php echo time();?>"></script>
<script type="text/javascript" src="app/gn5/block.js?<?php echo time();?>"></script>
<script type="text/javascript" src="app/gn5/loja5.js?<?php echo time();?>"></script>

<script>
function geraTokenGN(form){
	var callback = function(error, response) {
	if(error) {
	  // Trata o erro ocorrido
	  console.log(error);
	  alert(error.code+' - '+error.error_description);
	  return false;
	} else {
	  // Trata a resposta
	  tela_aguarda();
	  console.log(response);
	  $('input[name="token_cartao"]').val(response.data.payment_token);
	  form.submit();
	  return false;
	}
	};
	var numero = $('input[name="numero_cartao"]').val();
	numero = numero.replace(/\D/g,'');
	var bandeira = $('input[name="bandeira"]').val();
	var cvv = $('input[name="codigo"]').val();
	cvv = cvv.replace(/\D/g,'');
	var mes = $('input[name="validadem"]').val();
	mes = mes.replace(/\D/g,'');
	var ano = $('input[name="validadea"]').val();
	ano = ano.replace(/\D/g,'');
	$gn.checkout.getPaymentToken({
	brand: bandeira,
	number: numero,
	cvv: cvv,
	expiration_month: mes,
	expiration_year: ano
	}, callback);
}

function bandeira_gn(bandeira){
	console.log(bandeira);
	$('input[name="bandeira"]').val(bandeira);
	jQuery('.cartaoes').css('opacity', '0.3');	
	jQuery('.'+bandeira).css('opacity', '1');
	if (typeof $gn.checkout != 'undefined') {
	$gn.checkout.getInstallments(<?php echo number_format($total_pedido_float, 2, '', '');?>,bandeira, function(error, response){
		if(error) {
		  // Trata o erro ocorrido
		  console.log(error);
		} else {
		    // Insere o parcelamento no site
		    console.log(response);
		    var installments = response.data.installments;
			var html_options = "";
			for(i=0; installments && i<installments.length; i++){
			html_options += "<option value='"+installments[i].installment+"'>"+installments[i].installment+"x de R$ "+installments[i].currency+"</option>";
			};
			$("#parcelas").html(html_options);
		}
	});
	}else{
		alert('Ops, recarregue a tela (F5) de pagamento e tente novamente!');
	}
}
</script>
<script type="text/javascript">
<!--
$(".form_pagamento_boleto_gn5").validate({
submitHandler: function(form) {
	tela_aguarda();
	form.submit();
},
errorClass: "ops_campo_erro",
rules: {
fiscal: {
required: true,
validacpfcnpj:true
},
telefone: {
required: true,
}
},
messages: {
fiscal: "Informe o seu CPF!",
telefone: "Informe o seu telefone!",
}
});

$(".form_pagamento_cartao_gn5").validate({
submitHandler: function(form) {
	var valido = geraTokenGN(form);
	console.log('cc valido '+valido);
	return false;
},
errorClass: "ops_campo_erro",
rules: {
numero_cartao: {
required: true,
},
titular: {
required: true,
},
data: {
required: true,
},
fiscal: {
required: true,
validacpfcnpj:true
},
telefone: {
required: true,
},
validadem: {
required: true,
},
validadea: {
required: true,
},
codigo: {
required: true,
},
parcelas: {
required: true,
}
},
messages: {
numero_cartao: "Digite o cartao!",
titular: "Informe o titular!",
data: "Informe o seu aniversario!",
fiscal: "Informe o seu CPF!",
telefone: "Informe o seu telefone!",
validadem: "Digite o mes de validade!",
validadea: "Digite o ano de validade!",
codigo: "Digite o codigo CVV!",
parcelas: "Selecione a parcela!",
}
});

-->
</script>