<h1>Mis pedidos</h1>

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
            <td><?= Utils::showStatus($p->estado) ?></td>
        </tr>
    <?php endwhile ?>
</table>