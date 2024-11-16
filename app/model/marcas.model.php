<?php

class Marcas_Model {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=concesionaria;charset=utf8', 'root', '');
    }

    public function getMarcas($ordenar = null, $ascendente = null) {
        $sql = "SELECT * FROM marcas ";

        if ($ordenar) {
            if ($ascendente) {
                switch ($ordenar) {
                    case 'nombre':
                        $sql .= " ORDER BY nombre ";
                        break;
                    case 'valoracion':
                        $sql .= " ORDER BY valoracion ";
                        break;
                }
            } else {
                switch ($ordenar) {
                    case 'nombre':
                        $sql .= " ORDER BY nombre DESC ";
                        break;
                    case 'valoracion':
                        $sql .= " ORDER BY valoracion DESC ";
                        break;
                }
            }
        }


        $query = $this->db->prepare($sql);
        $query->execute();
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);

        return $marcas;
    }

    public function getMarcaId($id) {
        $query = $this->db->prepare("SELECT * FROM marcas WHERE id_marca = ?");
        $query->execute([$id]);

        $marcas = $query->fetch(PDO::FETCH_OBJ);
        return $marcas;
    }

    public function getMarcaNombre($nombre) {
        $query = $this->db->prepare("SELECT id_marca FROM marcas WHERE nombre = ?");
        $query->execute([$nombre]);
        $id = $query->fetch(PDO::FETCH_OBJ); 
        
        return $id;
    }

    public function addMarca($nombre, $valoracion) {
        $query = $this->db->prepare('INSERT INTO marcas(nombre, valoracion) VALUES (?, ?)');
        $query->execute([$nombre, $valoracion]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }

    public function deleteMarca($id) {
        $query = $this->db->prepare("DELETE FROM marcas WHERE id_marca = ?");
        $query->execute([$id]);
    }
}