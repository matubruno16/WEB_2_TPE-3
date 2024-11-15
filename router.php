<?php

require_once 'libs/router.php';
require_once 'app/controller/autos.controller.php';
require_once 'app/model/marcas.model.php';

$router = new Router();

$router->addRoute('autos', 'GET', 'Autos_Controller', 'getAutos');
$router->addRoute('autos/:id', 'GET', 'Autos_Controller', 'getAuto');
$router->addRoute('marcas', 'GET', 'Marcas_Controller', 'getMarcas');
$router->addRoute('marcas/:id', 'GET', 'Marcas_Controller', 'getMarcas');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);