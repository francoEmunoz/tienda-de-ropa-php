<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
    <h1>Editar: <?= $pro->nombre ?></h1>
    <?php $url = base_url."producto/save&id=".$pro->id ?>
<?php else: ?>
    <h1>Crear productos</h1>
    <?php $url = base_url."producto/save" ?>
<?php endif ?>

<form action="<?= $url ?>" method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?= isset($pro) ? $pro->nombre : '' ?>" required>

    <label for="descripcion">Descripcion</label>
    <textarea rows="5" cols="100" name="descripcion"><?= isset($pro) ? $pro->descripcion : '' ?></textarea>

    <label for="precio">Precio</label>
    <input type="number" name="precio" value="<?= isset($pro) ? $pro->precio : '' ?>" required>

    <label for="stock">Stock</label>
    <input type="number" name="stock" value="<?= isset($pro) ? $pro->stock : '' ?>" required>

    <label for="categoria">Categoría</label>
    <?php $categorias = Utils::showCategorias() ?>
    <select name="categoria">
        <?php while($cat = $categorias->fetch_object()): ?>
            <option value="<?= $cat->id ?>"<?= isset($pro) && $pro->categoria_id == $cat->id ? 'selected' : '' ?>>
                <?= $cat->nombre ?>
            </option>
        <?php endwhile ?>
    </select>

    <label for="imagen">Imagen</label>
    <?php if(isset($pro) && !empty($pro->imagen)): ?>
        <img src="<?= base_url ?>/uploads/images/<?= $pro->imagen ?>" class="thumb">
    <?php endif ?>
    <input type="file" name="imagen">

    <input type="submit" value="Guardar">
</form>