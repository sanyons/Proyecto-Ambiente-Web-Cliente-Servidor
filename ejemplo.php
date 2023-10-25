<?php

// Iniciar la sesión
session_start();

// Verificar si se ha pasado un ID de producto
if (isset($_GET['id'])) {
    // Obtener el ID del producto
    $product_id = $_GET['id'];

    // Conexión a la base de datos (reemplaza los valores con los de tu configuración)
    $server = "localhost";
            $user = "root";
            $password = "";
            $dataBase = "tienda";
            //1. Establecer la conexion mysqli
            $conn = mysqli_connect($server, $user, $password, $dataBase);

    // Verificar la conexión
    if ($conn->connect_error) {
        error_log("Error de conexión a la base de datos: " . $conn->connect_error, 0);
        echo "Hubo un error al conectar a la base de datos.";
    } else {
        // Consulta para obtener el producto
        $sql = "SELECT * FROM productos WHERE id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Agregar el producto al carrito de compras 
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = array();
            }

            $_SESSION['carrito'][] = $row;
        } else {
            error_log("Error al obtener el producto con ID $product_id de la base de datos.", 0);
            echo "Hubo un error al obtener el producto.";
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    }
}

// Redirigir de vuelta a la página de productos
header("Location: index.php");