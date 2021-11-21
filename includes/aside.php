<aside id="sidebar">
    <div id="seeker" class="bloque">
        <h3>Buscar</h3>

        <form action="search.php" method="POST">
            <input type="text" name="busqueda" />
            <input type="submit" value="Buscar" />
        </form>
    </div>

    <?php if (isset($_SESSION['usuario'])): ?>
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, <?= $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?></h3>
            <!-- BOTONES -->
            <a href="create-tickets.php" class="boton boton-verde">Crear entradas</a>
            <a href="create-category.php" class="boton">Crear categoría</a>
            <a href="my-data.php" class="boton boton-naranja">Mis datos</a>
            <a href="sing-off.php" class="boton boton-rojo">Cerrar sesión</a>
        </div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['usuario'])): ?>
        <div id="login" class="bloque">
            <h3>Identificate</h3>

            <?php if (isset($_SESSION['error_login'])): ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login']; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" />

                <label for="password">Contraseña</label>
                <input type="password" name="password" />

                <input type="submit" value="Entrar" />
            </form>
        </div>

        <div id="register" class="bloque">
            <h3>Registrate</h3>

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

            <form action="register.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" />
                <?php echo isset($_SESSION['errores']['nombre']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" />
                <?php echo isset($_SESSION['errores']['apellido']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>

                <label for="email">Email</label>
                <input type="email" name="email" />
                <?php echo isset($_SESSION['errores']['email']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                <label for="password">Contraseña</label>
                <input type="password" name="password" />
                <?php echo isset($_SESSION['errores']['password']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

                <input type="submit" name="submit" value="Registrar" />
            </form>
            <?php isset($_SESSION['errores']) || isset($_SESSION['completado']) ? borrarError() : ''; ?>
        </div>
    <?php endif; ?>
</aside>