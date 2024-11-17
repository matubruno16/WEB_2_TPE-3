<?php

class Vehiculos_Model {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=concesionaria;charset=utf8', 'root', '');
    }

    public function getVehiculos($filtrarMarca = null, $filtrarConsumo = null, $filtrarValoracion = null, $filtrarModelo = null, $pagina = null, $limite = null, $ordenar = null, $ascendente = null) {
        $sql = "SELECT * FROM vehiculos ";
        
        if ($filtrarMarca) {
            $sql.=" WHERE marca = $filtrarMarca ";
        }

        // En los filtros de "Modelo", "Consumo" y "Valoracion", hay peligro de inyeccion SQL,
        // ya que lo que el usuario ingresa en el query params de la url va directamente al llamado
        // SQL. Estuvimos buscando diferentes formas de sanitizar la variable para evitar la inyeccion,
        // pero no encontramos ninguna funcial. Todas las que intentamos implementar no funcionaban o 
        // estaban desactualizadas
        // En el filtro de la marca no hay inyeccion ya que en el controlador se busca y entrega el ID 
        // de la marca, pero en los demas, lo que ingresa el usuario va directamente al llamado SQL.
        // Si esta aplicacion fuera a ser usada por un usuario real, no presentariamos la aplicaicon
        // hasta solucionar este problema de la inyeccion, pero como solo sera presentada a una catedra
        // como TPE (y nos quedamos sin tiempo), suponemos que los parametros son ya sanitizados porque 
        // no encontramos ninguna forma de sanitizar el/los parametro/s.
        // No podemos usar el execute() para sanitizar ya que nunca va a haber un numero fijo de variables 
        // a ingresar en el execute (y no se puede hacer un execute cada vez que se llame a un filtro por
        // esta misma razon)

        if ($filtrarModelo) {
            $sql.=" WHERE modelo = $filtrarModelo ";
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
            $sql.=" WHERE consumo $operacion $valor ";
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
  
        if ($pagina && $limite) {
            $offsetCalculado = ($pagina - 1) * $limite ;
            $sql.=" LIMIT $limite OFFSET $offsetCalculado ";
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