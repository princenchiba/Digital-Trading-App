<?php
/**
 *  ... Please MODIFY this file ...
 *
 *
 *  User-defined function (IPN) for new payments
 *  ---------------------------------------------
 *
 *  User-defined function - cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "").
 *  Use this function to send confirmation email, update database, update user membership, etc.
 *  
 *  This IPN function will automatically appear for each new payment usually two times : 
 *  a) when a new payment is received, with values: $box_status = cryptobox_newrecord, $payment_details[confirmed] = 0
 *  b) and a second time when existing payment is confirmed (6+ confirmations) with values: $box_status = cryptobox_updated, $payment_details[confirmed] = 1.
 *  
 *  But sometimes if the payment notification is delayed for 20-30min, the payment/transaction will already be confirmed and the function will
 *  appear once with values: $box_status = cryptobox_newrecord, $payment_details[confirmed] = 1
 *  
 *  If payment received with correct amount, function receive: $payment_details[status] = 'payment_received' and $payment_details[user] = 11, 12, etc (user_id who has made payment)
 *  If incorrectly paid amount, the system can not recognize user; function receive: $payment_details[status] = 'payment_received_unrecognised' and $payment_details[user] = ''
 *
 *  Function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "")
 *  gets $paymentID from your table crypto_payments, $box_status = 'cryptobox_newrecord' OR 'cryptobox_updated' (description above)
 *  and payment details as array -
 * 
 *  1. EXAMPLE - CORRECT PAYMENT -
 *  -----------------------------------------------------
 *  $payment_details = Array
 *        {
 *            "status":"payment_received"
 *            "err":""
 *            "private_key_hash":"85770A30B97D3AC035EC32354633C1614CF76E1621A20B143A1FBDAD1FCBF25A6EC6C5F99FFF495DD1836E47AE0E37942EC0B04867BD14778B2C93967E4A7FAC" // sha512 hash of gourl payment box private_key
 *            "box":"120"
 *            "boxtype":"paymentbox"
 *            "order":"order15620A"
 *            "user":"user26"
 *            "usercountry":"USA"
 *            "amount":"0.0479166"
 *            "amountusd":"11.5"
 *            "coinlabel":"BTC"
 *            "coinname":"bitcoin"
 *            "addr":"14dt2cSbvwghDcETJDuvFGHe5bCsCPR9jW"
 *            "tx":"95ed924c215f2945e75acfb5650e28384deac382c9629cf0d3f31d0ec23db08d"
 *            "confirmed":0
 *            "timestamp":"1422624765"
 *            "date":"30 January 2015"
 *            "datetime":"2015-01-30 13:32:45"
 *        }
 *         						
 *  2. EXAMPLE - INCORRECT PAYMENT/WRONG AMOUNT -
 *  -----------------------------------------------------
 *     $payment_details = Array 
 *        {
 *            "status":"payment_received_unrecognised"
 *            "err":"An incorrect bitcoin amount has been received"
 *            "private_key_hash":"85770A30B97D3AC035EC32354633C1614CF76E1621A20B143A1FBDAD1FCBF25A6EC6C5F99FFF495DD1836E47AE0E37942EC0B04867BD14778B2C93967E4A7FAC" // sha512 hash of gourl payment box private_key
 *            "box":"120"
 *            "boxtype":"paymentbox"
 *            "order":""
 *            "user":""
 *            "usercountry":""
 *            "amount":"12.26"
 *            "amountusd":"0.05"
 *            "coinlabel":"BTC"
 *            "coinname":"bitcoin"
 *            "addr":"14dt2cSbvwghDcETJDuvFGHe5bCsCPR9jW"
 *            "tx":"6f1c6f34189a27446d18e25b9c79db78be55b0bb775b1768b5aa4520f27d71a8"
 *            "confirmed":0
 *            "timestamp":"1422623712"
 *            "date":"30 January 2015"
 *            "datetime":"2015-01-30 13:15:12"
 *        }	 
 *        
 *        Read more - https://gourl.io/api-php.html#ipn
 */





