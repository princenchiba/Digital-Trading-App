<?php

	if(!isset($routes))
	{ 
	    $routes = \Config\Services::routes(true);
	}

	$routes->group('admin/trade', ['filter' => 'checkLogin', 'namespace' => 'App\Modules\Trade\Controllers'], function($subroutes){
		$subroutes->add('open-order', 'TradeController::open_order');
		$subroutes->add('trade-history', 'TradeController::trade_history');
	});

