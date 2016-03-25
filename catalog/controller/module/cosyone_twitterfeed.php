<?php
class ControllerModuleCosyoneTwitterfeed extends Controller {
	public function index() {
		
		$this->document->addScript('catalog/view/theme/cosyone/js/tweetfeed.min.js');
		
		$title = $this->config->get('cosyone_twitterfeed_title');
		if(empty($title[$this->language->get('code')])) {
			$data['module_title'] = false;
		} else if (isset($title[$this->language->get('code')])) {
			$data['module_title'] = html_entity_decode($title[$this->language->get('code')], ENT_QUOTES, 'UTF-8');
		}
		
		$data['widget_id'] = $this->config->get('cosyone_twitterfeed_widget_id');
		
		$data['limit'] = $this->config->get('cosyone_twitterfeed_limit');
			
			
       if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/cosyone_twitterfeed.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/cosyone_twitterfeed.tpl', $data);
			} else {
				return $this->load->view('default/template/module/cosyone_twitterfeed.tpl', $data);
			}
	}
}