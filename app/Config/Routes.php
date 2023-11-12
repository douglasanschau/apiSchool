<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\Photos;
use App\Controllers\Login;
use App\Controllers\Logout;
use App\Controllers\Students;

/**
 * @var RouteCollection $routes
 */

 $routes->group('api', static function($routes){
    $routes->resource('photos');
    $routes->resource('login');
    $routes->resource('logout');
    $routes->resource('students');
 });
