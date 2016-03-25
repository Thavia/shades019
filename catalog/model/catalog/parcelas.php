<?php
class ModelCatalogParcelas extends Model {
	
	public function getValor($produto_id){
		
		$layout = $this->config->get('parcelas_layout');
		$total_produto = $produto_avista = $this->totalProduto($produto_id);
		$taxa_desconto = $this->config->get('parcelas_desconto');
		
		if($total_produto==0){
		return '';	
		}
		
		if($taxa_desconto>0){
			$produto_avista = $total_produto-(($total_produto/100)*$taxa_desconto);
		}
		
		if($this->config->get('parcelas_tab')){
			$tabelas = $this->tabelaDupla($total_produto);
		}else{
			$tabelas = $this->tabelaSimples($total_produto);
		}
		
		$parcela = $this->calcularParcela($total_produto);

		$html = str_replace('[avista]',$this->currency->format($produto_avista),$layout);
		$html = str_replace('[desconto]',$taxa_desconto,$html);
		$html = str_replace('[parcelas]',$parcela['par'],$html);
		$html = str_replace('[valor_parcela]',$this->currency->format($parcela['parcela']),$html);
		$html = str_replace('[com_sem_juros]',$parcela['tipo'],$html);
		$html = str_replace('[tabela_parcelas]',$tabelas,$html);
		
		return htmlspecialchars_decode($html);
		
		
	}
	public function totalProduto($produto_id){
		$this->load->model('catalog/product');
		$product_info = $this->model_catalog_product->getProduct($produto_id);
		if ((float)$product_info['special']) {
			return $this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax'));
		} else {
			return $this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'));
		}		
	}
	public function calcularParcela($total){
		$minimo = (float)($this->config->get('parcelas_minimo')==0)?5:$this->config->get('parcelas_minimo');
		$div = (int)$this->config->get('parcelas_dividir');
		$sem = (int)$this->config->get('parcelas_dividir_sem');
		$tipo = $this->config->get('parcelas_tipo');
		$juros = $this->config->get('parcelas_juros');
		$split = (int)($total/$minimo);
		if($split>=$div){
			$par = (int)$div;
		}elseif($split<$div && $split>0){
			$par = (int)$split;
		}elseif($total<=$minimo){
			$par = 1;
		}

		$tipo_frase = ($par<=$sem)?'sem juros':'com juros';
		$parv = ($par>0)?($total/$par):$total;
		
		if($tipo==0){
			return array('par'=>$par,'tipo'=>$tipo_frase,'parcela'=>$parv);
		}elseif($tipo==1){
			if($par>$sem){
			$parv = $this->jurosSimples($total, $juros, $par);
			}
			return array('par'=>$par,'tipo'=>$tipo_frase,'parcela'=>$parv);
		}elseif($tipo==2){
			if($par>$sem){
			$parv = $this->jurosComposto($total, $juros, $par);
			}
			return array('par'=>$par,'tipo'=>$tipo_frase,'parcela'=>$parv);
		}elseif($tipo==3){
			if($par>$sem){
			$parv = $this->juros_price($total, $par, $juros);
			}
			return array('par'=>$par,'tipo'=>$tipo_frase,'parcela'=>$parv);
		}
		
	}
	public function tabelaSimples($total){
		$html = '<table class="table table-bordered">';
		$minimo = (float)($this->config->get('parcelas_minimo')==0)?5:$this->config->get('parcelas_minimo');
		$div = (int)$this->config->get('parcelas_dividir');
		$sem = (int)$this->config->get('parcelas_dividir_sem');
		$tipo = $this->config->get('parcelas_tipo');
		$juros = $this->config->get('parcelas_juros');
		
		$split = (int)($total/$minimo);
		if($split>=$div){
			$par = $div;
		}elseif($split<$div){
			$par = $split;
		}elseif($total<=$minimo){
			$par = 1;
		}
		
		for($i=1;$i<=$par;$i++){
		
		$parv = ($total/$i);		
		if($tipo==1){
			if($i>$sem){
			$parv = $this->jurosSimples($total, $juros, $i);
			}
		}elseif($tipo==2){
			if($i>$sem){
			$parv = $this->jurosComposto($total, $juros, $i);
			}
		}elseif($tipo==3){
			if($i>$sem){
			$parv = $this->juros_price($total, $i, $juros);
			}
		}
			
		$html .= '<tr>
          <td>'.$i.'x</td>
          <td>'.$this->currency->format($parv).'</td>
          <td>'.(($i<=$sem)?'sem juros':'com juros').'</td>
        </tr>';
		
		}
		
		$html .= '</table>';
		return $html;
	}
	public function tabelaDupla($total){
		$html = '<table class="table table-bordered"><tr>';
		$minimo = (float)($this->config->get('parcelas_minimo')==0)?5:$this->config->get('parcelas_minimo');
		$div = (int)$this->config->get('parcelas_dividir');
		$sem = (int)$this->config->get('parcelas_dividir_sem');
		$tipo = $this->config->get('parcelas_tipo');
		$juros = $this->config->get('parcelas_juros');
		
		$split = (int)($total/$minimo);
		if($split>=$div){
			$par = $div;
		}elseif($split<$div){
			$par = $split;
		}elseif($total<=$minimo){
			$par = 1;
		}
		
		for($i=1;$i<=$par;$i++){
		
		$parv = ($total/$i);		
		if($tipo==1){
			if($i>$sem){
			$parv = $this->jurosSimples($total, $juros, $i);
			}
		}elseif($tipo==2){
			if($i>$sem){
			$parv = $this->jurosComposto($total, $juros, $i);
			}
		}elseif($tipo==3){
			if($i>$sem){
			$parv = $this->juros_price($total, $i, $juros);
			}
		}
			
		$html .= '
        <td>'.$i.'x</td>
        <td>'.$this->currency->format($parv).'</td>
        <td>'.(($i<=$sem)?'sem juros':'com juros').'</td>';
		  
		if($i%2==0){
		 $html .= '</tr><tr>';
		}
		
		}
		
		$html .= '</table>';
		return $html;
	}
	public function juros_price($Valor, $Parcelas, $Juros) {
		$Juros = bcdiv($Juros,100,15);
		$E=1.0;
		$cont=1.0;
		for($k=1;$k<=$Parcelas;$k++) {
		$cont= bcmul($cont,bcadd($Juros,1,15),15);
		$E=bcadd($E,$cont,15);
		}
		$E=bcsub($E,$cont,15);
		$Valor = bcmul($Valor,$cont,15);
		return bcdiv($Valor,$E,15);
	}
	public function jurosSimples($valor, $taxa, $parcelas) {
        $taxa = $taxa/100;
		$m = $valor * (1 + $taxa * $parcelas);
		$valParcela = $m/$parcelas;
		return $valParcela;
	}
	public function jurosComposto($valor, $taxa, $parcelas) {
        $taxa = $taxa / 100;
        $valParcela = $valor * pow((1 + $taxa), $parcelas);
        $valParcela = $valParcela/$parcelas;
        return $valParcela;
	}
}