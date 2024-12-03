<?php

// Establece el tipo de contenido a JSON
header("Content-Type: application/json");

// Incluye los archivos necesarios para la conexión a la base de datos y la clase Categoria
require_once("../configuracion/conexion.php");
require_once("../modelo/reserva.php");

// Crea una instancia de la clase Categoria
$book= new reserva();

// Obtiene los datos enviados en formato JSON
$body = json_decode(file_get_contents("php://input"), true);

// Obtén el método HTTP utilizado
$method = $_SERVER['REQUEST_METHOD'];

// Define las operaciones basadas en el método HTTP
switch ($method) {

    case "GET":
         // Manejo para obtener las categorias por id
      if (isset($_GET['id_reserva'])){
        $id_reserva = $_GET['id_reserva'];
        $datos = $book -> obtener_reserva_por_id($id_reserva);
      } else{
 // Manejo para obtener todas las categorías (GET)
        $datos = $book->obtener_reserva();
      }
       echo json_encode($datos);
        break;

    // Manejo para insertar una nueva categoría (POST)
    case "POST":
        // Llama al método para insertar una nueva categoría
        $datos = $book->insertar_reserva($body["id_cliente"], $body["id_destino"],$body["fecha_viaje"], $body["cantidad_personas"], $body["estado"]);
        // Devuelve una respuesta indicando que la inserción fue correcta
        echo json_encode(["Correcto" => "Inserción Realizada"]);
        break;

    // Manejo para actualizar una categoría (PUT)
    case "PUT":
        // Llama al método para actualizar una categoría existente
        $datos = $book->actualizar_reserva($body["id_reserva"],$body["id_cliente"], $body["id_destino"],$body["fecha_viaje"], $body["cantidad_personas"], $body["estado"]);
        // Devuelve una respuesta indicando que la actualización fue correcta
        echo json_encode(["Correcto" => "Actualización Realizada"]);
        break;

    // Manejo para eliminar una categoría (DELETE)
    case "DELETE":
        // Llama al método para eliminar una categoría
        $datos = $book->eliminar_reserva($body["id_reserva"]);
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