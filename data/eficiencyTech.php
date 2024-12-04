<?php
require_once "data/connection.php";

function obtenerEficiencia() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['numEmpleado'])) {
        $db = connection();

        $query = "CALL eficiencyTech();";
        $result = mysqli_query($db, $query);

        if (!$result) {
            die("Error al ejecutar la consulta: " . mysqli_error($db));
        }

        return $result;
    } else {
        die("Error: Usuario no autenticado.");
    }
}
?>
