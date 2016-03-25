<?php 
class ControllerCommonHeaderWishlistCompare extends Controller {
	public function index() {
		
		$data['cosyone_header_wishlist'] = $this->config->get('cosyone_header_wishlist');
		$data['cosyone_header_compare'] = $this->config->get('cosyone_header_compare');
		
		$this->load->language('module/header_wishlist_compare');
		
		$data['text_header_wishlist'] = sprintf($this->language->get('text_header_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$data['wishlist_link'] = $this->url->link('account/wishlist', '', 'SSL');
		
		
		$data['text_header_compare'] = sprintf($this->language->get('text_header_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		$data['compare_link'] = $this->url->link('product/compare', '', 'SSL');

			return $this->load->view('cosyone/template/common/header_wishlist_compare.tpl', $data);
			
	}
	public function info() {
		$this->response->setOutput($this->index());
	}
}