<?php

class PacienteDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $fechaNacimiento;

    public function __construct($id = 0, $nombre = "", $apellido = "", $correo = "", $clave = "", $fechaNacimiento = ""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> fechaNacimiento = $fechaNacimiento;
    }

       
    public function autenticar(){
        return "select idPaciente
                from Paciente
                where correo = '" . $this -> correo . "' and clave = '" . md5($this -> clave) . "'";
    }
    
    public function consultar(){
        return "select p.nombre, p.apellido, p.correo, p.fechaNacimiento  
                from Paciente p
                where idPaciente = '" . $this -> id . "'";
    }

    public function buscar($filtro){
        $sql = "select p.idPaciente, p.nombre, p.apellido, p.correo from Paciente p where ";
        $filtro = explode(" ", trim( $filtro ));
        foreach ($filtro as $palabra) {
            $palabra = trim($palabra);
            // Verificar si la palabra no está vacía
            if (strlen($palabra) > 1) {
                $sql .= "p.nombre like '%$palabra%' or p.apellido like '%$palabra%' or ";
            }
        }
        $sql = substr($sql, 0, -3); // Eliminar el último 'or'
        echo $sql;
        return $sql;
    }
}
