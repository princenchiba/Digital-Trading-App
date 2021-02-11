<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}
$routes->group('admin', ['namespace' => 'App\Modules\Backend\Controllers'], function($subroutes){

	$subroutes->add('', 'Auth::index');
	$subroutes->add('logout', 'Auth::logout');
});

$routes->group('dashboard', ['filter' => 'checkLogin', 'namespace' => 'App\Modules\Backend\Controllers'], function($subroutes){

    $subroutes->add('', 'Dashboard::index');
	$subroutes->add('home', 'Dashboard::index');
	$subroutes->add('profile', 'Dashboard::profile');
	$subroutes->add('edit-profile', 'Dashboard::edit_profile');
	$subroutes->add('total-referral-value', 'Dashboard::total_referral_value');
	$subroutes->add('all-fees-value', 'Dashboard::all_fees_value');
	$subroutes->add('linechart-fees-data', 'Dashboard::linechart_fees_data');
	$subroutes->add('linechart-deposit-data', 'Dashboard::linechart_deposit_data');
	$subroutes->add('linechart-coin-market-data', 'Dashboard::linechart_coin_market_data');
	$subroutes->add('monthly-fees', 'Dashboard::monthly_fees');
	$subroutes->add('monthly-deposit', 'Dashboard::monthly_deposit');
	$subroutes->add('dashboar-confirm-withdraw', 'Dashboard::confirm_withdraw');
	$subroutes->add('dashboar-cancel-withdraw', 'Dashboard::cancel_withdraw');
	$subroutes->add('monthly-buy-sell', 'Dashboard::monthly_buy_sell');
	$subroutes->add('deposit-withdraw-transfer-chart-data', 'Dashboard::deposit_withdraw_transfer_chart_data');
	$subroutes->add('user-growth', 'Dashboard::user_growth');

});

$routes->group('admin/dashboard', ['filter' => 'checkLogin', 'namespace' => 'App\Modules\Backend\Controllers'], function($subroutes){

    $subroutes->add('', 'Dashboard::index');
});

