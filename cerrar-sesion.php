<?php
// Iniciar la sesión si no está iniciada
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio de sesión u otra página deseada
header("Location: login.php"); // Cambia 'index.php' por la URL de la página a la que quieras redirigir
exit();
?>
