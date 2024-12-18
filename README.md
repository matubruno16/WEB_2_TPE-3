# Trabajo Práctico Especial WEB-2 Parte N°3

- En este sistema APIRest se puede obtener, modificar y eliminar marcas o vehiculos de una concesionaria
- En cuanto a la base de datos, agregamos 2 columnas a la tabla de vehiculos (Consumo y Valoracion) y 
una columna a la tabla de marcas (Valoracion), siendo estos valores enteros para darle mas sentido 
y uso a la aplicacion.

* Endpoints de vehiculos

** Verbo GET
- Obtener todos los vehiculos:
    http://.../api/vehiculos

- Obtener un vehiculo por su id:
    http://.../api/vehiculos/:id

    Ejemplo: 
        http://.../api/vehiculos/10
    
- Obtener todos los vehiculos filtrados:

    Para obtener un filtrado se debe ingresar un query params
    especificando que campo del vehiculo se quiere filtrar, y su 
    valor respectivo.
    En cuanto a los valores enteros (Consumo y Valoracion), se debe ingresar
    el campo deseado, asignandole la operacion (mayor, menor o igual), y 
    separado por un guion '-', el valor por el que se quiera filtrar

    Por consumo:
    http://.../api/vehiculos?consumo=mayor-5
    (Todos los vehiculos con consumo mayor a 5)

    Por valoracion:
    http://.../api/vehiculos?valoracion=mayor-5

    Por marca:
    http://.../api/vehiculos?marca=ford

    Por modelo:
    http://.../api/vehiculos?modelo=Ka

- Obtener todos los vehiculos en un orden especifico:

    Para requerir todos los vehiculos en un orden, se debe ingresar
    un query params "ordenar", asignandole el campo que se quiera ordenar

    Por consumo:
    http://.../api/vehiculos?ordenar=consumo

    Por valoracion:
    http://.../api/vehiculos?ordenar=valoracion
        
    Por marca:
    http://.../api/vehiculos?ordenar=marca

    Por modelo:
    http://.../api/vehiculos?ordenar=modelo
    
    Por defecto, el ordenado es en descendente, para que sea ascendente
    se debe inrgesar un query params "ascendente" con valor true

    Por ejemplo:
    http://.../api/vehiculos?ordenar=consumo&ascendente=true
    (Devuelve todos los vehiculos en orden ascendente segun en consumo de los mismos)

- Paginado de vehiculos

    Para paginar el pedido de vehiculos, se deben ingresar 2 query params: "pagina" y "limite".
    Al parametro "pagina" se le debe asignar el numero de pagina que se quiere visualizar
    y al parametro "limite" la cantidad de items por pagina

    Por ejemplo:
    http://.../api/vehiculos?pagina=2&limite=3
    (Muestra el segundo paginado con 3 items cargados)


** Verbo POST
- Agregar un vehiculo
    Para agregar un vehiculo se debe ingresar la informacion del vehiculo 
    (modelo, id_marca, descripcion, consumo, valoracion) en el body de la plataforma
    que se este usando para correr la aplicacion

    Por ejemplo:
    {
    "modelo": "Bora",
    "marca": 9,
    "descripcion": "Auto",
    "consumo": 8,
    "valoracion": 6
    }

    Y en la URL:
    http://.../api/vehiculos


** Verbo PUT
- Para modificar un vehiculo, se debe, al igual que en el POST, ingresar la informacion del
    vehiculo a modificar e ingresar el ID del mismo como parametro en la URL

    Por ejemplo:
    {
    "modelo": "Bora Modificado",
    "marca": 9,
    "descripcion": "Auto Modificado",
    "consumo": 3,
    "valoracion": 9
    }

    Y en la URL:
    http://.../api/vehiculos/:id
    (siendo ":id" el id del vehiculo que se quiera modificar)


** Verbo DELETE
- Para eliminar un vehiculo se debe ingresar el ID del vehiculo a borrar
    como parametro en la URL

    Por ejemplo:
    http://.../api/vehiculos/50



En cuanto a las MARCAS, el funcionamiento y uso de estas es igual o mas facil que el de vehiculos
siempre y cuando se respete los campos de la tabla marcas.
Tambien tener en cuenta, que si se elimina un marca, se eliminan todos los vehiculos
vinculados a la misma. Hay 4 marcas pricipales que contienen a todos los autos predeterminados
para utilizar de ejemplos, cuidado con eliminar alguna de esas 4 porque se van a borrar una gran parte
de los vehiculos de ejemplo

