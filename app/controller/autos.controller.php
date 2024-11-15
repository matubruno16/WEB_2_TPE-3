<?php
require_once 'app/model/autos.model.php';
require_once 'app/model/marcas.model.php';
require_once 'app/view/json.view.php';

class Autos_Controller {
    private $autosModel; private $marcasModel; private $view;

    public function __construct() {
        $this->autosModel = new Autos_Model();
        $this->marcasModel = new Marcas_Model();
        $this->view = new JSON_View;
    }

    public function getAutos($req, $res) {
        $autos = $this->autosModel->getAutos();
        if (!$autos) {
            return $this->view->response("No hay autos");
        }   

        return $this->view->response(array_reverse($autos));
    }

    public function getAuto($req, $res) {
        $id = $req->params->id;
        $auto = $this->autosModel->getAuto($id);
        if (!$auto) {
            return $this->view->response("No hay ningun auto con el id $id", 404);
        }

        return $this->view->response($auto);
    }
}