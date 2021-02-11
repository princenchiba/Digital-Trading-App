<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_6J6dcwXf8ruEZGCvlC09C9NK",
  "publishable_key" => "pk_test_BPLwYal0sn4KkKaDTzuj5oRq"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>