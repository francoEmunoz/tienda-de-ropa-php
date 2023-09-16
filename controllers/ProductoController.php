<?php
require_once 'models/producto.php';

class ProductoController {

    public function index() {
        $producto = new Producto;
        $productos =  $producto->getRandom();

        require_once 'views/producto/destacados.php';
    }

    public function gestion() {
        Utils::isAdmin();

        $producto = new Producto();
        $productos = $producto->getProductos();

        require_once 'views/producto/gestion.php';
    }

    public function detalle() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            $producto = new Producto;
            $producto->setId($id);
            $pro = $producto->getOne();

        }

        require_once 'views/producto/detalle.php';
    }

    public function crear() {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function editar() {
        Utils::isAdmin();

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();

            require_once 'views/producto/crear.php';

        } else {
            header("Location:".base_url.'producto/gestion');
        }

    }

    public function save() {
        if(isset($_POST)) {
            $categoria_id = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;

            if($categoria_id && $nombre && $precio && $stock) {
                $producto = new Producto;
                $producto->setCategoria_id($categoria_id);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setOferta($oferta);

                if(isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];
    
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/git") {
                        if(!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        $producto->setImagen($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                    }
                }

                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);

                    $save = $producto->edit();
                } else {
                    $save = $producto->save();
                }

                if($save) {
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }

            } else {
                $_SESSION['producto'] = "failed";
            }
       
        } else {
            $_SESSION['producto'] = "failed";
        }
        header("Location:".base_url.'producto/gestion');
    }

    public function eliminar() {
        Utils::isAdmin();
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto;
            $producto->setId($id);
            $delete = $producto->delete();

            if($delete) {
                $_SESSION['delete'] = "complete";
            } else {
                $_SESSION['delete'] = "failed";
            }
        } else {
            $_SESSION['delete'] = "failed";
        }
        
        header("Location:".base_url.'producto/gestion');
    }

}