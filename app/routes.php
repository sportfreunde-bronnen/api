<?php

$app->get('/', function ($request, $response, $args) {
    return $response->withJson([]);
});

// Product list
$app->get('/product', 'App\Action\ProductAction:fetch');

// Single product
$app->get('/product/{slug}', 'App\Action\ProductAction:fetchOne');

// Create a new cart
$app->post('/cart', 'App\Action\CartAction:create');

// Add product to cart
$app->post('/cart/{key:[0-9a-z]{32}}', 'App\Action\CartAction:addProduct');

// Read cart
$app->get('/cart/{key:[0-9a-z]{32}}', 'App\Action\CartAction:fetch');

// Read carts item count
$app->get('/cart/itemcount/{key:[0-9a-z]{32}}', 'App\Action\CartAction:getItemCount');

// Delete product from cart
$app->delete('/cart/item/{key:[0-9a-z]{32}}/{itemId}', 'App\Action\CartAction:deleteItem');

$app->post('/cart/checkout/{key:[0-9a-z]{32}}', 'App\Action\CartAction:checkout');

// Football routes
$app->get('/football/schedule/{team}[/]', 'App\Action\FootballAction:schedule');

$app->get('/football/schedule/{team}/{type}', 'App\Action\FootballAction:schedule');

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://dev.sfbshop')
        ->withHeader('Access-Control-Allow-Origin', 'http://shop.sf-bronnen.de')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
