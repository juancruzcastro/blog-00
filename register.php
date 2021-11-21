<?php

if (isset($_POST)){
    // CONEXIÓN A LA BASE DE DATOS
    require_once 'includes/conexion.php';

    if (!isset($_SESSION)){
        session_start();
    }

    // RECIBO VALORES DEL FORMULARIO DE REGISTRO
    $name       = isset($_POST['nombre'])   ? mysqli_real_escape_string($db, $_POST['nombre'])   : false;
    $lastName   = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email      = isset($_POST['email'])    ? mysqli_real_escape_string($db, trim($_POST['email']))    : false;
    $password   = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

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

    // APELLIDO
    if (!empty($lastName) && !is_numeric($lastName) && !preg_match("/[0-9]/", $lastName)){
        $lastName_validate = true;
    } else {
        $lastName_validate = false;
        $errores['apellido'] = "El apellido no es válido";
    }

    // EMAIL
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validate = true;
    } else {
        $email_validate = false;
        $errores['email'] = "El email no es válido";
    }

    // PASSWORD
    if (!empty($password)){
        $password_validate = true;
    } else {
        $password_validate = false;
        $errores['password'] = "La contraseña está vacía";
    }
    
    $guardar_user = false;

    if (count($errores) == 0){
        $guardar_user = true;

        // CIFRAR CONTRASEÑA
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

        // INSERTAR USUARIO EN LA TABLA USUARIO DE LA BBDD
        $sql = "INSERT INTO usuarios VALUES(null, '$name', '$lastName', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);

        if ($guardar){
            $_SESSION['completado'] = "Registro completado con éxito";
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar usuario";
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: index.php');

?>