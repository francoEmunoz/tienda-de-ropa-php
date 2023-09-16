<?php
require_once 'models/pedido.php';
require_once 'models/producto.php';

class PedidoController {

    public function gestion() {
        Utils::isAdmin();
        $pedido = new Pedido();
        $pedidos = $pedido->getPedidos();

        require_once 'views/pedido/gestion.php';
    }

    public function hacer() {
        if(isset($_SESSION['carrito'])) {
            require_once 'views/pedido/hacer.php';
        } else {
            header("Location:".base_url);
        }
    }

    public function save() {
        if(isset($_POST) && isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $coste = Utils::statsCarrito();

            if($provincia && $localidad && $direccion) {
                $pedido = new Pedido();
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setUsuario_id($usuario_id);
                $pedido->setCoste($coste['total']);

                $save = $pedido->save();
                $save_lineas = $pedido->save_linea();

                foreach($_SESSION['carrito'] as $indice => $elemento){
                    $producto_id = (int)$elemento['producto']->id;
                    $unidades = $elemento['unidades'];

                    $producto = new Producto();
                    $producto->setId($producto_id);
                    $save_stock = $producto->stock($unidades);
                }
    
                if($save && $save_lineas && $save_stock) {
                    Utils::deleteSession('carrito');
                    $_SESSION['pedido'] = "complete";
                } else {
                    $_SESSION['pedido'] = "failed";
                }

            } else {
                $_SESSION['pedido'] = "failed";
            }

            header("Location:".base_url."pedido/confirmado");

        } else {
            $_SESSION['pedido'] = "failed";
            header("Location:".base_url);
        }

    }
    
    public function confirmado() {
        if(isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOneByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);

        }
        require_once 'views/pedido/confirmado.php';
    }

    public function misPedidos() {
        Utils::isIdentity();
        $identity = $_SESSION['identity'];
        $pedido = new Pedido();
        $pedido->setUsuario_id($identity->id);
        $pedidos = $pedido->getAllByUser();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle() {
        Utils::isIdentity();

        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);

            require_once 'views/pedido/detalle.php';

        } else {
            header("Location:".base_url);
        }

    }

    public function estado() {
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();

            header("Location:".base_url."pedido/detalle&id=".$id);

        } else {
            header("Location:".base_url);
        }
    }

}