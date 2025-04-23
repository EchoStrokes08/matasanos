<?php
class MedicoDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $esp;

    public function __construct($id = 0, $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $esp = ""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> esp = $esp;
    }


    public function consultarPorEspecialidad(){
        return "select m.idMedico, m.nombre, m.apellido, m.correo, m.clave, m.foto from Medico as m where Especialidad_id = " . $this -> esp -> getId() . " order by m.apellido asc";
    }
    
}