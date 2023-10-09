<?php
include('conexion.php');
$con = conectaDB();

if(isset($_GET['idp'])) {
    $idProducto = $_GET['idp'];
    // Realizar la consulta para eliminar el producto de la base de datos
    $sql = "DELETE FROM tb_productos WHERE idPro = $idProducto";
    
    if(mysqli_query($con, $sql)) {
        // Éxito al eliminar el producto, redireccionar a dashboard.php con un mensaje de éxito
        header("Location: dashboard.php?success_message=Producto eliminado correctamente");
        exit();
    } else {
        // Error al eliminar el producto, redireccionar a dashboard.php con un mensaje de error
        header("Location: dashboard.php?error_message=Error al eliminar el producto");
        exit();
    }
} else {
    // Si no se proporciona un ID válido, redireccionar a dashboard.php con un mensaje de error
    header("Location: dashboard.php?error_message=ID de producto no válido");
    exit();
}
?>