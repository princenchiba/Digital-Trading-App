<?php

	if(!isset($routes))
	{ 
	    $routes = \Config\Services::routes(true);
	}

	$routes->group('admin/user', ['filter' => 'checkLogin','namespace' => 'App\Modules\User\Controllers'], function($subroutes){
		
		$subroutes->add('user-list', 'UserController::index');
		$subroutes->add('ajax-list', 'UserController::ajax_list');
		$subroutes->add('add-user', 'UserController::form');
		$subroutes->add('edit-user', 'UserController::form');
		$subroutes->add('edit-user/(:any)', 'UserController::form/$1');
		$subroutes->add('user-details', 'UserController::user_details');
		$subroutes->add('user-details/(:any)', 'UserController::user_details/$1');
		$subroutes->add('ajax-tradelist/(:any)/(:any)', 'UserController::ajax_tradelist/$/$2');
		$subroutes->add('verify-user', 'UserController::pending_user_verification_list');
		$subroutes->add('pending-user-verification/(:any)', 'UserController::pending_user_verification/$1');
		$subroutes->add('subscriber-list', 'UserController::subscriber_list');
	});

