<?php
require_once 'conexion.php'; 
require_once 'includes/helpers.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Conversio</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>

    <!-- CABECERA -->
    <header id="cabecera">
                
        <!-- LOGO -->
        <div id="logo">
            <a href="#">Blog de Conversio</a>
        </div>

        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <?php
                    $categorias = conseguirCategorias($db);
                    if (!empty($categorias)):
                        while ($categoria = mysqli_fetch_assoc($categorias)):
                ?>
                            <li>
                                <a href="category.php?id=<?=$categoria['id'];?>"><?= $categoria['nombre']; ?></a>
                            </li>
                <?php
                        endwhile;
                    endif;
                ?>
                <li>
                    <a href="#">Sobre Mi</a>
                </li>
                <li>
                    <a href="#">Contacto</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="contenedor">