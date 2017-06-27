<?php

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write(json_encode([]));
});

$app->get('/product', 'App\Action\ProductAction:fetch');
$app->get('/product/{slug}', 'App\Action\ProductAction:fetchOne');