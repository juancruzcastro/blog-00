<?php require_once 'includes/header.php'; ?>        

<!-- BARRA LATERAL -->
<?php require_once 'includes/aside.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Últimas entradas</h1>

    <?php
        $entradas = conseguirEntradas($db, true);
        if (!empty($entradas)):
            while ($entrada = mysqli_fetch_assoc($entradas)):
    ?>
                <article class="entrada">
                    <a href="ticket.php?id=<?=$entrada['id'];?>">
                        <h2><?= $entrada['titulo']; ?></h2>
                        <span class="fecha"><?= $entrada['categoria']. ' | ' .$entrada['fecha']; ?></span>
                        <p>
                            <?= substr($entrada['descripcion'], 0, 180)."..."; ?>
                        </p>
                    </a>
                </article>
    <?php
            endwhile;
        endif;
    ?>

    <div id="ver-todas">
        <a href="tickets.php">Ver todas las entradas</a>
    </div>
</div>

<!-- PIE DE PAGINA -->
<?php require_once 'includes/footer.php'; ?>