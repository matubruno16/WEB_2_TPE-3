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

}