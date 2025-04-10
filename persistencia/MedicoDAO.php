<?php
class MedicoDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $idEsp;

    public function __construct($id = 0, $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $idEsp = ""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> idEsp = $idEsp;
    }


    public function consultarPorEspecialidad(){
        return "select m.idMedico, m.nombre, m.apellido, m.correo, m.clave, m.foto from medico as m where Especialidad_id = " . $this -> idEsp . " order by m.nombre asc";
    }
    
}