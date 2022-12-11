<?php

require 'routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'ItemsController');
Router::get('login', 'SecurityController');
Router::get('logout', 'SecurityController');
Router::get('register', 'SecurityController');
Router::get('payment', 'SecurityController');
Router::get('admin', 'SecurityController');
Router::get('items', 'ItemsController');
Router::get('get_items', 'ItemsController');
Router::get('get_items_count', 'ItemsController');
Router::get('cart', 'ItemsController');
//Router::get('order', 'DefaultController');
Router::run($path);
