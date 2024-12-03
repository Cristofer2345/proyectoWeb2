<?php
// Clase Categoria hereda de la clase Conectar
class destino extends Conectar {


         // Obtiene todas las categorías activas
         public function obtener_destino() {
            // Establece la conexión a la base de datos
            $conexion = parent::conectar_bd();
            parent::establecer_codificacion();
            
            // Consulta SQL para obtener todas los clientes 
            $consulta_sql = "SELECT * FROM destino";   
    
            // Prepara la consulta SQL
            $consulta = $conexion->prepare($consulta_sql);
            $consulta->execute();
    
            // Retorna el resultado de la consulta como un array asociativo
            return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);   
        }
    
        // Obtiene un ccliente específica por su ID
        public function obtener_destino_por_id($id_destino) {
            // Establece la conexión a la base de datos
            $conexion = parent::conectar_bd();
            parent::establecer_codificacion();
            
            // Consulta SQL para obtener una categoría específica por su ID
            $consulta_sql = "SELECT * FROM destino WHERE id_destino= ?";
    
            // Prepara la consulta SQL
            $consulta = $conexion->prepare($consulta_sql);
            $consulta->bindValue(1, $id_destino);  // Asocia el valor del ID de categoría
    
            // Ejecuta la consulta
            $consulta->execute();
    
            // Retorna el resultado como un array asociativo
            return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function insertar_destino($nombre, $pais, $descripcion, $duracion, $precio_persona) {
            // Establece la conexión a la base de datos
            $conexion = parent::conectar_bd();
            parent::establecer_codificacion();
            
            // Sentencia SQL para insertar una nueva categoría
            $sentencia_sql = "INSERT INTO destino (nombre, pais, descripcion, duracion, precio_persona) VALUES (?, ?, ?, ?, ?)";
    
            // Prepara la sentencia SQL
            $sentencia = $conexion->prepare($sentencia_sql);
            $sentencia->bindValue(1, $nombre);  
            $sentencia->bindValue(2, $pais);  
            $sentencia->bindValue(3, $descripcion);
            $sentencia->bindValue(4, $duracion);
            $sentencia->bindValue(5, $precio_persona);
            // Ejecuta la sentencia
            $sentencia->execute();
    
            // Retorna el resultado (aunque no es necesario para un insert, se puede omitir)
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Actualiza una categoría existente
        public function actualizar_destino($id_destino,$nombre, $pais, $descripcion, $duracion,$precio_persona) {
            // Establece la conexión a la base de datos
            $conexion = parent::conectar_bd();
            parent::establecer_codificacion();
            
            // Sentencia SQL para actualizar una categoría existente
            $sentencia_sql = "UPDATE destino SET nombre = ?, pais= ?, descripcion= ?, duracion = ? , precio_persona = ? WHERE id_destino = ?";
    
            // Prepara la sentencia SQL
            $sentencia = $conexion->prepare($sentencia_sql);
            $sentencia->bindValue(1, $nombre);  
            $sentencia->bindValue(2, $pais);  
            $sentencia->bindValue(3, $descripcion);
            $sentencia->bindValue(4, $duracion);
            $sentencia->bindValue(5, $precio_persona);  
            $sentencia->bindValue(6, $id_destino);  
            // Ejecuta la sentencia
            $sentencia->execute();
    
            // Retorna el resultado (aunque no es necesario para un update, se puede omitir)
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Desactiva (elimina lógicamente) una categoría
        public function eliminar_destino($id_destino) {
            // Establece la conexión a la base de datos
            $conexion = parent::conectar_bd();
            parent::establecer_codificacion();
            
            // Sentencia SQL para "eliminar" (desactivar) una categoría
            $sentencia_sql = "DELETE FROM destino  WHERE id_destino = ?";
    
            // Prepara la sentencia SQL
            $sentencia = $conexion->prepare($sentencia_sql);
            $sentencia->bindValue(1, $id_destino);  
            
            // Ejecuta la sentencia
            $sentencia->execute();
    
            // Retorna el resultado (aunque no es necesario para un delete lógico, se puede omitir)
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }

}
?>
