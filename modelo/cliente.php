<?php
// Clase Categoria hereda de la clase Conectar
class cliente extends Conectar {

     // Obtiene todas las categorías activas
     public function obtener_cliente() {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener todas los clientes 
        $consulta_sql = "SELECT * FROM clientes";   

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        // Retorna el resultado de la consulta como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);   
    }

    // Obtiene un ccliente específica por su ID
    public function obtener_cliente_por_id($cedula) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener una categoría específica por su ID
        $consulta_sql = "SELECT * FROM clientes WHERE cedula= ?";

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $cedula);  // Asocia el valor del ID de categoría

        // Ejecuta la consulta
        $consulta->execute();

        // Retorna el resultado como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar_cliente($cedula,$nombre, $apellidos, $telefono, $correo) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para insertar una nueva categoría
        $sentencia_sql = "INSERT INTO clientes (cedula, nombre, apellidos, telefono, correo) VALUES (?, ?, ?, ?, ?)";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $cedula);
        $sentencia->bindValue(2, $nombre);  
        $sentencia->bindValue(3, $apellidos);  
        $sentencia->bindValue(4, $telefono);
        $sentencia->bindValue(5, $correo);
        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un insert, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualiza una categoría existente
    public function actualizar_cliente($cedula,$nombre, $apellidos, $telefono, $correo) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para actualizar una categoría existente
        $sentencia_sql = "UPDATE clientes SET nombre = ?, apellidos = ?, telefono = ?, correo = ? WHERE cedula = ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre);  
        $sentencia->bindValue(2, $apellidos); 
        $sentencia->bindValue(3, $telefono);  
        $sentencia->bindValue(4, $correo);  
        $sentencia->bindValue(5, $cedula);  
        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un update, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Desactiva (elimina lógicamente) una categoría
    public function eliminar_cliente($cedula) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para "eliminar" (desactivar) una categoría
        $sentencia_sql = "DELETE FROM clientes  WHERE cedula = ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $cedula);  
        
        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un delete lógico, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>
