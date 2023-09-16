<?php if(isset($pro)): ?>
    <h1><?= $pro->nombre ?></h1>
    <div id="detail-product">
        <div class="image">
            <img src="<?=base_url?>assets/img/camiseta.png">
        </div>
        <div class="data">
            <p class="descripcion"><?= $pro->descripcion ?></p>
            <p class="price">$<?= $pro->precio ?></p>
            <a href="<?=base_url?>carrito/add&id=<?= $pro->id ?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif ?>