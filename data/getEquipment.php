<?php
require_once "data/connection.php";

function getEquipments($search = null) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['numEmpleado'])) {
        $db = connection();

        if ($search) {
            $query = "CALL searchEquipments('$search');";
        } else {
            $query = "CALL verEquipos();";
        }

        $result = mysqli_query($db, $query);

        if (!$result) {
            die("Error al ejecutar la consulta: " . mysqli_error($db));
        }
        return $result;
    }
    return null;
}
?>