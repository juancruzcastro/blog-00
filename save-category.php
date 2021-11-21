<?php

if (isset($_POST)){
    // CONEXIÓN A LA BASE DE DATOS
    require_once 'includes/conexion.php';

    // RECIBO VALORES DEL LA CATEGORÍA
    $name       = isset($_POST['nombre'])   ? mysqli_real_escape_string($db, $_POST['nombre'])   : false;

    // ARRAY DE ERRORES
    $errores = array();

    // VALIDO LOS DATOS ANTES DE GUARDARLOS

    // NOMBRE
    if (!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)){
        $name_validate = true;
    } else {
        $name_validate = false;
        $errores['nombre'] = "El nombre no es válido";
    }

    if (count($errores) == 0){
        // INSERTAR USUARIO EN LA TABLA USUARIO DE LA BBDD
        $sql = "INSERT INTO categorias VALUES(null, '$name');";
        $guardar = mysqli_query($db, $sql);
    }
}

header('Location: index.php');

?>