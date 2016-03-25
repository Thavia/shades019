<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();

			if ($this->config->get('cosyone_use_custom_font')) {
			$this->document->addStyle('//fonts.googleapis.com/css?family=' . $this->config->get('cosyone_font1_import'));
			$this->document->addStyle('//fonts.googleapis.com/css?family=' . $this->config->get('cosyone_font2_import'));
			} else {
			$this->document->addStyle('//fonts.googleapis.com/css?family=Roboto:300,400,500,600');
			$this->document->addStyle('//fonts.googleapis.com/css?family=Roboto+Slab:300,400,600,700');
			}
			$data['cosyone_styles'] = $this->load->controller('common/cosyone_styles');
			$data['cosyone_cookie'] = $this->load->controller('common/cosyone_cookie');	
			$data['header_login'] = $this->load->controller('common/header_login');
			$data['header_wishlist_compare'] = $this->load->controller('common/header_wishlist_compare');
			$data['cosyone_default_product_style'] = $this->config->get('cosyone_default_product_style');
			$data['cosyone_use_custom'] = $this->config->get('cosyone_use_custom');
			$data['cosyone_container_layout'] = $this->config->get('cosyone_container_layout');
			$data['cosyone_use_breadcrumb'] = $this->config->get('cosyone_use_breadcrumb');
			$data['cosyone_menu_sticky'] = $this->config->get('cosyone_menu_sticky');
			$data['cosyone_menu_border'] = $this->config->get('cosyone_menu_border');
			$data['cosyone_header_style'] = $this->config->get('cosyone_header_style');
			$data['cosyone_header_search'] = $this->config->get('cosyone_header_search');
			$data['cosyone_menu_mega_second_thumb'] = $this->config->get('cosyone_menu_mega_second_thumb');
			$data['cosyone_menu_block_width'] = $this->config->get('cosyone_menu_block_width');
			$data['cosyone_custom_menu_block'] = $this->config->get('cosyone_custom_menu_block');
			$data['cosyone_custom_menu_url1'] = $this->config->get('cosyone_custom_menu_url1');
			$data['cosyone_custom_menu_url2'] = $this->config->get('cosyone_custom_menu_url2');
			$cosyone_top_promo = $this->config->get('cosyone_top_promo_message');
			if(empty($cosyone_top_promo[$this->language->get('code')])) {
				$data['cosyone_top_promo_message'] = false;
			} else if (isset($cosyone_top_promo[$this->language->get('code')])) {
				$data['cosyone_top_promo_message'] = html_entity_decode($cosyone_top_promo[$this->language->get('code')], ENT_QUOTES, 'UTF-8');
			}
			$cosyone_menu_block_title = $this->config->get('cosyone_custom_menu_block_title');
			if(empty($cosyone_menu_block_title[$this->language->get('code')])) {
				$data['cosyone_custom_menu_block_title'] = false;
			} else if (isset($cosyone_menu_block_title[$this->language->get('code')])) {
				$data['cosyone_custom_menu_block_title'] = html_entity_decode($cosyone_menu_block_title[$this->language->get('code')], ENT_QUOTES, 'UTF-8');
			}
			$cosyone_menu_custom_block = $this->config->get('cosyone_menu_custom_block_content');
			if(empty($cosyone_menu_custom_block[$this->language->get('code')])) {
				$data['cosyone_menu_custom_block_content'] = false;
			} else if (isset($cosyone_menu_custom_block[$this->language->get('code')])) {
				$data['cosyone_menu_custom_block_content'] = html_entity_decode($cosyone_menu_custom_block[$this->language->get('code')], ENT_QUOTES, 'UTF-8');
			}
			$cosyone_menu_custom_link1 = $this->config->get('cosyone_custom_menu_title1');
			if(empty($cosyone_menu_custom_link1[$this->language->get('code')])) {
				$data['cosyone_custom_menu_title1'] = false;
			} else if (isset($cosyone_menu_custom_link1[$this->language->get('code')])) {
				$data['cosyone_custom_menu_title1'] = html_entity_decode($cosyone_menu_custom_link1[$this->language->get('code')], ENT_QUOTES, 'UTF-8');
			}
			$cosyone_menu_custom_link2 = $this->config->get('cosyone_custom_menu_title2');
			if(empty($cosyone_menu_custom_link2[$this->language->get('code')])) {
				$data['cosyone_custom_menu_title2'] = false;
			} else if (isset($cosyone_menu_custom_link2[$this->language->get('code')])) {
				$data['cosyone_custom_menu_title2'] = html_entity_decode($cosyone_menu_custom_link2[$this->language->get('code')], ENT_QUOTES, 'UTF-8');
			}
			$data['cosyone_show_home_icon'] = $this->config->get('cosyone_show_home_icon');
			$data['cosyone_max_width'] = $this->config->get('cosyone_max_width');
			$data['cosyone_use_responsive'] = $this->config->get('cosyone_use_responsive');
			$data['cosyone_header_cart'] = $this->config->get('cosyone_header_cart');
			// Cosyone ends
		

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		if ($this->config->get('config_google_analytics_status')) {
			if ($this->config->get('config_google_analytics_status')) {
			$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['google_analytics'] = '';
		}
		} else {
			$data['google_analytics'] = '';
		}

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		// cosyone custom code start
		$this->load->language('common/cosyone');
		$data['cosyone_text_mobile_menu'] = $this->language->get('cosyone_text_mobile_menu');
		// Cosyone ends
		
		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');
		$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['login'] = $this->url->link('account/login', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');
		$data['mytemplate'] = $this->config->get('config_template');

		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		// Custom categories starts
		// Add current class for active categories
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}
		
		if (isset($parts[0])) {
			$data['category_1_id'] = $parts[0];
		} else {
			$data['category_1_id'] = 0;
		}
					
		$categories_1 = $this->model_catalog_category->getCategories(0);
		$this->load->model('tool/image');
		foreach ($categories_1 as $category_1) {
		if ($category_1['top']) {
			$level_2_data = array();
			$categories_2 = $this->model_catalog_category->getCategories($category_1['category_id']);
			foreach ($categories_2 as $category_2) {
				$level_3_data = array();

				// Third level
				$categories_3 = $this->model_catalog_category->getCategories($category_2['category_id']);

				foreach ($categories_3 as $category_3) {
					
					$total = $this->model_catalog_product->getTotalProducts(array('filter_category_id'  => $category_3['category_id']));

					$level_3_data[] = array(
					'name' => $category_3['name'] .($this->config->get('config_product_count') ?  ' (' . $total . ')' : ''),
					'href' => $this->url->link('product/category', 'path=' . $category_1['category_id'] . '_' . $category_2['category_id'] . '_' . $category_3['category_id'])
					);
				 } 
				
				// Second level
				$categories_2 = $this->model_catalog_category->getCategories(0);
				
				$total = $this->model_catalog_product->getTotalProducts(array('filter_category_id'  => $category_2['category_id'], 'filter_sub_category' => true));
				
        		if ($category_2['image']) {
				$category_2_image = $this->model_tool_image->resize($category_2['image'], $this->config->get('cosyone_menu_mega_second_image_w'), $this->config->get('cosyone_menu_mega_second_image_h'));
				} else {
				$category_2_image = '';
				}
				$level_2_data[] = array(
					'name'    	=> $category_2['name']  .($this->config->get('config_product_count') ?  '<span>' . ' (' . $total . ')' . '</span>' : ''),
					'thumb' 	=> $category_2_image,
					'children'	=> $level_3_data,
					'href'    	=> $this->url->link('product/category', 'path=' . $category_1['category_id'] . '_' . $category_2['category_id'])
				);					
		}
			
				// First level
			$data['categories'][] = array(
				'category_1_id' => $category_1['category_id'],
				'column'   => $category_1['column'] ? $category_1['column'] : 1,
				'name'     => $category_1['name'],
				'children' => $level_2_data,
				'href'     => $this->url->link('product/category', 'path=' . $category_1['category_id'])
			);
		}
	}
	// Custom categories ends
	





























		

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}
		
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data);
		}
		
	}
}