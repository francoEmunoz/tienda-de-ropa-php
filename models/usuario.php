<?php

class Usuario {
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    function getNombre() {
		return $this->nombre;
	}

	function getApellidos() {
		return $this->apellidos;
	}

	function getEmail() {
		return $this->email;
	}

	function getPassword() {
		return $this->password = password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost'=>4]);
	}

    function getRol() {
		return $this->rol;
	}

    function getImagen() {
		return $this->imagen;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setApellidos($apellidos) {
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}

	function setEmail($email) {
		$this->email = $this->db->real_escape_string($email);
	}

	function setPassword($password) {
		$this->password = $password;
	}

    function setRol($rol) {
		$this->rol = $rol;
	}

    function setImagen($imagen) {
		$this->imagen = $imagen;
	}

    public function save() {
        $sql = "INSERT INTO usuarios VALUES (NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null);";
		$save = $this->db->query($sql);

        $result = false;
        if($save) {
            $result = true;
        }
		return $result;
    }

	public function login() {
		$result = false;
		$email = $this->email;
		$password = $this->password;

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$login = $this->db->query($sql);

        if ($login && $login->num_rows == 1) {
			$usuario = $login->fetch_object();
	
			$verify = password_verify($password, $usuario->password);
	
			if ($verify) {
				$result = $usuario;
			}
		}

		return $result;
    }

}

