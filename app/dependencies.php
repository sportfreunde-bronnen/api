<?php

// Slim DI Container
$container = $app->getContainer();

// Doctrine2 EntityManager
$container['em'] = function ($c) {
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );
    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

// ProductAction
$container['App\Action\ProductAction'] = function ($c) {
    $productResource = new \App\Resource\ProductResource($c->get('em'), $c->get('logger'));
    return new \App\Action\ProductAction($productResource);
};

// CartAction
$container['App\Action\CartAction'] = function($c) {
    $cartResource = new \App\Resource\CartResource(
        $c->get('em'),
        $c->get('logger'),
        new \App\Service\CartKeyGenerator()
    );
    return new \App\Action\CartAction(
        $cartResource
    );
};

// Logger
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
