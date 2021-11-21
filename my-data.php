<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/header.php'; ?>        

<!-- BARRA LATERAL -->
<?php require_once 'includes/aside.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Mis datos</h1>
    
    <!-- MOSTRAR ERRORES -->
    <?php if (isset($_SESSION['completado'])): ?>
        <div class="alerta alerta-exito">
            <?= $_SESSION['completado'] ?>
        </div>
    <?php elseif (isset($_SESSION['errores']['general'])): ?>
        <div class="alerta alerta-error">
            <?= $_SESSION['errores']['general'] ?>
        </div>
    <?php endif; ?>

    <form action="update-user.php" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre']; ?>" />
        <?php echo isset($_SESSION['errores']['nombre']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" value="<?= $_SESSION['usuario']['apellidos']; ?>" />
        <?php echo isset($_SESSION['errores']['apellido']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?= $_SESSION['usuario']['email']; ?>" />
        <?php echo isset($_SESSION['errores']['email']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

        <input type="submit" name="submit" value="Actualizar" />
    </form>
    <?php isset($_SESSION['errores']) || isset($_SESSION['completado']) ? borrarError() : ''; ?>
</div>

<!-- PIE DE PAGINA -->
<?php require_once 'includes/footer.php'; ?>