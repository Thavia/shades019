<?php 
echo $header; 
?>
<div id="container" class="container j-container">
<div class="container">
<div class="row">
<?php $class = 'col-sm-12'; ?>
<div id="content" class="<?php echo $class; ?>">

<?php 
if($erro){ 
//print_r($msg);
?>
<div class="buttons">
<div style="text-align: center;">
  <h2>Ops, problema no pagamento!</h2>
  <p>Ocorreu um erro ao processar o seu pagamento junto a GerenciaNet!
  <br>
  <?php echo (isset($msg['message'])?$msg['message']:'');?></p>
</div>
</div>
<?php 
}else{ 
//print_r($dados);
?>
<div class="buttons">
<h3>Resultado da transa&ccedil;&atilde;o</h3>
<p>
	<img width="30" height="30" src="app/gn5/logo.png" style="float:left; margin: 0px 10px 5px 0px;" />
	Transa&ccedil;&atilde;o processada por GerenciaNet pagamentos online.
	<br/>
	Detalhes de sua transa&ccedil;&atilde;o:
</p>
<p style="margin-top:20px;">
	- Pedido:
	<span><?php echo $pedido;?></span>
<br>
	- Transa&ccedil;&atilde;o:
	<span><?php echo $dados['data']['charge_id'];?></span>
<br>
	- Valor total do pedido:
	<span id="amount" class="price">R$ <?php echo number_format($order['total'], 2, '.', '');?></span>
<br>
	- Metodo de pagamento:
	<span><?php echo ($dados['data']['payment']['method']=='banking_billet')?'Boleto Banc&aacute;rio':'Cart&atilde;o de Cr&eacute;dito';?></span><?php if($dados['data']['payment']['method']=='credit_card'){?> em  <?php echo $dados['data']['payment']['credit_card']['installments'];?>x<?php } ?>
<br>
	- Status do pagamento:
	<span><u><?php echo $status;?></u></span>
</p>

<?php if ($dados['data']['payment']['method']=='banking_billet'){?>
<button onclick="window.open('<?php echo $dados['data']['payment']['banking_billet']['link'];?>','boleto');" class="button btn btn-primary"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Imprimir Boleto Banc&aacute;rio</button><br><br>
<?php } ?>

<p>
Para visualizar detalhes de seu pedido <a class="" href="index.php?route=account/order/info&order_id=<?php echo $pedido;?>">clique aqui</a> ou em caso de duvidas entre em <a href="index.php?route=information/contact">contato</a> com a loja.
</p>


<?php include("app/gn5/html.php");?>

</div>
<?php } ?>

</div>
</div>
</div>
</div>

<script>
(function(){
    var i = document.createElement('iframe');
    i.style.display = 'none';
    i.onload = function() { i.parentNode.removeChild(i); };
    i.src = '<?php echo $iframe;?>';
    document.body.appendChild(i);
})();
</script>

<?php echo $footer; ?>