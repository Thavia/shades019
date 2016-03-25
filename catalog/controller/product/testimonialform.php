<?php 
// RegEx
define('EMAIL_PATTERN', '/^[^\@]+@.*\.[a-z]{2,6}$/i');
 
class ControllerProductTestimonialform extends Controller {
	private $error = array(); 

	protected function str_split_unicode($str, $l = 0) {
	    if ($l > 0) {
	        $ret = array();
	        $len = mb_strlen($str, "UTF-8");
	        for ($i = 0; $i < $len; $i += $l) {
	            $ret[] = mb_substr($str, $i, $l, "UTF-8");
	        }
	        return $ret;
	    }
	    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
	}

  		public function index() {
		$this->language->load('product/testimonialform');
		$this->document->SetTitle( $this->language->get('heading_title'));
	   	$data['heading_title'] = $this->language->get('heading_title');

		$this->language->load('module/testimonial');
		$data['show_all'] = $this->language->get('show_all');
		$data['showall_url'] = $this->url->link('product/testimonial', '', 'SSL');
		$data['button_send'] = $this->language->get('button_send');

		$this->load->model('catalog/testimonial');
 
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
			$data['data']=array();
			$data['data']['name'] = strip_tags(html_entity_decode($this->request->post['name']));
			$data['data']['city'] = strip_tags(html_entity_decode($this->request->post['city']));
			$data['data']['rating'] = $this->request->post['rating'];				
			$data['data']['email'] = strip_tags(html_entity_decode($this->request->post['email']));
			$data['data']['title'] = strip_tags(html_entity_decode($this->request->post['title']));

			$data['data']['description'] = strip_tags(html_entity_decode($this->request->post['description']));


			$descriptions = explode(" ", $data['data']['description']);
			$size = count($descriptions);
			for($i=0; $i<$size; $i++)
			{ 
				$w_arr = $this->str_split_unicode($descriptions[$i],14);
				$descriptions[$i] = implode(" ",$w_arr);

			}
			
			$data['data']['description'] = implode(" ",$descriptions);

			if ($this->config->get('testimonial_admin_approved')=='')
				$this->model_catalog_testimonial->addTestimonial($data['data'], 1);
			else
				$this->model_catalog_testimonial->addTestimonial($data['data'], 0);

			$this->session->data['success'] = $this->language->get('text_add');
			
			

			// send email
			if ($this->config->get('testimonial_send_to_admin')!='') {
				
				$store_name = $this->config->get('config_name');
				$subject = sprintf($this->language->get('text_subject'), $data['data']['name'], $store_name);
				$message  = '<html>'.$this->language->get('text_header') . "<br>";
				
				$message .= $data['data']['description']. "<br>";
	
				$message .= $this->language->get('text_footer')."</html>";
	
				$email = $data['data']['email'];
				if ($email == "") $email = "empty";

				$sender = $data['data']['name'];
				if ($sender == "") $sender = "empty";
				
			
				$mail = new Mail($this->config->get('config_mail'));
				$mail->setFrom($email);
				$mail->setTo($this->config->get('config_email'));
				$mail->setSender($sender);
				$mail->setSubject($subject);
				$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
				$mail->send();

			}
			
			$this->response->redirect($this->url->link('product/testimonialform/success'));
		}
			
      	$data['breadcrumbs'] = array();

      	$data['breadcrumbs'][] = array(
	        	'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', '', 'SSL')
      	);

      	$data['breadcrumbs'][] = array(
	        	'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('product/testimonialform', '', 'SSL')
      	);			

	    $data['entry_title'] = $this->language->get('entry_title');
	
	    $data['entry_name'] = $this->language->get('entry_name');
	    $data['entry_city'] = $this->language->get('entry_city');
	    $data['entry_email'] = $this->language->get('entry_email');
	    $data['entry_enquiry'] = $this->language->get('entry_enquiry');
		$data['entry_captcha'] = $this->language->get('entry_captcha');
		$data['entry_rating'] = $this->language->get('entry_rating');
		$data['entry_good'] = $this->language->get('entry_good');
		$data['entry_bad'] = $this->language->get('entry_bad');
		$data['text_note'] = $this->language->get('text_note');
		$data['text_conditions'] = $this->language->get('text_conditions');


		if (isset($this->error['name'])) {
    		$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		if (isset($this->error['title'])) {
    		$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = '';
		}
		
		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}		
			
		if (isset($this->error['enquiry'])) {
			$data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$data['error_enquiry'] = '';
		}		
		
 		if (isset($this->error['captcha'])) {
			$data['error_captcha'] = $this->error['captcha'];
		} else {
			$data['error_captcha'] = '';
		}
		
    	$data['button_continue'] = $this->language->get('button_continue');
    
		$data['action'] = $this->url->link('product/testimonialform');

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} else {
			$data['name'] = '';
		}
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} else {
			$data['city'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}
		if (isset($this->request->post['title'])) {
			$data['title'] = $this->request->post['title'];
		} else {
			$data['title'] = '';
		}
		
		if (isset($this->request->post['rating'])) {
			$data['rating'] = $this->request->post['rating'];
		} else {
			if ($this->config->get('testimonial_default_rating')=='')
				$data['rating'] = '3';
			else
				$data['rating'] = $this->config->get('testimonial_default_rating');

		}
		
		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} else {
			$data['description'] = '';
		}
		
		if ($this->config->get('config_google_captcha_status')) {
			$this->document->addScript('https://www.google.com/recaptcha/api.js');

			$data['site_key'] = $this->config->get('config_google_captcha_public');
		} else {
			$data['site_key'] = '';
		}	
	
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/testimonialform.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/testimonialform.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/testimonialform.tpl', $data));
		}
		
  	}

  	public function success() {
		$this->language->load('product/testimonialform');

		$this->document->SetTitle($this->language->get('sent_testimonial')); 

	     	$data['breadcrumbs'] = array();

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', '', 'SSL')
      	);

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('product/testimonialform', '', 'SSL')
      	);			
		
	    	$data['heading_title'] = $this->language->get('heading_title');
	
	    	$data['text_message'] = $this->language->get('text_message');
	
	    	$data['button_continue'] = $this->language->get('button_continue');
	
    		$data['continue'] = $this->url->link('common/home', '', 'SSL');
			
			$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/success.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/success.tpl', $data));
		} 
	}
	
  	private function validate() {

			if ((utf8_strlen($this->request->post['description']) < 10) || (utf8_strlen($this->request->post['description']) > 3000)) {
			$this->error['enquiry'] = $this->language->get('error_enquiry');
		}
	
	    	if ($this->config->get('config_google_captcha_status')) {
			$recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->config->get('config_google_captcha_secret')) . '&response=' . $this->request->post['g-recaptcha-response'] . '&remoteip=' . $this->request->server['REMOTE_ADDR']);

			$recaptcha = json_decode($recaptcha, true);

			if (!$recaptcha['success']) {
				$this->error['captcha'] = $this->language->get('error_captcha');
			}
		}

		return !$this->error;  
  	}
}