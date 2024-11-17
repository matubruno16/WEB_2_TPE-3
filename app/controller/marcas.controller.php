<?php
require_once 'app/model/vehiculos.model.php';
require_once 'app/model/marcas.model.php';
require_once 'app/view/json.view.php';

class Marcas_Controller {
    private $vehiculosModel; private $marcasModel; private $view;

    public function __construct() {
        $this->vehiculosModel = new Vehiculos_Model();
        $this->marcasModel = new Marcas_Model();
        $this->view = new JSON_View;
    }

    public function getMarcas($req, $res) {

        $filtrarValoracion = null;
        if (isset($req->query->valoracion)) {
            $filtrarValoracion = explode( '-', $req->query->valoracion);
        }
        
        $pagina = null; $limite = null;
        if (isset($req->query->pagina) && isset($req->query->limite)) {
            $pagina = $req->query->pagina;
            $limite = $req->query->limite;
        }

        $ordenar = null;
        if (isset($req->query->ordenar)) {
            $ordenar = $req->query->ordenar;
        }

        $ascendente = null;
        if (isset($req->query->ascendente)) {
            $ascendente = true;
        } 
        
        $marcas = $this->marcasModel->getMarcas($filtrarValoracion, $ordenar, $ascendente, $pagina, $limite);
        
        if (!$marcas) {
            return $this->view->response("No hay marcas", 404);
        }

        return $this->view->response($marcas);
    }

    public function getMarca($req, $res) {
        $id = $req->params->id;

        $marca = $this->marcasModel->getMarcaId($id);

        if (!$marca) {
            return $this->view->response("No hay ninguna marca con el id $id", 404);
        }

        return $this->view->response($marca);
    }

    public function updateMarca($req, $res) {

        $id = $req->params->id;
        $marca = $this->marcasModel->getMarcaId($id);
        if (!$marca) {
            return $this->view->response("No hay ninguna marca con el id $id", 404);
        }

        // Hacemos un IF por parametro a chequear para enviar un mensaje claro
        // de lo que falta ingresar
        
        if (empty($req->body->nombre)) {
            return $this->view->response("Falta ingresar el nombre", 400);
        }

        if (empty($req->body->valoracion)) {
            return $this->view->response("Falta ingresar el valoracion", 400);
        }

        $nombre = $req->body->nombre;
        $valoracion = $req->body->valoracion;

        $this->marcasModel->updateMarca($nombre, $valoracion, $id);
        $marca = $this->marcasModel->getMarcaId($id);
        
        return $this->view->response($marca, 200);
    }
    public function addMarca($req, $res) {
        
        if (empty($req->body->nombre)) {
            return $this->view->response("Falta ingresar el nombre", 400);
        }

        if (empty($req->body->valoracion)) {
            return $this->view->response("Falta ingresar el valoracion", 400);
        }

        $nombre = $req->body->nombre;
        $valoracion = $req->body->valoracion;

        $id = $this->marcasModel->addMarca($nombre, $valoracion);
        $marca = $this->marcasModel->getMarcaId($id);
        
        return $this->view->response($marca, 201);
    }

    public function deleteMarca($req, $res) {
        $id = $req->params->id;
        $marca = $this->marcasModel->getMarcaId($id);
        if (!$marca) {
            return $this->view->response("No existe ninguna marca con el id $id", 404);
        }

        $this->vehiculosModel->deleteVehiculosMarca($marca->nombre);

        $this->marcasModel->deleteMarca($id);

        return $this->view->response("Se elimino la marca con el id $id y todos sus vehiculos vinculados");
    }

}


// public function addMarca($req, $res) {

//     // ACLARACION: esta funcion de addMarca y updateMarca funciona en el caso de que se
//     // este usando ThunderClient para revisar la aplicacion.
//     // Nosotros usamos thunder client y este guarda la data del body en un
//     // arreglo en vez de un objeto como en Postman.
//     // Hicimos esta funcion por las dudas, que en realidad es lo mismo porque
//     // lo unico que cambia es la sintaxis de como se le pide la informacion al body
//     // (depende si viene en un arreglo o como objeto).

//     if (empty($req->body["nombre"])) {
//         return $this->view->response("Falta ingresar el nombre", 400);
//     }

//     if (empty($req->body["valoracion"])) {
//         return $this->view->response("Falta ingresar el valoracion", 400);
//     }

//     $nombre = $req->body["nombre"];
//     $valoracion = $req->body["valoracion"];

//     $id = $this->marcasModel->addMarca($nombre, $valoracion);
//     $marca = $this->marcasModel->getMarcaId($id);
    
//     return $this->view->response($marca, 201);
// }



// public function updateMarca($req, $res) {

//     $id = $req->params->id;
//     $marca = $this->marcasModel->getMarcaId($id);
//     if (!$marca) {
//         return $this->view->response("No hay ninguna marca con el id $id", 404);
//     }
    
//     if (empty($req->body["nombre"])) {
//         return $this->view->response("Falta ingresar el nombre", 400);
//     }

//     if (empty($req->body["valoracion"])) {
//         return $this->view->response("Falta ingresar el valoracion", 400);
//     }

//     $nombre = $req->body["nombre"];
//     $valoracion = $req->body["valoracion"];

//     $this->marcasModel->updateMarca($nombre, $valoracion, $id);
//     $marca = $this->marcasModel->getMarcaId($id);
    
//     return $this->view->response($marca, 200);
// }