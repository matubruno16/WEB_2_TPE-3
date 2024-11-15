<?php

class Autos_Model {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=consecionaria;charset=utf8', 'root', '');
    }

    public function getAutos() {
        $query = $this->db->prepare("SELECT * FROM autos");
        $query->execute();

        $autos = $query->fetchAll(PDO::FETCH_OBJ);
        return $autos;
    }

    public function getAuto($id) {
        $query = $this->db->prepare("SELECT * FROM autos WHERE id = ?");
        $query->execute([$id]);

        $autos = $query->fetch(PDO::FETCH_OBJ);
        return $autos;
    }
}