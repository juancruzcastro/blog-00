<?php

// CONEXION
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'blog_conversio';
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

// INICIAR SESIÓN
if (!isset($_SESSION)){
    session_start();
}

?>