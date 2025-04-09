<?php 
require "logica/Persona.php";
require "persistencia/MedicoDAO.php";

class Medico extends Persona{

    private $foto;
    private $idEsp;
    public function __construct($id = 0, $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $idEsp = ""){
        parent::__construct($id, $nombre, $apellido, $correo, $clave);
        $this->foto = $foto;
        $this->idEsp = $idEsp;
    }
    public function consultarPorEspecialidad(){
        $medicos = array();
        $conexion = new Conexion();
        $conexion -> abrir();

        $dDao = new MedicoDAO(idEsp: $this->idEsp);
        $conexion -> ejecutar($dDao -> consultarPorEspecialidad());
        while(($dato = $conexion -> registro()) != null){
            //Se toman los datos y se guardan dentro de doctores
            $medico = new Medico(
                $dato["0"],
                $dato["1"],
                $dato["2"],
                $dato["3"],
                $dato["4"],
                $dato["5"]
            );

            array_push($medicos, $medico);
        }
        $conexion -> cerrar();

        return $medicos;
    }

    public function setIdEsp( $idEsp ){
        $this->idEsp = $idEsp;
    }
}