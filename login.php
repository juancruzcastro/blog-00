<?php
// INICIAR SESIÓN Y CONEXIÓN A BD
require_once 'includes/conexion.php';

// RECOGER DATOS
if (isset($_POST)){
    // BORRAR ERROR
    if (isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }

    // RECOGER DATOS USUARIO
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // CONSULTA COMPROBAR LOGUEO
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);

        // COMPROBAR CONTRASEÑA
        $verify = password_verify($password, $usuario['password']);

        if ($verify){
            // SESIÓN CON DATOS DEL USUARIO LOGUEADO
            $_SESSION['usuario'] = $usuario;
        } else {
            // SESIÓN CON FALLO
            $_SESSION['error_login'] = "Login incorrecto";
        }
    } else {
        // MENSAJE ERROR
        $_SESSION['error_login'] = "Login incorrecto";
    }
}

// REDIRECCIÓN A INDEX
header('Location: index.php');

?>