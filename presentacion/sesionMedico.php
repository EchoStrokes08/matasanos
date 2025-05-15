<?php
if($_SESSION["rol"] != "medico"){
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
}

$id = $_SESSION["id"];
$medico = new Medico($id);
$medico -> consultar();
echo "Hola " . $medico -> getNombre() . " " . $medico -> getApellido();
echo "<br> Usted tiene la especialidad: " . $medico -> getEspecialidad() -> getNombre();
