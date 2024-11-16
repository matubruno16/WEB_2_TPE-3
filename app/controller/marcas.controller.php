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
        
        $ordenar = null;
        if (isset($req->query->ordenar)) {
            $ordenar = $req->query->ordenar;
        }

        $ascendente = null;
        if (isset($req->query->ascendente)) {
            $ascendente = true;
        } 
        
        $marcas = $this->marcasModel->getMarcas($ordenar, $ascendente);
        
        if (!$marcas) {
            return $this->view->response("No hay marcas");
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

    public function addMarca($req, $res) {
        
        // Hacemos un if por parametro para retornar un mensaje adecuado
        // a lo que falte poner

        if (empty($req->body["nombre"])) {
            return $this->view->response("Falta ingresar el nombre", 400);
        }

        if (empty($req->body["valoracion"])) {
            return $this->view->response("Falta ingresar el valoracion", 400);
        }

        $nombre = $req->body["nombre"];
        $valoracion = $req->body["valoracion"];

        $id = $this->marcasModel->addMarca($nombre, $valoracion);
        $marca = $this->marcasModel->getMarcaId($id);
        
        return $this->view->response($marca);
    }

    public function deleteMarca($req, $res) {
        $id = $req->params->id;
        $marca = $this->marcasModel->getMarcaId($id);
        if (!$marca) {
            return $this->view->response("No existe ninguna marca con el id $id", 404);
        }

        $this->vehiculosModel->deleteVehiculosMarca($marca->nombre);

        $id = $this->marcasModel->deleteMarca($id);
        return $this->view->response("Se elimino la marca con el id $id y todos sus vehiculos vinculados");
    }

}