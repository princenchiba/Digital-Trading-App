<?php
	if(!isset($routes))
	{ 
	    $routes = \Config\Services::routes(true);
	}

	$routes->group('', ['namespace' => 'App\Modules\Website\Controllers'], function($subroutes){

	
		$subroutes->add('', 'HomeController::index');
		$subroutes->add('get-stream', 'HomeController::getStream');
		$subroutes->add('coingraph-data', 'HomeController::coingraphdata');
		$subroutes->add('balances', 'HomeController::balances');
		$subroutes->add('login', 'HomeController::login');
		$subroutes->add('deposit', 'HomeController::deposit');
		$subroutes->add('deposit/(:any)', 'HomeController::deposit/$1');
		$subroutes->add('dafult-data', 'HomeController::dafult_data');
		$subroutes->add('payment-process', 'HomeController::payment_process');
		$subroutes->add('payment_callback/stripe_confirm', 'PaymentCallbackController::stripe_confirm');
		$subroutes->add('payment_callback/paypal_confirm', 'PaymentCallbackController::paypal_confirm');
		$subroutes->add('payment_callback/token_confirm', 'PaymentCallbackController::token_confirm');
		$subroutes->add('payment_callback/phone_confirm', 'PaymentCallbackController::phone_confirm');
		$subroutes->add('payment_callback/bank_confirm', 'PaymentCallbackController::bank_confirm');
		$subroutes->add('payment_callback/bitcoin_confirm/(:any)', 'PaymentCallbackController::bitcoin_confirm/$1');
		$subroutes->add('bank-setting', 'HomeController::bank_setting');
		$subroutes->add('bank-setting/(:any)', 'HomeController::bank_setting/$1');
		$subroutes->add('withdraw', 'HomeController::withdraw');
		$subroutes->add('withdraw/(:any)', 'HomeController::withdraw/$1');
		$subroutes->add('withdraw-confirm/(:any)', 'HomeController::withdraw_confirm/$1');
		$subroutes->add('withdraw-verify', 'HomeController::withdraw_verify');
		$subroutes->add('withdraw-details/(:any)', 'HomeController::withdraw_details/$1');
		$subroutes->add('fees-load', 'Ajaxload::fees_load');
		$subroutes->add('checke-reciver-id', 'Ajaxload::checke_reciver_id');
		$subroutes->add('get-wallet-id', 'Ajaxload::walletid');
		$subroutes->add('payout-setting', 'HomeController::payout_setting');
		$subroutes->add('payout-setting/(:any)', 'HomeController::payout_setting/$1');
		$subroutes->add('transfer', 'HomeController::transfer');
		$subroutes->add('transfer-confirm/(:any)', 'HomeController::transfer_confirm/$1');
		$subroutes->add('transfer-verify', 'HomeController::transfer_verify');
		$subroutes->add('transfer_details/(:any)', 'HomeController::transfer_details/$1');
		$subroutes->add('transactions', 'HomeController::transactions');
		$subroutes->add('open-order', 'HomeController::open_order');
		$subroutes->add('order-cancel/(:any)', 'HomeController::order_cancel/$1');
		$subroutes->add('complete-order', 'HomeController::complete_order');
		$subroutes->add('trade-history', 'HomeController::trade_history');
		$subroutes->add('profile', 'HomeController::profile');
		$subroutes->add('profile-verify', 'HomeController::profile_verify');
		$subroutes->add('edit-profile', 'HomeController::edit_profile');
		$subroutes->add('change-password', 'HomeController::change_password');
		$subroutes->add('googleauth', 'HomeController::googleauth');
		$subroutes->add('register', 'HomeController::register');
		$subroutes->add('forgotPassword', 'HomeController::forgotPassword');
		$subroutes->add('resetPassword', 'HomeController::resetPassword');
		$subroutes->add('contact', 'HomeController::contact');
		$subroutes->add('home/settings', 'HomeController::settings');
		$subroutes->add('home/contactMsg', 'HomeController::contactMsg');
		$subroutes->add('subscribe', 'HomeController::subscribe');
		$subroutes->add('news', 'HomeController::news');
		$subroutes->add('news/(:any)', 'HomeController::news/$1');
		$subroutes->add('news/(:any)/(:any)', 'HomeController::news/$1/$2');
		$subroutes->add('news_details', 'HomeController::news_details');
		$subroutes->add('otherpage/(:any)', 'HomeController::page/$1');
		$subroutes->add('exchange', 'HomeController::exchange_page');
		$subroutes->add('market-depth', 'HomeController::market_depth');
		$subroutes->add('coin-pairs', 'HomeController::coin_pairs');
		$subroutes->add('tradecharthistory', 'HomeController::tradecharthistory');
		$subroutes->add('tradecharthistory/(:any)', 'HomeController::tradecharthistory/$1');
		$subroutes->add('jsonMessageStream', 'HomeController::jsonMessageStream');
		$subroutes->add('market-streamer', 'HomeController::market_streamer');
		$subroutes->add('streamer-buy', 'HomeController::streamer_buy');
		$subroutes->add('streamer-sell', 'HomeController::streamer_sell');
		$subroutes->add('tradehistory', 'HomeController::tradehistory');
		$subroutes->add('ajaxMessageChat', 'HomeController::ajaxMessageChat');
		$subroutes->add('langChange', 'HomeController::langChange');
		$subroutes->add('buy', 'HomeController::buy');
		$subroutes->add('sell', 'HomeController::sell');
		$subroutes->add('sell', 'HomeController::sell');

		$subroutes->add('installer', 'Installer::index');
		$subroutes->add('remove_installer', 'Installer::remove_installer');

		$subroutes->add('activate-account/(:any)', 'HomeController::activate_account/$1');
		$subroutes->add('customer/auth/logout', 'Auth::logout');

	});

