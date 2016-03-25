<?php
include("app/gn5/vendor/autoload.php");
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

class ControllerPaymentGN5Boleto extends Controller {
	public function index() {	
		$this->load->model('checkout/order');
		$this->language->load('payment/cod');
		
		//meios
		$data['bo'] = $this->config->get('gn5_boleto');
		$data['cc'] = false;
		
		//modo
		$data['modo'] = $this->config->get('gn5_modo');
		
		//conta
		$data['conta'] = $this->config->get('gn5_conta');

		//opcoes gerencianet
		$options = array(
		"client_id"=>trim($this->config->get('gn5_id')),
		"client_secret"=>trim($this->config->get('gn5_sec')),
		"sandbox"=>(($data['modo']==0)?true:false),
		"debug"=>false
		);

		//retorno
		$data['url_criar'] = $this->url->link('payment/gn5/criar');
		
		//dados pedido
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		$data['pedido'] = $order_info;
		//print_r($order_info);
		
		//se ja vai com fiscal
		$fiscal = '';
		$custom_fiscal = $this->config->get('gn5_fiscal');
		if(isset($order_info['custom_field'][$custom_fiscal])){
		$fiscal = preg_replace('/\D/', '', $order_info['custom_field'][$custom_fiscal]);	
		}
		$data['fiscal'] = $fiscal;
		
		$items = [[
		'name' => 'Pedido #'.$order_info['order_id'].' em '.$order_info['store_name'].'',
		'amount' => 1,
		'value' => (float)number_format($order_info['total'], 2, '', '')
		]];
		
        //todos os itens  
		$body = [
		'items' => $items,
		'metadata' => [
			'custom_id' => (string)$order_info['order_id'],
			'notification_url' => $this->url->link('payment/gn5/ipn','','SSL'),
		]
		];
		
		try {
			
			$api = new Gerencianet($options);
			$data['charge'] = $api->createCharge([], $body);
			
			//totais
			$data['total_pedido'] = $this->currency->format($order_info['total']);
			
			//totais floatval
			$data['total_pedido_float'] = $order_info['total'];
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/gn5.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/gn5.tpl', $data);
			} else {
				return $this->load->view('default/template/payment/gn5.tpl', $data);
			}
			
		} catch (GerencianetException $e) {
			return $this->erro_exception($e->errorDescription);
		} catch (Exception $e) {
			return $this->erro_exception($e->getMessage());
		}
	}
	
	public function erro_exception($erro){
		return '<div class="alert alert-danger warning" role="alert"><i class="fa fa-exclamation-circle"></i> '.(is_array($erro)?$erro['message']:$erro).'</div>';
	}
}
?>