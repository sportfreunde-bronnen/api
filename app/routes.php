<?php

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write(json_encode([]));
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