<?php
class Persona{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;

    public function __construct($id = 0, $nombre = "", $apellido = "", $correo = "", $clave = ""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }

    public function getId(){
        return $this -> id;
    }
    public function getNombre(){
        return $this -> nombre;
    }

    public function getApellido(){
        return $this -> apellido;
    }

    # ...
}