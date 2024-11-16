<?php

class Vehiculos_Model {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=concesionaria;charset=utf8', 'root', '');
    }

    public function getVehiculos($filtrarMarca = null, $filtrarConsumo = null, $pagina = null, $limite = null, $ordenar = null, $ascendente = null) {
        $sql = "SELECT * FROM vehiculos ";
        
        if ($filtrarMarca) {
            $sql.=" WHERE marca = $filtrarMarca ";
        }

        if ($filtrarConsumo) {
            switch ($filtrarConsumo[0]) {
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


            $valor = $filtrarConsumo[1];
            $sql.=" WHERE consumo $operacion $valor ";
        }

        if ($pagina || $limite) {
            $offsetCalculado = $limite * ($pagina - 1);
            $sql.=" LIMIT $limite OFFSET $offsetCalculado ";
        }

        if ($ordenar) {
            if ($ascendente) {
                switch ($ordenar) {
                    case 'valoracion':
                        $sql .= " ORDER BY valoracion ";
                        break;
                    case 'consumo':
                        $sql .= " ORDER BY consumo ";
                        break;
                    case 'modelo':
                        $sql .= " ORDER BY modelo ";
                        break;
                    case 'descripcion':
                        $sql .= " ORDER BY descripcion ";
                        break;
                    case 'marca':
                        $sql .= " ORDER BY marca ";
                        break;
                }
            } else {
                switch ($ordenar) {
                    case 'valoracion':
                        $sql .= " ORDER BY valoracion DESC ";
                        break;
                    case 'consumo':
                        $sql .= " ORDER BY consumo DESC ";
                        break;
                    case 'modelo':
                        $sql .= " ORDER BY modelo DESC ";
                        break;
                    case 'descripcion':
                        $sql .= " ORDER BY descripcion DESC ";
                        break;
                    case 'marca':
                        $sql .= " ORDER BY marca DESC ";
                        break;
                }
            }
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        $vehiculos = $query->fetchAll(PDO::FETCH_OBJ);

        return $vehiculos;
    }

    public function getVehiculo($id) {
        $query = $this->db->prepare("SELECT * FROM vehiculos WHERE id_vehiculo = ?");
        $query->execute([$id]);

        $vehiculos = $query->fetch(PDO::FETCH_OBJ);
        return $vehiculos;
    }

    public function addVehiculo($modelo, $marca, $descripcion, $valoracion, $consumo) {
        $query = $this->db->prepare('INSERT INTO vehiculos(modelo, marca, descripcion, valoracion, consumo) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$modelo, $marca, $descripcion, $valoracion, $consumo]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }

    public function updateVehiculo($modelo, $marca, $descripcion, $valoracion, $consumo, $id) {
        $query = $this->db->prepare('UPDATE vehiculos SET modelo = ?, marca = ?, descripcion = ?, valoracion = ?, consumo = ? WHERE id_vehiculo = ?');
        $query->execute([$modelo, $marca, $descripcion, $valoracion, $consumo, $id]);

    }

    public function deleteVehiculo($id) {
        $query = $this->db->prepare('DELETE FROM vehiculos WHERE id_vehiculo = ?');
        $query->execute([$id]);
    }

    public function deleteVehiculosMarca($marca) {
        $query = $this->db->prepare('DELETE FROM vehiculos WHERE marca = ?');
        $query->execute([$marca]);
    }
}