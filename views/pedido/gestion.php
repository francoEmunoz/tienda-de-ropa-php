<h1>Gestionar Pedidos</h1>

<!-- <a href="<?=base_url?>categoria/crear" class="button button-small">
    Crear categoria
</a> -->
<table>
    <tr>
        <th>N° DE PEDIDO</th>
        <th>COSTE</th>
        <th>FECHA</th>
        <th>ESTADO</th>
    </tr>
    <?php while($p = $pedidos->fetch_object()): ?>
        <tr>
            <td><a href="<?=base_url?>pedido/detalle&id=<?= $p->id ?>"><?= $p->id ?></a></td>
            <td><?= $p->coste ?></td>
            <td><?= $p->fecha ?></td>
            <td><?= $p->estado ?></td>
        </tr>
        <?php endwhile ?>
</table>