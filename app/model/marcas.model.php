<?php

class Marcas_Model {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=consecionaria;charset=utf8', 'root', '');
    }

    public function getMarcas() {
        $query = $this->db->prepare("SELECT * FROM marcas");
        $query->execute();

        $marcas = $query->fetchAll(PDO::FETCH_OBJ);
        return $marcas;
    }

    public function getMarca($id) {
        $query = $this->db->prepare("SELECT * FROM marcas WHERE id = ?");
        $query->execute([$id]);

        $marcas = $query->fetch(PDO::FETCH_OBJ);
        return $marcas;
    }
}