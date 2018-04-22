<?php

use Phalcon\Mvc\Micro;
use Phalcon\Loader;

// Creates the autoloader
$loader = new Loader();

// Register some namespaces
$loader->registerNamespaces(
    [
       'Model' => __DIR__ . 'models/',
       'Controller' => __DIR__ . 'controllers/'
    ]
);

// Register autoloader
$loader->register();

$di = new FactoryDefault();

// Set up the database service
$di->set(
    'db',
    function () {
        return new PdoMysql(
            [
                'host'     => 'localhost',
                'username' => '',
                'password' => '',
                'dbname'   => '',
            ]
        );
    }
);

$app = new Micro($di);

// Retrieve all something
$app->get(
    '/api/something',
    function () {
        echo 'oi';
        // Operation to fetch all the broadbands
        // $objSomething = new Controller\Something();
        // echo json_encode($objSomething->getAll());
    }
);

// Retrieves something based on primary key
$app->get(
    '/api/something/{id:[0-9]+}',
    function ($id) {
        // Operation to fetch something with id $id
    }
);

// Adds a new something
$app->post(
    '/api/something',
    function () {
        // Operation to create a fresh something
    }
);

// Updates something based on primary key
$app->put(
    '/api/something/{id:[0-9]+}',
    function ($id) {
        // Operation to update a something with id $id
    }
);

// Deletes something based on primary key
$app->delete(
    '/api/something/{id:[0-9]+}',
    function ($id) {
        // Operation to delete the something with id $id
    }
);

$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
});

$app->handle();
