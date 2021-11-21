<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/header.php'; ?>        

<!-- BARRA LATERAL -->
<?php require_once 'includes/aside.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear entradas</h1>
    <p>
        Añade nuevas entradas al blog para que los usuarios puedan leerlas y
        disfrutar de nuestro contenido.
    </p>
    <br />

    <form action="save-tickets.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" />
        <?php echo isset($_SESSION['errores_entrada']['titulo']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" cols="30" rows="10"></textarea>
        <?php echo isset($_SESSION['errores_entrada']['descripcion']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>

        <label for="categoria">Categoría:</label>
        <select name="categoria">
            <?php
                $categorias = conseguirCategorias($db);
                if (!empty($categorias)):
                    while ($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                        <option value="<?= $categoria['id']; ?>">
                            <?= $categoria['nombre']; ?>
                        </option>
            <?php
                    endwhile;
                endif;
            ?>
        </select>
        <?php echo isset($_SESSION['errores_entrada']['categoria']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>

        <input type="submit" value="Guardar">
    </form>
    <?php borrarError(); ?>
</div>

<!-- PIE DE PAGINA -->
<?php require_once 'includes/footer.php'; ?>