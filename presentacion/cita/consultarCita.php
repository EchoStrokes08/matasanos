<?php 
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
?>
<body>
<?php 
include ("presentacion/encabezado.php");
include ("presentacion/menu" . ucfirst($rol) . ".php");

$success = false;


if(isset($_POST["guardar"]) && isset($_POST["estado"])){
	$estado = $_POST["estado"];
	$cita = new Cita();
	foreach($estado as $idCita => $idEstado){
		$cita->setId($idCita);
		$cita -> consultarPorId();
		$estadoAnterior = $cita->getEstadoCita()->getId(); 
		$estadoNuevo = $idEstado;
		if($estadoAnterior != $estadoNuevo){
			$cita->setEstadoCita(new EstadoCita($estadoNuevo));
			$cita->cambiarEstado();
		}
	}
	echo "<script>console.log('Estado de las citas actualizado');</script>";
	$success = true;
}

$cita = new Cita();
$citas = $cita->consultar($rol, $id);

?>
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<?php if($success == true && $rol == "admin") { echo "<div class='alert alert-success text-center' role='alert'>Estado de las citas actualizado</div>"; } ?>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title text-center">Citas</h4>
				</div>
				<div class="card-body">
    				<?php 
    				$cita = new Cita();
    				$citas = $cita -> consultar($rol, $id);
    				echo "<table class='table table-striped table-hover'>";
    				echo "<tr><td>Id</td><td>Fecha</td><td>Hora</td>";
    				if($rol != "paciente"){
    				    echo "<td>Paciente</td>";
    				}
    				if($rol != "medico"){
    				    echo "<td>Medico</td>";
    				}
                    echo "<td>Consultorio</td></tr>";
    				foreach($citas as $cit){
    				    echo "<tr>";
    				    echo "<td>" . $cit -> getId() . "</td>";
    				    echo "<td>" . $cit -> getFecha() . "</td>";
    				    echo "<td>" . $cit -> getHora() . "</td>";
    				    if($rol != "paciente"){
        				    echo "<td>" . $cit -> getPaciente() -> getNombre() . " " . $cit -> getPaciente() -> getApellido() . "</td>";
    				    }
    				    if($rol != "medico"){
    				        echo "<td>" . $cit -> getMedico() -> getNombre() . " " . $cit -> getMedico() -> getApellido() . "</td>";
    				    }
                        echo "<td>" . $cit -> getConsultorio() -> getNombre() . "</td>";
    				    echo "</tr>";
    				}
    				echo "</table>";
    				?>			
				</div>
			</div>
		</div>
	</div>

	
</div>
</body>