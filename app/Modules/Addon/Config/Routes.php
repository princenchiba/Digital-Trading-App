<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('admin/addon', ['filter' => 'checkLogin', 'namespace' => 'App\Modules\Addon\Controllers'], function($subroutes){

    $subroutes->add('', 'Module::index');
    $subroutes->add('upload', 'Module::upload');
    $subroutes->add('uninstall/(:any)/(:any)', 'Module::uninstall/$1/$2');
    $subroutes->add('uninstall/(:any)', 'Module::uninstall/$1');
    $subroutes->add('install', 'Module::install');
    $subroutes->add('download_module', 'Module::download_module');
    $subroutes->add('verify_download_request', 'Module::verify_download_request');

    //theme routes
    $subroutes->add('theme', 'Theme::index');
    $subroutes->add('theme/upload_new_theme', 'Theme::upload_new_theme');
    $subroutes->add('theme/download_theme', 'Theme::download_theme');
    $subroutes->add('theme/active_theme/(:any)', 'Theme::active_theme/$1');
    $subroutes->add('theme/theme_delete/(:any)', 'Theme::theme_delete/$1');
    $subroutes->add('theme/verify_theme_download', 'Theme::verify_theme_download');
});

