<h1>Gestionar Productos</h1>

<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <strong class="alert_green">Producto creado correctamente</strong>
<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed'): ?>
    <strong class="alert_red">Ocurrió un error</strong>
<?php endif ?>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green">Producto eliminado correctamente</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed'): ?>
    <strong class="alert_red">Ocurrió un error</strong>
<?php endif ?>

<a href="<?=base_url?>producto/crear" class="button button-small">
    Crear producto
</a>
<table>
    <tr>
        <th>ID</th>
        <th>CATEGORÍA</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr>
    <?php while($p = $productos->fetch_object()): ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= $p->categoria_id ?></td>
            <td><?= $p->nombre ?></td>
            <td>$ <?= $p->precio ?></td>
            <td><?= $p->stock ?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?= $p->id ?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?= $p->id ?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile ?>
</table>

<?php Utils::deleteSession('producto'); ?>
<?php Utils::deleteSession('delete'); ?>