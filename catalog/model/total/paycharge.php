<?php 
class ModelTotalPaycharge extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if ($this->config->get('paycharge_status') && isset($this->session->data['payment_method']['code']) && $this->cart->getSubTotal()) {
			foreach ($this->config->get('paycharge') as $paycharge) {
				if ($paycharge['payment_method'] == $this->session->data['payment_method']['code']) {
					$total_data[] = array(
						'code'       => 'paycharge',
						'title'      => $paycharge['description'][$this->config->get('config_language_id')]['name'] . ' (' . $paycharge['valuep'] . '%' . ')',
        				'value'      => ($total / 100 * $paycharge['valuep']),
						'sort_order' => $this->config->get('paycharge_sort_order')
					);

					$total += ($total / 100 * $paycharge['valuep']);
				}
			}
		}
	}
}