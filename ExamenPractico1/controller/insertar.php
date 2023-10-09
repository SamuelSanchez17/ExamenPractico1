<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $existencia = $_POST["existencia"];
    
    // Validar los datos 
    if (empty($nombre) || empty($precio) || empty($existencia)) {
        $response = array('success' => 0, 'message' => 'Todos los campos son obligatorios.');
    } else {
        // Conectar a la base de datos
        include('../conexion.php');
        $con = conectaDB();
        
        // Insertar el nuevo producto en la base de datos
        $sql = "INSERT INTO tb_productos(Nombre, Precio, Ext) VALUES ('$nombre', '$precio', '$existencia')";
        if (mysqli_query($con, $sql)) {
            // Producto registrado con éxito
            $response = array('success' => 1, 'message' => 'Producto registrado con éxito.');
            
        } else {
            $error_message = "Error al registrar el producto: " . mysqli_error($con);
            
            // Crear un arreglo asociativo para el mensaje de error
            $response = array('success' => 0, 'message' => $error_message);
        }
        
        // Cerrar la conexión
        mysqli_close($con);
    }
    
    // Enviar la respuesta JSON al cliente
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>