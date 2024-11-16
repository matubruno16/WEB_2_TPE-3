<?php
require_once 'app/model/vehiculos.model.php';
require_once 'app/model/marcas.model.php';
require_once 'app/view/json.view.php';

class Vehiculos_Controller {
    private $vehiculosModel; private $marcasModel; private $view;

    public function __construct() {
        $this->vehiculosModel = new Vehiculos_Model();
        $this->marcasModel = new Marcas_Model();
        $this->view = new JSON_View;
    }

    public function getVehiculos($req, $res) {


        $filtrarMarca = null;
        if (isset($req->query->marca)) {
            $nombreMarca = $req->query->marca;
            $marca = $this->marcasModel->getMarcaNombre($nombreMarca);
            if (!$marca) {
                return $this->view->response("No existe la marca $marca->nombre", 404);
            }
            $filtrarMarca = $marca->id_marca;
        }

        $ordenar = null;
        if (isset($req->query->ordenar)) {
            $ordenar = $req->query->ordenar;  
        }

        $ascendente = null;
        if (isset($req->query->ascendente)) {
            $ascendente = true;
        }  

        $pagina = null; $limite = null;
        if (isset($req->query->pagina) || isset($req->query->limite)) {
            $pagina = $req->query->pagina;
            $limite = $req->query->limite;
        }


        $vehiculos = $this->vehiculosModel->getVehiculos($filtrarMarca, $pagina, $limite,  $ordenar, $ascendente);

        if (!$vehiculos) {
            if ($filtrarMarca) {
                return $this->view->response("No hay vehiculos con la marca $nombreMarca", 404);
            }
            return $this->view->response("No hay vehiculos", 404);
        }   

        return $this->view->response($vehiculos);
    }

    public function getVehiculo($req, $res) {
        $id = $req->params->id;
        $vehiculo = $this->vehiculosModel->getVehiculo($id);

        if (!$vehiculo) {
            return $this->view->response("No hay ningun vehiculo con el id $id", 404);
        }

        return $this->view->response($vehiculo);
    }

    public function deleteVehiculo($req, $res) {
        $id = $req->params->id;
        $vehiculo = $this->vehiculosModel->getVehiculo($id);

        if (!$vehiculo) {
            return $this->view->response("No hay ningun vehiculo con el id $id", 404);
        }

        $this->vehiculosModel->deleteVehiculo($id);
        return $this->view->response("Se elimino el vehiculo con el id $id");
    }

    public function addVehiculo($req, $res) {
        

        // Hacemos un IF por parametro a chequear para enviar un mensaje claro
        // de lo que falta ingresar

        if (empty($req->body["modelo"])) {
            return $this->view->response("Falta ingresar el modelo", 400);
        }

        if (empty($req->body["marca"])) {
            return $this->view->response("Falta ingresar la marca", 400);
        }
        
        if (empty($req->body["descripcion"])) {
            return $this->view->response("Falta ingresar la descripcion", 400);
        }

        if (empty($req->body["valoracion"])) {
            return $this->view->response("Falta ingresar la valoracion", 400);
        }
        
        if (empty($req->body["consumo"])) {
            return $this->view->response("Falta ingresar el consumo", 400);
        }

        $modelo = $req->body["modelo"];
        $marca = $req->body["marca"];
        $descripcion = $req->body["descripcion"];
        $valoracion = $req->body["valoracion"];
        $consumo = $req->body["consumo"];

        $id = $this->vehiculosModel->addVehiculo($modelo, $marca, $descripcion, $valoracion, $consumo);
        $vehiculo = $this->vehiculosModel->getVehiculo($id);
        
        return $this->view->response($vehiculo, 201);
    }

    public function updateVehiculo($req, $res) {
        
        $id = $req->params->id;
        $vehiculo = $this->vehiculosModel->getVehiculo($id);
        if (!$id) {
            return $this->view->response("No eciste el vehiculo con el id $id", 404);
        }

        if (empty($req->body["modelo"])) {
            return $this->view->response("Falta ingresar el modelo", 400);
        }

        if (empty($req->body["marca"])) {
            return $this->view->response("Falta ingresar la marca", 400);
        }
        
        if (empty($req->body["descripcion"])) {
            return $this->view->response("Falta ingresar la descripcion", 400);
        }

        if (empty($req->body["valoracion"])) {
            return $this->view->response("Falta ingresar la valoracion", 400);
        }
        
        if (empty($req->body["consumo"])) {
            return $this->view->response("Falta ingresar el consumo", 400);
        }

        $modelo = $req->body["modelo"];
        $marca = $req->body["marca"];
        $descripcion = $req->body["descripcion"];
        $valoracion = $req->body["valoracion"];
        $consumo = $req->body["consumo"];

        $this->vehiculosModel->updateVehiculo($modelo, $marca, $descripcion, $valoracion, $consumo, $id);
        $vehiculo = $this->vehiculosModel->getVehiculo($id);
        
        return $this->view->response($vehiculo, 200);
    }

}