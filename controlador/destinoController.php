<?php

header("Content-Type: application/json");
// Permitir CORS desde cualquier origen (ajusta esto según sea necesario)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");



// Incluye los archivos necesarios para la conexión a la base de datos y la clase Categoria
require_once("../configuracion/conexion.php");
require_once("../modelo/destino.php");

// Crea una instancia de la clase Categoria
$destiny = new destino();

// Obtiene los datos enviados en formato JSON
$body = json_decode(file_get_contents("php://input"), true);

// Obtén el método HTTP utilizado
$method = $_SERVER['REQUEST_METHOD'];

// Define las operaciones basadas en el método HTTP
switch ($method) {

   
    case "GET":
         // Manejo para obtener las categorias por id
      if (isset($_GET['id_destino'])){
        $id_destino = $_GET['id_destino'];
        $datos = $destiny-> obtener_destino_por_id($id_destino);
      } else{
 // Manejo para obtener todas las categorías (GET)
        $datos = $destiny->obtener_destino();
      }
       echo json_encode($datos);
        break;

    // Manejo para insertar una nueva categoría (POST)
    case "POST":
        // Llama al método para insertar una nueva categoría
        $datos = $destiny->insertar_destino( $body["nombre"],$body["pais"],$body["descripcion"],$body["duracion"],$body["precio_persona"]);
        // Devuelve una respuesta indicando que la inserción fue correcta
        echo json_encode(["Correcto" => "Inserción Realizada"]);
        break;

    // Manejo para actualizar una categoría (PUT)
    case "PUT":
        // Llama al método para actualizar una categoría existente
        $datos = $destiny->actualizar_destino($body["id_destino"],  $body["nombre"],$body["pais"],$body["descripcion"],$body["duracion"],$body["precio_persona"]);
        // Devuelve una respuesta indicando que la actualización fue correcta
        echo json_encode(["Correcto" => "Actualización Realizada"]);
        break;

    // Manejo para eliminar una categoría (DELETE)
    case "DELETE":
        // Llama al método para eliminar una categoría
        $datos = $destiny->eliminar_destino($body["id_destino"]);
        // Devuelve una respuesta indicando que la eliminación fue correcta
        echo json_encode(["Correcto" => "Eliminación Realizada"]);
        break;

    // Manejo para métodos no soportados
    default:
        http_response_code(405);
        echo json_encode(["Error" => "Método no permitido"]);
        break;
}
?>