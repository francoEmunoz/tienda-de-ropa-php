<h1>Productos destacados</h1>

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
