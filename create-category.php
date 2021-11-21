<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/header.php'; ?>        

<!-- BARRA LATERAL -->
<?php require_once 'includes/aside.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear categorías</h1>
    <p>
        Añade nuevas categorías al blog para que los usuarios puedan usarlas
        al crear sus entradas.
    </p>
    <br />

    <form action="save-category.php" method="POST">
        <label for="nombre">Nombre de la categoría</label>
        <input type="text" name="nombre" />

        <input type="submit" value="Guardar">
    </form>
</div>

<!-- PIE DE PAGINA -->
<?php require_once 'includes/footer.php'; ?>