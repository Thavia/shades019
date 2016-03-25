<?php
class ControllerModuleParcelas extends Controller {
	
	private $error = array();

	public function index() {
		$this->load->language('module/parcelas');
		$this->document->setTitle('Parcelas P&aacute;gina do Produto (OCMOD) [Loja5]');

		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_setting_setting->editSetting('parcelas', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('module/parcelas', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['help_product'] = $this->language->get('help_product');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Parcelas P&aacute;gina do Produto [Loja5]',
			'href' => $this->url->link('module/parcelas', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/parcelas', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->post['parcelas_status'])) {
			$data['parcelas_status'] = $this->request->post['parcelas_status'];
		} else {
			$data['parcelas_status'] = $this->config->get('parcelas_status'); 
		}
		
		if (isset($this->request->post['parcelas_desconto'])) {
			$data['parcelas_desconto'] = $this->request->post['parcelas_desconto'];
		} else {
			$data['parcelas_desconto'] = $this->config->get('parcelas_desconto'); 
		}
		
		if (isset($this->request->post['parcelas_dividir'])) {
			$data['parcelas_dividir'] = $this->request->post['parcelas_dividir'];
		} else {
			$data['parcelas_dividir'] = $this->config->get('parcelas_dividir'); 
		}
		
		if (isset($this->request->post['parcelas_dividir_sem'])) {
			$data['parcelas_dividir_sem'] = $this->request->post['parcelas_dividir_sem'];
		} else {
			$data['parcelas_dividir_sem'] = $this->config->get('parcelas_dividir_sem'); 
		}
		
		if (isset($this->request->post['parcelas_minimo'])) {
			$data['parcelas_minimo'] = $this->request->post['parcelas_minimo'];
		} else {
			$data['parcelas_minimo'] = $this->config->get('parcelas_minimo'); 
		}
		
		if (isset($this->request->post['parcelas_layout'])) {
			$data['parcelas_layout'] = $this->request->post['parcelas_layout'];
		} else {
			$data['parcelas_layout'] = $this->config->get('parcelas_layout'); 
		}
		
		if (isset($this->request->post['parcelas_tipo'])) {
			$data['parcelas_tipo'] = $this->request->post['parcelas_tipo'];
		} else {
			$data['parcelas_tipo'] = $this->config->get('parcelas_tipo'); 
		}
		
		if (isset($this->request->post['parcelas_juros'])) {
			$data['parcelas_juros'] = $this->request->post['parcelas_juros'];
		} else {
			$data['parcelas_juros'] = $this->config->get('parcelas_juros'); 
		}
		
		if (isset($this->request->post['parcelas_tab'])) {
			$data['parcelas_tab'] = $this->request->post['parcelas_tab'];
		} else {
			$data['parcelas_tab'] = $this->config->get('parcelas_tab'); 
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/parcelas.tpl', $data));
	}	
}