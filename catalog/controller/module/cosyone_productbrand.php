<?php
class ControllerModuleCosyoneProductbrand extends Controller {
		public function index() {
			
			$this->load->model('tool/image');

			$this->load->model('catalog/product');

			if (isset($this->request->get['product_id'])) {
				$product_id = (int)$this->request->get['product_id'];
			} else {
				$product_id = 0;
			}
		
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			$image_h = $this->config->get('cosyone_productbrand_height');
			$image_w = $this->config->get('cosyone_productbrand_width');

			if (isset($this->request->get['product_id'])){
			
			// Start manufacturer image
			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($product_info['manufacturer_id']);

			if($manufacturer_info){
			$data['manufacturer_img'] = $this->model_tool_image->resize($manufacturer_info['image'], $image_w, $image_h);
			$data['manufacturer_url'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
			} else {
			$data['manufacturer_img'] = false;
			}
			// End manufacturer image

			}
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/cosyone_productbrand.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/cosyone_productbrand.tpl', $data);
			} else {
				return $this->load->view('default/template/module/cosyone_productbrand.tpl', $data);
			}
	}
}