<?php

if (isset($_POST)){
    // CONEXIÓN A LA BASE DE DATOS
    require_once 'includes/conexion.php';

    // RECIBO VALORES DEL LA CATEGORÍA
    $title       = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $description = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $category    = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $user = $_SESSION['usuario']['id'];

    // ARRAY DE ERRORES
    $errores = array();

    // VALIDO LOS DATOS ANTES DE GUARDARLOS

    // TÍTULO
    if (empty($title)){
        $errores['titulo'] = "El titulo no es válido";
    }

    // DESCRIPCIÓN
    if (empty($description)){
        $errores['descripcion'] = "La descripcion no es válida";
    }

    // CATEGORÍA
    if (empty($category) && !is_numeric($category)){
        $errores['categoria'] = "La categoria no es válida";
    }

    if (count($errores) == 0){
        if ($_GET['edit']){
            $entrada_id = $_GET['edit'];
            $user_id = $_SESSION['usuario']['id'];

            // EDITAR ENTRADA EN LA TABLA ENTRADA DE LA BBDD
            $sql = "UPDATE entradas SET titulo='$title', descripcion='$description', categoria_id=$category
                    WHERE id=$entrada_id AND usuario_id=$user_id";
        } else {
            // INSERTAR ENTRADA EN LA TABLA ENTRADA DE LA BBDD
            $sql = "INSERT INTO entradas VALUES(null, $user, $category, '$title', '$description', CURDATE());";
        }
        $guardar = mysqli_query($db, $sql);
        
        header('Location: index.php');
    } else {
        $_SESSION['errores_entrada'] = $errores;
        if ($_GET['edit']){
            header('Location: edit-ticket.php?id='.$_GET['edit']);
        } else {
            header('Location: create-tickets.php');
        }
    }
}

?>