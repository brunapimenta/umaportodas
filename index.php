<?php

use Phalcon\Mvc\Micro;
use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

// Creates the autoloader
$loader = new Loader();

// Register some namespaces
$loader->registerNamespaces(
    [
       'Model' => __DIR__ . '/models/',
       'Controller' => __DIR__ . '/controllers/'
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
                'username' => 'root',
                'password' => '',
                'dbname'   => 'umaportodas',
            ]
        );
    }
);

$app = new Micro($di);

// Retrieve all routes
$app->get(
    '/api/routes',
    function () {
        // Operation to fetch all the routes
        $objRoute = new Controller\Ways();
        echo json_encode($objRoute->getAll());
    }
);

// Retrieves routes based on primary key
$app->get(
    '/api/routes/{id:[0-9]+}',
    function ($id) {
        // Operation to fetch routes with id $id
        $objRoute = new Controller\Ways();
        echo json_encode($objRoute->getRoute($id));
    }
);

// Adds a new routes
$app->post(
    '/api/routes',
    function () {
        // Operation to create a fresh routes
        $objRoute = new Controller\Ways();
        echo json_encode($objRoute->create($this->request->getPost()));
    }
);

// Updates routes based on primary key
$app->put(
    '/api/routes/{id:[0-9]+}',
    function ($id) {
        // Operation to update a routes with id $id
        $objRoute = new Controller\Ways();
        echo json_encode($objRoute->update($id, $this->request->getPut()));
    }
);

// Deletes routes based on primary key
$app->delete(
    '/api/routes/{id:[0-9]+}',
    function ($id) {
        // Operation to delete the routes with id $id
        $objRoute = new Controller\Ways();
        echo json_encode($objRoute->delete($id));
    }
);

$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
});

$app->handle();
