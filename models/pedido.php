<?php

class Pedido {
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

	function getId() {
		return $this->id;
	}

    function getUsuario_id() {
		return $this->usuario_id;
	}

    function getProvincia() {
		return $this->provincia;
	}

	function getLocalidad() {
		return $this->localidad;
	}

	function getDireccion() {
		return $this->direccion;
	}

    function getCoste() {
		return $this->coste;
	}

    function getEstado() {
		return $this->estado;
	}

    function getFecha() {
		return $this->fecha;
	}

    function getHora() {
		return $this->hora;
	}

	function setId($id) {
		$this->id = $id;
	}

    function setUsuario_id($usuario_id) {
		$this->usuario_id = $usuario_id;
	}

	function setProvincia($provincia) {
		$this->provincia = $this->db->real_escape_string($provincia);
	}

    function setLocalidad($localidad) {
		$this->localidad = $this->db->real_escape_string($localidad);
	}

	function setDireccion($direccion) {
		$this->direccion = $direccion;
	}

	function setCoste($coste) {
		$this->coste = $coste;
	}

	function setEstado($estado) {
		$this->estado = $this->db->real_escape_string($estado);
	}

    function setFecha($fecha) {
		$this->fecha = $fecha;
	}

    function setHora($hora) {
		$this->hora = $hora;
	}

    public function getPedidos() {
        $sql = "SELECT * FROM pedidos ORDER BY id DESC";
        $pedidos = $this->db->query($sql);

        return $pedidos;
    }

	public function getOne() {
        $sql = "SELECT * FROM pedidos WHERE id = {$this->getId()}";
        $pedido = $this->db->query($sql);

        return $pedido->fetch_object();
    }

	public function save() {
        $sql = "INSERT INTO pedidos VALUES (NULL, {$this->getUsuario_id()}, '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
		$save = $this->db->query($sql);

        $result = false;
        if($save) {
            $result = true;
        }
		return $result;
    }

	public function save_linea() {
        $sql = "SELECT LAST_INSERT_ID() as 'pedido'";
        $query = $this->db->query($sql);
		$pedido_id = $query->fetch_object()->pedido;

		foreach($_SESSION['carrito'] as $elemento) {
			$producto = $elemento['producto'];
			$unidades = $elemento['unidades'];

			$insert = "INSERT INTO lineas_pedidos VALUES (NULL, {$pedido_id}, {$producto->id}, {$unidades});";
		    $save = $this->db->query($insert);
		}

		$result = false;
        if($save) {
            $result = true;
        }
		return $result;
    }

	public function getOneByUser() {
		$sql = "SELECT p.id, p.coste FROM pedidos p "
		      ."WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
		$pedido = $this->db->query($sql);

		return $pedido->fetch_object();
	}

	public function getAllByUser() {
		$sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
        $pedidos = $this->db->query($sql);

        return $pedidos;
	}

	public function getProductosByPedido($id) {
		$sql = "SELECT * FROM productos id IN "
		      ."(SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id})";

		$sql = "SELECT pr.*, lp.unidades FROM productos pr "
		      ."INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
			  ."WHERE lp.pedido_id = {$id}";
			  
		$productos = $this->db->query($sql);

		return $productos;
	}

	public function edit() {
        $sql = "UPDATE pedidos SET estado = '{$this->getEstado()}'";
		$sql .= " WHERE id = {$this->getID()}";
		$save = $this->db->query($sql);

        $result = false;
        if($save) {
            $result = true;
        }
		return $result;
    }

}   