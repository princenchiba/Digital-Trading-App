<?php
session_start();
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
// Used for composer based installation
require __DIR__  . '/vendor/autoload.php';
// Use below for direct download installation
// require __DIR__  . '/PayPal-PHP-SDK/autoload.php';

// After Step 1
$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AfmTkhn-GYb_HAsPayWeLDVTG39jNjGsJ3siJSNDs6QGr52KDLnAT28fIv4TVni5P3Dax8w1y-Libl_j',     // ClientID
            'EHGJveSf9GJcbyQwgYmouRi9baBPKLPqeSYjYesiG4UJTSnQ45q3gwQdkB6TvFQAjkYm42D1P_Hqn340'      // ClientSecret
        )
);
// Step 2.1 : Between Step 2 and Step 3
$apiContext->setConfig(
  array(
    'mode' => 'sandbox',
    'log.LogEnabled' => true,
    'log.FileName' => 'PayPal.log',
    'log.LogLevel' => 'FINE'
  )
);

// After Step 2
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');


$item1 = new PayPal\Api\Item();
$item1->setName('My Custom Description Tareq');
$item1->setCurrency('USD');
$item1->setQuantity(1);
$item1->setPrice(15);


$itemList = new \PayPal\Api\ItemList();
$itemList->setItems(array($item1));


$amount = new \PayPal\Api\Amount();
$amount->setCurrency("USD");
$amount->setTotal(15);



$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);
$transaction->setItemList($itemList);
$transaction->setDescription("Payment description Tareq");

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("http://phpcryptomarket.bdtask.com/testgateway/paypal/second.php")
    ->setCancelUrl("https://www.bdtask.com/service.php");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);



echo "<pre>";
// After Step 3
try {
    $payment->create($apiContext);
    echo $payment;

    echo "\n\nRedirect user to approval_url: <a href='" . $payment->getApprovalLink() . "'>LInk</a>\n";
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
    echo $ex->getData();
}