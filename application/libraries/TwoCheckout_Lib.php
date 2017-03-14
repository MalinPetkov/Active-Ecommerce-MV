<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/*

Title: 		CI 2Checkout.com Payment Class
Author:		Craig Christenson
Created: 	06/09/2012

Based on PayPal_lib and 2Checkout PHP Payment Class
http://codeigniter.com/wiki/PayPal_Lib
https://github.com/craigchristenson/2Checkout-Payment-Class-PHP

*/

class TwoCheckout_Lib {

	var $fields = array();		// Parameters
	var $submit_btn = '';		// Button Text
	var $CI;
	
	function TwoCheckout_Lib()
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->helper('form');
		//Using Single Page Checkout
		$this->twocheckout_url = 'https://www.2checkout.com/checkout/spurchase';
	}

	function set_acct_info($seller_id, $secret_word, $demo) 
	{
		//Set 2Checkout account details
		$this->sid = $seller_id;
		$this->secret_word = $secret_word;
		$this->demo = $demo;
	}

	function button($value)
	{
		//Submit button text
		$this->submit_btn = form_submit('submit_btn', $value);
	}

	function add_field($field, $value) 
	{
		//Add parameters to the form
		$this->fields[$field] = $value;
	}

	function remove_field($name)
	{
		//Remove parameters from form
		unset($this->fields[$field]);
	}

	function submit_form() 
	{
		//Builds out HTML form and submits the payment to 2Checkout.
		$this->button('Click here if you\'re not automatically redirected...');

		echo '<html>' . "\n";
		echo '<head><title>Redirecting to 2Checkout...</title></head>' . "\n";
		echo '<body onLoad="document.forms[\'twocheckout_form\'].submit();">' . "\n";
		echo '<p>Please wait, you are being redirected to the checkout page.</p>' . "\n";
		echo $this->twocheckout_form('submit_form');
		echo '</body></html>';
	}

	function twocheckout_form($form_name) 
	{
		$str = '';
		$str .= '<form method="post" action="'.$this->twocheckout_url.'" name="'.$form_name.'"/>' . "\n";
		foreach ($this->fields as $name => $value) {
			$str .= form_hidden($name, $value) . "\n";
		}
		$str .= '<p>'. $this->submit_btn . '</p>';
		$str .= form_close() . "\n";
		return $str;
	}

	function validate_response()
	{	  
		if ($this->CI->input->post('order_number')) {
			foreach ($this->CI->input->post() as $k => $v) {
	            $response[$k] = $v;
	        }
	    } elseif ($this->CI->input->get('order_number')) {
    		foreach ($this->CI->input->get() as $k => $v) {
	            $response[$k] = $v;
	        }
	    }

		//Check to see if Auth.net params are being used and assign variables for hash
		if (isset($response['x_MD5_Hash'])) {
			$hashTotal = $response['x_amount'];
			$returned_hash = $response['x_MD5_Hash'];		
		} elseif (isset($response['key'])) {
			$hashTotal = $response['total'];
			$returned_hash = $response['key'];
		}

		//Assign variables for hash from AcctInfo()
		$hashSecretWord = $this->secret_word;
   	    $hashSid = $this->sid;

		//2Checkout breaks the hash on demo sales, we must do the same here so the hashes match.
		if (($this->demo) == 'Y') {
			$hashOrder = 1;
		} else {
       	    $hashOrder = $response['order_number'];
		}
		//Create hash
        $our_hash = strtoupper(md5($hashSecretWord . $hashSid . $hashOrder . $hashTotal));

		//Compare hashes to check the validity of the sale and print the response
		if ($our_hash == $returned_hash) {            
            $response['status'] = "pass";
			} else {
				$response['status'] = "fail";
		}
		return $response;
	}

}

?>