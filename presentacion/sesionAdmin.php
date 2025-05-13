<?php
if($_SESSION["rol"] != "admin"){
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
}
$id = $_SESSION["id"];
$admin = new Admin($id);
$admin -> consultar();
echo "Hola " . $admin -> getNombre() . " " . $admin -> getApellido();
?>
<br>
AQUI VA EL MENU