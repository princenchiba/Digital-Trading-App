<?php
/**
 *  ... Please MODIFY this file ...
 *
 *
 *  YOUR MYSQL DATABASE DETAILS
 *
 */
 $CI =& get_instance();

 define("DB_HOST", 	$CI->db->hostname);		// hostname
 define("DB_USER", 	$CI->db->username);		// database username
 define("DB_PASSWORD", 	$CI->db->password);	// database password
 define("DB_NAME", 	$CI->db->database);		// database name


/**
 *  ARRAY OF ALL YOUR CRYPTOBOX PRIVATE KEYS
 *  Place values from your gourl.io signup page
 *  array("your_privatekey_for_box1", "your_privatekey_for_box2 (otional)", "etc...");
 */
 $CI =& get_instance();
 $gateway = $CI->db->select('*')->from('payment_gateway')->where('identity', 'bitcoin')->where('status', 1)->get()->row();

 $cryptobox_private_keys = array();

 $pri_key = unserialize($gateway->private_key);

 foreach ($pri_key as $key => $value) { 
	if ($value) {
		array_push($cryptobox_private_keys, $value);

	}

 }


 define("CRYPTOBOX_PRIVATE_KEYS", implode("^", $cryptobox_private_keys));
 unset($cryptobox_private_keys);

?>