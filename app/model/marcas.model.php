<?php

class Marcas_Model {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=concesionaria;charset=utf8', 'root', '');
    }

    public function getMarcas($filtrarValoracion = null, $ordenar = null, $ascendente = null, $pagina = null, $limite = null) {
        $sql = "SELECT * FROM marcas ";

        if ($filtrarValoracion) {
            switch ($filtrarValoracion[0]) {
                case 'menor':
                    $operacion = "<";
                    break;
                case 'mayor':
                    $operacion = ">";
                    break;
                case 'igual':
                    $operacion = "=";
                    break;
            }


            $valor = $filtrarValoracion[1];
            $sql.=" WHERE valoracion $operacion $valor ";
        }

        if ($pagina || $limite) {
            $offsetCalculado = $limite * ($pagina - 1);
            $sql.=" LIMIT $limite OFFSET $offsetCalculado ";
        }

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
    public function updateMarca($nombre, $valoracion, $id) {
        $query = $this->db->prepare('UPDATE marcas SET nombre = ?, valoracion = ? WHERE id_marca = ?');
        $query->execute([$nombre, $valoracion, $id]);
    }

    public function deleteMarca($id) {
        $query = $this->db->prepare("DELETE FROM marcas WHERE id_marca = ?");
        $query->execute([$id]);
    }
}