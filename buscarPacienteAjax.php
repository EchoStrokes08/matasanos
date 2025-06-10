<?php
require("logica/Persona.php");
require("logica/Paciente.php");

$filtro = $_GET["filtro"] ?? '';
$pacientes = (new Paciente())->buscar($filtro);

function resaltar($texto, $filtro) {
    $filtros = array_filter(explode(" ", trim($filtro)), fn($p) => strlen($p) > 1);
    $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    foreach ($filtros as $p) {
        $texto = preg_replace_callback(
            "/" . preg_quote($p, "/") . "/i",
            fn($m) => "<strong>" . $m[0] . "</strong>",
            $texto
        );
    }
    return $texto;
}

if ($pacientes) {
    echo "<table class='table table-striped table-hover mt-3'>
        <tr><th>Id</th><th>Nombre</th><th>Apellido</th><th>Correo</th></tr>";
    foreach ($pacientes as $p) {
        echo "<tr>
            <td>{$p->getId()}</td>
            <td>" . resaltar($p->getNombre(), $filtro) . "</td>
            <td>" . resaltar($p->getApellido(), $filtro) . "</td>
            <td>{$p->getCorreo()}</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados</div>";
}
