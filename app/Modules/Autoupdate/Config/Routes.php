<?php

	if(!isset($routes))
	{ 
	    $routes = \Config\Services::routes(true);
	}

	$routes->group('admin/autoupdate', ['filter' => 'checkLogin','namespace' => 'App\Modules\Autoupdate\Controllers'], function($subroutes){
		$subroutes->add('autoupdate', 'Autoupdate::index');
		$subroutes->add('update', 'Autoupdate::update');
		$subroutes->add('cancel-update-notificaton', 'Autoupdate::cancel_notification');
		$subroutes->add('backup-database', 'Autoupdate::downloaded_database');
	});
	$routes->group('admin/updatenow', ['namespace' => 'App\Modules\Autoupdate\Controllers'], function($subroutes){
		$subroutes->add('updatenow', 'Autoupdate::updatenow');
	});

