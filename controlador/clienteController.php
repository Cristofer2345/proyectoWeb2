<?php

// Establece el tipo de contenido a JSON
header("Content-Type: application/json");
// Permitir CORS desde cualquier origen (ajusta esto según sea necesario)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Incluye los archivos necesarios para la conexión a la base de datos y la clase Categoria
require_once("../configuracion/Conexion.php");
require_once("../modelo/cliente.php");

// Crea una instancia de la clase Categoria
$client = new cliente();

// Obtiene los datos enviados en formato JSON
$body = json_decode(file_get_contents("php://input"), true);


// Obtén el método HTTP utilizado
$method = $_SERVER['REQUEST_METHOD'];

// Define las operaciones basadas en el método HTTP
switch ($method) {

    case "GET":
         // Manejo para obtener las categorias por id
      if (isset($_GET['cedula'])){
        $cedula = $_GET['cedula'];
        $datos = $client -> obtener_cliente_por_id($cedula);
      } else{
 // Manejo para obtener todas las clientes(GET)
        $datos = $client->obtener_cliente();
      }
       echo json_encode($datos);
        break;

    // Manejo para insertar una nueva categoría (POST)
    case "POST":
      
        $datos = $client->insertar_cliente($body["cedula"], $body["nombre"],$body["apellidos"],$body["telefono"],$body["correo"]);
        // Devuelve una respuesta indicando que la inserción fue correcta
        echo json_encode(["Correcto" => "Inserción Realizada"]);
        break;

    // Manejo para actualizar una categoría (PUT)
    case "PUT":
        // Llama al método para actualizar una categoría existente
        $datos = $client->actualizar_cliente($body["cedula"], $body["nombre"], $body["apellidos"],$body["telefono"],$body["correo"]);
        // Devuelve una respuesta indicando que la actualización fue correcta
        echo json_encode(["Correcto" => "Actualización Realizada"]);
        break;

    // Manejo para eliminar una categoría (DELETE)
    case "DELETE":
        // Llama al método para eliminar una categoría
        $datos = $client->eliminar_cliente($body["cedula"]);
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