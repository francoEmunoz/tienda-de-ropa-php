<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] = "complete"): ?>

    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con éxito, una vez realizada la transferencia bancaria
        con el coste del pedido, será procesado y enviado.
    </p>
    <br/>
    <?php if(isset($pedido)): ?>
    
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
            <?php while($producto = $productos->fetch_object()): ?>  
                <tr>
                    <td>
                        <img src="<?=base_url?>assets/img/camiseta.png" class="img_carrito">
                    </td>
                    <td><?= $producto->nombre ?></td>
                    <td><?= $producto->precio ?></td>
                    <td><?= $producto->unidades ?></td>
                </tr>  
            <?php endwhile ?>
        </table>
        <br>

        <h3>Datos del pedido:</h3>
        <p>Número de pedido: <?= $pedido->id ?></p> 
        <p>Total a pagar: <?= $pedido->coste ?></p>

    <?php endif ?>
            
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] = "failed"): ?>

    <h1>Ocurrió un error al relizar el pedido</h1>

<?php endif ?>