<?php

require_once 'libs/router.php';
require_once 'app/controller/vehiculos.controller.php';
require_once 'app/controller/marcas.controller.php';

$router = new Router();

$router->addRoute('vehiculos', 'GET', 'Vehiculos_Controller', 'getVehiculos');
$router->addRoute('vehiculos', 'POST', 'Vehiculos_Controller', 'addVehiculo');
$router->addRoute('vehiculos/:id', 'GET', 'Vehiculos_Controller', 'getVehiculo');
$router->addRoute('vehiculos/:id', 'PUT', 'Vehiculos_Controller', 'updateVehiculo');
$router->addRoute('vehiculos/:id', 'DELETE', 'Vehiculos_Controller', 'deleteVehiculo');

$router->addRoute('marcas', 'GET', 'Marcas_Controller', 'getMarcas');
$router->addRoute('marcas', 'POST', 'Marcas_Controller', 'addMarca');
$router->addRoute('marcas/:id', 'GET', 'Marcas_Controller', 'getMarca');
$router->addRoute('marcas/:id', 'PUT', 'Marcas_Controller', 'updateMarca');
$router->addRoute('marcas/:id', 'DELETE', 'Marcas_Controller', 'deleteMarca');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);