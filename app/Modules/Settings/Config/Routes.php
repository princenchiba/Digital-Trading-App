<?php

	if(!isset($routes))
	{ 
	    $routes = \Config\Services::routes(true);
	}

	$routes->group('admin/setting', ['filter' => 'checkLogin','namespace' => 'App\Modules\Settings\Controllers'], function($subroutes){

		$subroutes->add('app-setting', 'SettingController::index');
		$subroutes->add('security', 'SettingController::security');
		$subroutes->add('block-list', 'SettingController::blocklist');
		$subroutes->add('delete-block/(:any)', 'SettingController::delete_block/$1');
		$subroutes->add('fees-setting', 'SettingController::fees_settig');
		$subroutes->add('fees-setting-save', 'SettingController::fees_setting_save');
		$subroutes->add('delete-fees-setting/(:any)', 'SettingController::delete_fees_setting/$1');
		$subroutes->add('transaction-setup', 'SettingController::transaction_setup');
		$subroutes->add('transaction-save', 'SettingController::transaction_save');
		$subroutes->add('delete-transaction/(:any)', 'SettingController::delete_transaction/$1');
		$subroutes->add('language', 'SettingController::language');
		$subroutes->add('add-language', 'SettingController::addLanguage');
		$subroutes->add('phrase', 'SettingController::phrase');
		$subroutes->add('add-phrase', 'SettingController::addPhrase');
		$subroutes->add('edit-phrase/(:any)', 'SettingController::editPhrase/$1');
		$subroutes->add('search/(:any)', 'SettingController::search/$1');
		$subroutes->add('add-lebel', 'SettingController::addLebel');
		$subroutes->add('payment-gateway', 'SettingController::payment_gateway');
		$subroutes->add('update-gateway/(:any)', 'SettingController::update_payment_gateway/$1');
		$subroutes->add('affiliation', 'SettingController::affiliation');
		$subroutes->add('external-api-list', 'SettingController::extrnal_api_list');
		$subroutes->add('update-external-api/(:any)', 'SettingController::update_external_api/$1');
		$subroutes->add('email-gateway', 'SettingController::email_gateway');
		$subroutes->add('email-test', 'SettingController::test_email');
		$subroutes->add('sms-gateway', 'SettingController::sms_gateway');
		$subroutes->add('test-sms', 'SettingController::test_sms');
		$subroutes->add('getemailsmsgateway', 'SettingController::getemailsmsgateway');
		$subroutes->add('update-sms-gateway', 'SettingController::update_sms_gateway');
		$subroutes->add('update-email-gateway', 'SettingController::update_email_gateway');
		$subroutes->add('email-sms-template', 'SettingController::email_sms_template_list');
		$subroutes->add('template-update', 'SettingController::template_update');
		$subroutes->add('template-update/(:any)', 'SettingController::template_update/$1');
		$subroutes->add('email-sms-settings', 'SettingController::email_sms_setting');
		$subroutes->add('update-sender', 'SettingController::update_sender');
	});

