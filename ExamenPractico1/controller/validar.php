<?php
include('../conexion.php');
$conn = conectaDB();

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener los valores enviados por el formulario
$loginUsername = $_POST['loginUsername'];
$loginPassword = $_POST['loginPassword'];

// Consulta para validar el usuario y contraseña en la base de datos
$sql = "SELECT * FROM tb_usuarios WHERE NomUser = '$loginUsername' AND Passwd = '$loginPassword'";
$result = $conn->query($sql);

// Verificar si se encontró un registro coincidente en la base de datos
if ($result->num_rows > 0) {
    session_start();
    $_SESSION['login'] = "true";
    $_SESSION['nom_completo'] = $loginUsername;
    echo json_encode(array('success' => 1));
} else {
    echo json_encode(array('success' => 0));
}

// Cerrar la conexión a la base de datos
$conn->close();
?>