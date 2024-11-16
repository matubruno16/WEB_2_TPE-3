<?php

class Vehiculos_Model {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=concesionaria;charset=utf8', 'root', '');
    }

    public function getVehiculos($filtrarMarca = null, $pagina = null, $limite = null, $ordenar = null, $ascendente = null) {
        $sql = "SELECT * FROM vehiculos ";

        if ($filtrarMarca) {
            $sql.="WHERE marca = $filtrarMarca ";
        }
        
        if ($pagina || $limite) {
            $offsetCalculado = $limite * ($pagina - 1);
            // var_dump($offsetCalculado);
            // die();
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
                        $sql .= " ORDER BY modelo";
                        break;
                    case 'descripcion':
                        $sql .= " ORDER BY descripcion ";
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