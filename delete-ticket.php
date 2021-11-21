<?php

require_once 'includes/conexion.php';

if (isset($_SESSION['usuario']) && isset($_GET['id'])){
    $ticket_id = $_GET['id'];
    $user_id = $_SESSION['usuario']['id'];

    $sql = "DELETE FROM entradas WHERE usuario_id = $user_id AND id = $ticket_id";
    $borrar = mysqli_query($db, $sql);
}

header("Location: index.php");

?>