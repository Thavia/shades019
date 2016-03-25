function mascaraCampos(t, mask){
	var i = t.value.length;
	var saida = mask.substring(1,0);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida){
	t.value += texto.substring(0,1);
	}
}
function validar_cep(cep){
	exp = /^\d{5}-\d{3}$/
	if(!exp.test(cep)){
		return false;
	}else{
		return true;
	}		
}
function calcular_frete_ok(){
	var cep = $('#cep').val();
	var id = $('#id_produto_frete').val();
	var qtd = $('input[name="quantity"]').val();
	if(validar_cep(cep)){
	$.ajax({
		url: 'index.php?route=checkout/simulador',
		type: 'post',
		data: 'cep='+cep+'&id='+id+'&qtd='+qtd,
		dataType: 'json',
		beforeSend: function() {
			$('#resultado-frete').html('<br><img class="center-block" src="image/aguarde_cep.gif">');
			$('#botao-cep').button('loading');
		},
		complete: function() {
			$('#botao-cep').button('reset');
		},			
		success: function(json) {
			if(json.erro==true){
				$('#resultado-frete').html('<br><p class="text-center">'+json.cotas+'</p>');
			}else{
				var html = '<br>';
				$.each(json.cotas, function(i, item) {
				html += '<table class="table table-bordered">';
				html += '<thead><tr><th colspan="2">'+item.title+'</th></tr></thead>';
				
				$.each(item.quote, function(k, cota) {
				html += '<tr><td>'+cota.title+'</td><td width="80">'+cota.text+'</td></tr>';
				});
				
				html += '</table>';
				});
				$('#resultado-frete').html(html);
			}
		}
	});
	}else{
		alert('Digite um CEP v\u00e1lido!');
		$('#cep').focus();
		return false;
	}
}