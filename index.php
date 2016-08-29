<?php

use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Phalcon\Http\Response;

$loader = new Loader();

$loader->registerDirs(
    array(
        __DIR__ . '/models/'
    )
)->register();

$di = new FactoryDefault();

$di->set('db', function() { 
    return new PdoMysql(
        array(
            "host"     => "localhost",
            "username" => "asimov",
            "password" => "k23Oc2154E",
            "dbname"   => "robotics"
        )
    );
});

$app = new Micro();

$app->get('/api/robots', function() use ($app) { 

    $phql = "SELECT * FROM Robots ORDER BY name";
    $robots = $app->modelsManager->executeQuery($phql);

    $data = array();

    foreach($robots as $robot) {
        $data[] = array(
            'id' => $robot->id,
            'name' => $robot->name
        );
    }

    echo json_encode($data);

});

$app->get('/api/robots/search/{name}', function($name) use ($app) {

    $phql = "SELECT * FROM Robots WHERE name LIKE :name ORDER BY name";
    $robots = $app->modelsManager->executeQuery($phql, array('name' => '%' . $name . '%'));

    $data = array();

    foreach($robots as $robot) {
        $data[] = array(
            'id' => $robot->id,
            'name' => $robot->name
        );
    }

    echo json_encode($data);

});

$app->get('/api/robots/{id:[0-9]+}', function ($id) use ($app) {

    $phql = "SELECT * FROM Robots WHERE id = :id";
    $robot = $app->modelsManager->executeQuery($phql, array('id' => $id))->getFirst();

    $response = new Response();

    if($robot == false) {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } else {
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $robot->id,
                'name' => $robot->name
            )
        ));
    }

    return $response;

});

$app->post('/api/robots', function () {

});

$app->put('/api/robots/{id:[0-9]+}', function () {

});

$app->delete('/api/robots/{id:[0-9]+}', function () {

});

$app->handle();