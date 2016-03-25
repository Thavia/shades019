<?php 
echo $header; 
?>

<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script>
$(function(){
$(".dinheiro").maskMoney({thousands:'', decimal:'.', allowZero:true, suffix: ''});
});
</script>


<?php echo $column_left; ?>

<div id="content">
<div class="page-header">
<div class="container-fluid">
<div class="pull-right">

<button type="submit" form="salva-config-parcelas" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>

<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>

</div>
<h1><?php echo $heading_title; ?></h1>
<ul class="breadcrumb">
<?php foreach ($breadcrumbs as $breadcrumb) { ?>
<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
<?php } ?>
</ul>
</div>
</div>
<div class="container-fluid">

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-pencil"></i> Parcelas P&aacute;gina do Produto (OCMOD) [Loja5]</h3>
</div>
<div class="panel-body">

<form action="<?php echo $action; ?>" method="post" id="salva-config-parcelas" class="form-horizontal" enctype="multipart/form-data">

<div class="form-group">
<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
<div class="col-sm-10">
<select name="parcelas_status" id="input-status" class="form-control">
<?php if ($parcelas_status) { ?>
<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
<option value="0"><?php echo $text_disabled; ?></option>
<?php } else { ?>
<option value="1"><?php echo $text_enabled; ?></option>
<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input-status">Desconto &agrave; vista %</label>
<div class="col-sm-10">
<input type="text" class="form-control dinheiro" name="parcelas_desconto" value="<?php echo $parcelas_desconto;?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input-status">Dividir em at&eacute;</label>
<div class="col-sm-10">
<input type="number" class="form-control" min="1" max="12" name="parcelas_dividir" value="<?php echo $parcelas_dividir;?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input-status">Dividir sem juros at&eacute;</label>
<div class="col-sm-10">
<input type="number" class="form-control" min="1" max="12" name="parcelas_dividir_sem" value="<?php echo $parcelas_dividir_sem;?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input-status">Parcela minima</label>
<div class="col-sm-10">
<input type="text" class="form-control dinheiro" name="parcelas_minimo" value="<?php echo $parcelas_minimo;?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input-status">Tipo juros</label>
<div class="col-sm-10">
<select name="parcelas_tipo" id="input-status" class="form-control">

<?php
$juros[0] = 'Sem juros';
$juros[1] = 'Juros simples';
$juros[2] = 'Juros composto';
$juros[3] = 'Juros price';
?>

<?php foreach($juros AS $k=>$v) { ?>
<option value="<?php echo $k;?>"<?php echo ($parcelas_tipo==$k)?' selected':'';?>><?php echo $v; ?></option>
<?php } ?>

</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input-status">Taxa de juros %</label>
<div class="col-sm-10">
<input type="text" class="form-control dinheiro" name="parcelas_juros" value="<?php echo $parcelas_juros;?>">
</div>
</div>

<?php
$htmlLimpo = '<p><span style="color: rgb(57, 123, 33); font-size: 30px; font-weight: bold;">[avista]</span> <span style="color: rgb(57, 123, 33);font-size:16px;">à vista com [desconto]% de desconto<br></span></p>
<p style="font-size:14px;">Em até [parcelas]X de [valor_parcela] [com_sem_juros]</p>
<p><img src="'.HTTPS_CATALOG.'/image/bandeiras-parcelamento.gif"><br><br></p>';
?>

<div class="form-group">
<label class="col-sm-2 control-label" for="input-description">Layout &agrave; exibir</label>
<div class="col-sm-10">
<textarea name="parcelas_layout" placeholder="Layout" id="layout" class="form-control"><?php echo empty($parcelas_layout)?$htmlLimpo:$parcelas_layout; ?>
</textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input-status">Parcelamento Tabela Tipo</label>
<div class="col-sm-10">
<select name="parcelas_tab" id="input-status" class="form-control">
<?php if ($parcelas_tab) { ?>
<option value="1" selected="selected">Dupla</option>
<option value="0">Simples</option>
<?php } else { ?>
<option value="1">Dupla</option>
<option value="0" selected="selected">Simples</option>
<?php } ?>
</select>
</div>
</div>

</form>		  

</div>
</div>
</div>

<script type="text/javascript">
<!-- 
$('#layout').summernote({
	height: 150,
	codemirror: { // codemirror options
		theme: 'monokai'
	}
});
//-->
</script>

</div>

<?php echo $footer; ?>