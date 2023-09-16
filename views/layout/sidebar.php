<aside id="lateral">
    <?php if(isset($_SESSION['carrito'])): ?>
        <div id="carrito" class="block_aside">
            <h3>Mi carrito</h3>
            <?php $stats = Utils::statsCarrito() ?>
            <ul>
                <li>Productos: <?= $stats['count'] ?></li>
                <li>Total: $<?= $stats['total'] ?></li>
                <li><a href="<?=base_url?>carrito/index">Ver el carrito</a></li>
            </ul>
        </div>
    <?php endif ?>

    <div id="login" class="block_aside">

        <?php if (!isset($_SESSION['identity'])): ?>
            <h3>Entrar a la web</h3>
            <form action="<?=base_url?>usuario/login" method="post">
                <label for="email">Email</label>
                <input type="email" name="email">
                <label for="password">Contraseña</label>
                <input type="password" name="password">
                <input type="submit" value="Enviar">
            </form>
            <ul>
                <li><a href="<?=base_url?>usuario/registro">Registrarse</a></li>
            </ul>
        <?php else: ?>
            <h3><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellidos ?></h3>
            <ul>
                <li><a href="<?=base_url?>pedido/mispedidos">Mis pedidos</a></li>
            </ul>
        <?php endif ?>

        <ul>
            <?php if (isset($_SESSION['admin'])): ?>
                <li>
                    <a href="<?=base_url?>categoria/gestion">Gestionar categorías</a>
                </li>
                <li>
                    <a href="<?=base_url?>producto/gestion">Gestionar productos</a>
                </li>
                <li>
                    <a href="<?=base_url?>pedido/gestion">Gestionar pedidos</a>
                </li>
            <?php endif ?>
            <?php if (isset($_SESSION['identity'])): ?>
                <li>
                    <a href="<?=base_url?>usuario/logout">Cerrar sesión</a>
                </li>
            <?php endif ?>
        </ul>
    </div>
</aside>

<div id="central">