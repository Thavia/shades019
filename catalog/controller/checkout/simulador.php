<?php
class ControllerCheckoutSimulador extends Controller {
	public function index() {
		//define cep de entrega
		$this->session->data['shipping_address'] = array(
				'firstname'      => '',
				'lastname'       => '',
				'company'        => '',
				'address_1'      => '',
				'address_2'      => '',
				'postcode'       => $this->request->post['cep'],
				'city'           => '',
				'zone_id'        => 0,
				'zone'           => '',
				'zone_code'      => '',
				'country_id'     => 0,
				'country'        => '',
				'iso_code_2'     => '',
				'iso_code_3'     => '',
				'address_format' => ''
		);
		//store session current if exist
		if(isset($this->session->data['cart'])){
			$this->session->data['cart_salva'] = $this->session->data['cart'];	
			unset($this->session->data['cart']);
		}
		//new session simulator product
		$this->cart->add($this->request->post['id'], $this->request->post['qtd'], false, 0);
		//calcula o frete
		$quote_data = array();
		$this->load->model('extension/extension');
		$results = $this->model_extension_extension->getExtensions('shipping');
		foreach ($results as $result) {
			if ($this->config->get($result['code'] . '_status')) {
				$this->load->model('shipping/' . $result['code']);
				$quote = $this->{'model_shipping_' . $result['code']}->getQuote($this->session->data['shipping_address']);
				if ($quote) {
					if(count($quote['quote'])>0){
					$quote_data[$result['code']] = array(
						'title'      => $quote['title'],
						'quote'      => $quote['quote'],
						'sort_order' => $quote['sort_order'],
						'error'      => $quote['error']
					);
					}
				}
			}
		}
		$sort_order = array();
		foreach ($quote_data as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}
		array_multisort($sort_order, SORT_ASC, $quote_data);
		if(count($quote_data)>0){
			$resultados['erro'] =false;
			$resultados['cotas'] = $quote_data;
		}else{
			$resultados['erro'] =true;
			$resultados['cotas'] = 'Nenhum meio de entrega disponível!';
		}
			
		//limpa a nova session
		if(isset($this->session->data['cart'])){
			unset($this->session->data['cart']);
		}
		//recria a session antiga
		if(isset($this->session->data['cart_salva'])){
			$this->session->data['cart'] = $this->session->data['cart_salva'];
			unset($this->session->data['cart_salva']);
		}
		//retorna o json
		echo json_encode($resultados);
	}
}