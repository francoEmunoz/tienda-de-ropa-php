<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class CategoriaController {

    public function gestion() {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();

        require_once 'views/categoria/gestion.php';
    }

    public function ver() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            $categoria = new Categoria;
            $categoria->setId($id);
            $cat = $categoria->getOne();

            $producto = new Producto;
            $producto->setCategoria_id($id);
            $productos = $producto->getProductosCat();
        }

        require_once 'views/categoria/ver.php';
    }

    public function crear() {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save() {
        if(isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;

            if($nombre) {
                $categoria = new Categoria;
                $categoria->setNombre($nombre);
                $save = $categoria->save();
    
                if($save) {
                    $_SESSION['categoria'] = "complete";
                } else {
                    $_SESSION['categoria'] = "failed";
                }

            } else {
                $_SESSION['categoria'] = "failed";
            }
       
        } else {
            $_SESSION['categoria'] = "failed";
        }
        header("Location:".base_url.'categoria/gestion');
    }

}