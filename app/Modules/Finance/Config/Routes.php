<?php

	if(!isset($routes))
	{ 
	    $routes = \Config\Services::routes(true);
	}

	$routes->group('admin/finance', ['filter' => 'checkLogin', 'namespace' => 'App\Modules\Finance\Controllers'], function($subroutes){

	    $subroutes->add('', 'Dashboard::index');

		$subroutes->add('withdraw-list', 'FinanceController::withdraw_list');
		$subroutes->add('withdraw-list/(:any)', 'FinanceController::withdraw_list/$1');
		$subroutes->add('pending-withdraw', 'FinanceController::pending_withdraw');
		$subroutes->add('pending-withdraw/(:any)', 'FinanceController::pending_withdraw/$1');
		$subroutes->add('confirm-withdraw', 'FinanceController::confirm_withdraw');
		$subroutes->add('cancel-withdraw', 'FinanceController::cancel_withdraw');

		$subroutes->add('deposit-list', 'FinanceController::deposit_list');
		$subroutes->add('deposit-list/(:any)', 'FinanceController::deposit_list/$1');
		$subroutes->add('pending-deposit', 'FinanceController::pending_deposit');
		$subroutes->add('pending-deposit/(:any)', 'FinanceController::pending_deposit/$1');
		$subroutes->add('confirm-deposit', 'FinanceController::confirm_deposit');
		$subroutes->add('cancel-deposit', 'FinanceController::cancel_deposit');

		$subroutes->add('credit-list', 'FinanceController::credit_list');
		$subroutes->add('credit-list/(:any)', 'FinanceController::credit_list/$1');
		$subroutes->add('credit-details/(:any)', 'FinanceController::credit_details/$1');
		$subroutes->add('add-credit', 'FinanceController::add_credit');
		$subroutes->add('user-info-load', 'FinanceController::user_info_load');
	});

