<?php

require("vendor/autoload.php");
require("includes/cryptotools.php");

$router = new AltoRouter();
$router->setBasePath("");

$router->map('GET', '/', 'CryptoToolsRoute::page_home', 'home');
$router->map('GET', '/aes', 'CryptoToolsRoute::page_aes_string', 'aes_string');
$router->map('GET', '/rsagen', 'CryptoToolsRoute::page_rsa_gen', 'rsa_gen');
$router->map('GET', '/dhe', 'CryptoToolsRoute::page_dhe', 'dhe');
$router->map('GET', '/hash', 'CryptoToolsRoute::page_hash_string', 'hash_string');
$router->map('GET', '/hmac', 'CryptoToolsRoute::page_hmac_string', 'hmac_string');
$router->map('GET', '/otp', 'CryptoToolsRoute::page_otp', 'otp');
$router->map('GET', '/base64', 'CryptoToolsRoute::page_base64', 'base64');
$router->map('GET', '/bitcoin', 'CryptoToolsRoute::page_bitcoin', 'bitcoin');

$router->map('GET', '/about', 'CryptoToolsRoute::page_about', 'about');
$router->map('GET', '/attributions', 'CryptoToolsRoute::page_attributions', 'attributions');

$router->map('GET', '/api', 'CryptoToolsAPI::test', 'apitest');

$match = $router->match();

if( $match && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    header( 'Content-Type: text/plain', true, 404 );
    echo "404 Not Found\r\n";
}
