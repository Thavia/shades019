<?php echo $header; ?>
<div class="container">
<div class="row">
<?php $class = 'col-sm-12'; ?>
<div id="content" class="<?php echo $class; ?>">

<div class="resultado-pagseguro">
<div style="text-align: center;">
  <h2>Ops, problema no pagamento!</h2>
  <p>Ocorreu um erro ao processar o seu pagamento junto a GerenciaNet!<br><br><?php echo $erro;?></p>
  <br>
  <a href="<?php echo $continue;?>">Clique aqui</a> e tente novamente outro pagamento.
</div>
</div>

</div>
</div>
</div>
<?php echo $footer; ?>