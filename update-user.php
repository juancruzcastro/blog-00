<?php

if (isset($_POST)){
    // CONEXIÓN A LA BASE DE DATOS
    require_once 'includes/conexion.php';

    // RECIBO VALORES DEL FORMULARIO DE ACTUALIZACIÓN
    $name       = isset($_POST['nombre'])   ? mysqli_real_escape_string($db, $_POST['nombre'])   : false;
    $lastName   = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email      = isset($_POST['email'])    ? mysqli_real_escape_string($db, trim($_POST['email']))    : false;

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
    
    $guardar_user = false;

    if (count($errores) == 0){
        $user = $_SESSION['usuario'];
        $guardar_user = true;

        // COMPROBAR SI EL EMAIL EXISTE
        $sql = "SELECT email, id FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);

        if ($isset_user['id'] == $user['id'] || empty($isset_user)){
            // ACTUALIZAR USUARIO EN LA TABLA USUARIO DE LA BBDD
            $sql = "UPDATE usuarios SET 
                    nombre = '$name', apellidos = '$lastName', email = '$email'
                    WHERE id = ".$user['id'];
            $guardar = mysqli_query($db, $sql);

            if ($guardar){
                $_SESSION['usuario']['nombre']   = $name;
                $_SESSION['usuario']['apellidos'] = $lastName;
                $_SESSION['usuario']['email']    = $email;
                $_SESSION['completado'] = "Actualización completada con éxito";
            } else {
                $_SESSION['errores']['general'] = "Fallo al actualizar usuario";
            }
        } else {
            $_SESSION['errores']['general'] = "El usuario ya existe";
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: my-data.php');

?>