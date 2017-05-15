<?php

require("vendor/autoload.php");
require("includes/cryptotools.php");

$router = new AltoRouter();
$router->setBasePath("");

$router->map('GET', '/', 'CryptoToolsRoute::page_home', 'home');
$router->map('GET', '/attributions', 'CryptoToolsRoute::page_attributions', 'attributions');

$router->map('GET', '/api', 'CryptoToolsAPI::test', 'apitest');

$match = $router->match();

if( $match && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "Error 404: Not found";
}