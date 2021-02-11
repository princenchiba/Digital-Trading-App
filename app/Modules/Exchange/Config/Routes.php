<?php

	if(!isset($routes))
	{ 
	    $routes = \Config\Services::routes(true);
	}

	$routes->group('admin/exchanger', ['filter' => 'checkLogin', 'namespace' => 'App\Modules\Exchange\Controllers'], function($subroutes){

		$subroutes->add('cryptocoin', 'ExchangeController::index');
		$subroutes->add('cryptocoin-ajax-list', 'ExchangeController::ajax_list');
		$subroutes->add('cryptocoin-edit/(:any)', 'ExchangeController::form/$1');
		$subroutes->add('cryptocoin-add', 'ExchangeController::form');
		$subroutes->add('cryptocoin-edit', 'ExchangeController::form');

		$subroutes->add('market', 'ExchangeController::market');
		$subroutes->add('add-market', 'ExchangeController::market_form');
		$subroutes->add('add-market/(:any)', 'ExchangeController::market_form/$1');
		$subroutes->add('edit-market', 'ExchangeController::market_form');
		$subroutes->add('edit-market/(:any)', 'ExchangeController::market_form/$1');

		$subroutes->add('coin-pair', 'ExchangeController::coin_pair');
		$subroutes->add('add-coin-pair', 'ExchangeController::add_coin_pair_form');
		$subroutes->add('add-coin-pair/(:any)', 'ExchangeController::add_coin_pair_form/$1');
		$subroutes->add('edit-coin-pair/(:any)', 'ExchangeController::add_coin_pair_form/$1');
		$subroutes->add('market_streamer', 'ExchangeController::market_streamer');

	});
