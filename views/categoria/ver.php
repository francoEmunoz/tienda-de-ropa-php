<?php if(isset($cat)): ?>
    <h1><?= $cat->nombre ?></h1>
    <?php if($productos->num_rows == 0): ?>
        <p>No hay productos para mostrar</p>
    <?php else: ?>
        <?php while($p = $productos->fetch_object()): ?>
            <div class="product">
                <a href="<?=base_url?>producto/detalle&id=<?=$p->id?>">
                   <img src="<?=base_url?>assets/img/camiseta.png" alt="">
                   <h2><?= $p->nombre ?></h2>
                </a>   
                   <p>$ <?= $p->precio ?></p>
                   <a href="<?=base_url?>carrito/add&id=<?= $p->id ?>" class="button">Comprar</a>
            </div>
        <?php endwhile ?>
    <?php endif ?>
<?php else: ?>
    <h1>La categoría no existe</h1>
<?php endif ?>