function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "")
{
    /*
	PLACE YOUR CODE HERE

	Update database with new payment, send email to user, etc
	Please note, all received payments store in your table `crypto_payments` also
	See - https://gourl.io/api-php.html#payment_history

	For example, you have own table `user_orders`...
	You can use function run_sql() from cryptobox.class.php ( https://gourl.io/api-php.html#run_sql )
	
	Save new Bitcoin payment in database table `user_orders` */
	if (isset($payment_details['status']) && @$payment_details['status'] == 'payment_received' && $box_status == "cryptobox_newrecord") {
		$recordExists = run_sql("SELECT comment FROM `dbt_deposit` WHERE comment = '".$paymentID."'");
		// $recordExists = run_sql("SELECT paymentID FROM `crypto_payments` WHERE paymentID = '".$paymentID."'");

		if (!$recordExists) {

			$fees = 0;
			$feesExists = run_sql("SELECT * FROM `dbt_fees` WHERE currency_symbol = '".$payment_details["coinlabel"]."' AND level = 'DEPOSIT'");
			if ($feesExists) {
				//$fees = (floatval($payment_details["amount"])/100)*floatval($feesExists->fees);
				$fees_array = explode("_", $payment_details['order']);
				$fees = @$fees_array[1]?@$fees_array[1]:0;
			}


			run_sql("INSERT INTO `dbt_deposit` VALUES(NULL,'".$payment_details["user"]."',".intval(0).",'".$payment_details["coinlabel"]."',".(floatval($payment_details["amount"])-floatval($fees)).",'bitcoin',".floatval($fees).",'".$paymentID."','".gmdate("Y-m-d H:i:s")."','".gmdate("Y-m-d H:i:s")."',".intval(1).",'".@$_SERVER['REMOTE_ADDR']."','".$payment_details["coinname"]."')");


			// $processed = run_sql("select processed as nme FROM `crypto_payments` WHERE orderID = ".$orderID." LIMIT 1");


			$UserRecordExists = run_sql("SELECT * FROM `dbt_balance` WHERE user_id = '".$payment_details["user"]."' AND currency_symbol = '".$payment_details["coinlabel"]."'");

			if (!$UserRecordExists) {
				run_sql("INSERT INTO `dbt_balance` VALUES(NULL,'".$payment_details["user"]."',".intval(0).",'".$payment_details["coinlabel"]."',".(floatval($payment_details["amount"])-floatval($fees)).",'".gmdate("Y-m-d H:i:s")."')");

				$UserNewRecordExists = run_sql("SELECT * FROM `dbt_balance` WHERE user_id = '".$payment_details["user"]."' AND currency_symbol = '".$payment_details["coinlabel"]."'");

				if ($UserNewRecordExists) {
					run_sql("INSERT INTO `dbt_balance_log` VALUES(NULL,'".@$UserNewRecordExists->id."','".$payment_details["user"]."',".intval(0).",'".$payment_details["coinlabel"]."','DEPOSIT', ".(floatval($payment_details["amount"])-floatval($fees)).",'".floatval($fees)."', '".@$_SERVER['REMOTE_ADDR']."', '".gmdate("Y-m-d H:i:s")."')");
				}

			}else{

				$sql = "UPDATE `dbt_balance` SET `balance` = (`balance`+".(floatval($payment_details["amount"])-floatval($fees)).") WHERE user_id = '".$payment_details["user"]."' AND currency_symbol = '".$payment_details["coinlabel"]."' LIMIT 1";
				run_sql($sql);

				run_sql("INSERT INTO `dbt_balance_log` VALUES(NULL,'".@$UserRecordExists->id."','".$payment_details["user"]."',".intval(0).",'".$payment_details["coinlabel"]."','DEPOSIT', ".(floatval($payment_details["amount"])-floatval($fees)).",'".floatval($fees)."', '".@$_SERVER['REMOTE_ADDR']."', '".gmdate("Y-m-d H:i:s")."')");
			}
		}

	}
	
	

	// Received second IPN notification (optional) - Bitcoin payment confirmed (6+ transaction confirmations)
	/*
	
	if ($recordExists && $box_status == "cryptobox_updated")  run_sql("UPDATE `user_orders` SET txconfirmed = ".intval($payment_details["confirmed"])." WHERE paymentID = ".intval($paymentID));


	// Onetime action when payment confirmed (6+ transaction confirmations)
	$processed = run_sql("select processed as nme FROM `crypto_payments` WHERE paymentID = ".intval($paymentID)." LIMIT 1");
	if (!$processed && $payment_details["confirmed"])
	{
		// ... Your code ...

		// ... and update status in default table where all payments are stored - https://github.com/cryptoapi/Payment-Gateway#mysql-table
		$sql = "UPDATE crypto_payments SET processed = 1, processedDate = '".gmdate("Y-m-d H:i:s")."' WHERE paymentID = ".intval($paymentID)." LIMIT 1";
		run_sql($sql);
	}
    
     
 */
	// Debug - new payment email notification for webmaster
	// Uncomment lines below and make any test payment
	
	// $email = "tareq7500@gmail.com";
	// mail($email, "Payment - " . $paymentID . " - " . $box_status, " \n Payment ID: " . $paymentID . " \n\n Status: " . $box_status . " \n\n Details: " . print_r($payment_details, true));


	

    return true;      
}

?>