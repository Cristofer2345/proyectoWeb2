<?php
// Clase Categoria hereda de la clase Conectar
class reserva extends Conectar {

     // Obtiene todas las categorías activas
     public function obtener_reserva() {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener todas los clientes 
        $consulta_sql = "SELECT * FROM reservas";   

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        // Retorna el resultado de la consulta como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);   
    }

    // Obtiene un ccliente específica por su ID
    public function obtener_reserva_por_id($id_reserva) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener una categoría específica por su ID
        $consulta_sql = "SELECT * FROM reservas WHERE id_reserva= ?";

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $id_reserva);  // Asocia el valor del ID de categoría

        // Ejecuta la consulta
        $consulta->execute();

        // Retorna el resultado como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar_reserva($id_cliente, $id_destino, $fecha_viaje, $cantidad_personas,$estado) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para insertar una nueva categoría
        $sentencia_sql = "INSERT INTO reservas (id_cliente, id_destino, fecha_viaje, cantidad_personas, estado) VALUES (?, ?, ?, ?, ?)";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $id_cliente);
        $sentencia->bindValue(2, $id_destino);  
        $sentencia->bindValue(3, $fecha_viaje);  
        $sentencia->bindValue(4, $cantidad_personas);
        $sentencia->bindValue(5, $estado);
        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un insert, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualiza una categoría existente
    public function actualizar_reserva($id_reserva,$id_cliente, $id_destino, $fecha_viaje, $cantidad_personas,$estado) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para actualizar una categoría existente
        $sentencia_sql = "UPDATE reservas SET id_cliente= ?, id_destino = ?, fecha_viaje = ?, cantidad_personas = ?, estado = ? WHERE id_reserva= ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $id_cliente);  
        $sentencia->bindValue(2, $id_destino); 
        $sentencia->bindValue(3, $fecha_viaje );  
        $sentencia->bindValue(4, $cantidad_personas);  
        $sentencia->bindValue(5, $estado );  
        $sentencia->bindValue(6, $id_reserva);  
        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un update, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Desactiva (elimina lógicamente) una categoría
    public function eliminar_reserva($id_reserva) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para "eliminar" (desactivar) una categoría
        $sentencia_sql = "DELETE FROM reservas  WHERE $id_reserva= ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $id_reserva);  
        
        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un delete lógico, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>
