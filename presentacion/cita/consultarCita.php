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
					<?php  if($rol == "admin") {echo "<form method='POST' action='?pid=" . base64_encode("presentacion/cita/consultarCita.php") . "'>"; } ?>
						<table class='table table-striped table-hover'>
						<tr><td>Id</td><td>Fecha</td><td>Hora</td>
						<?php if($rol != "paciente"){ echo "<td>Paciente</td>"; } ?>
						<?php if($rol != "medico"){ echo "<td>Medico</td>"; } ?>
						<td>Consultorio</td><td>Estado</td></tr>

						<?php
						foreach($citas as $cit): ?>
						<tr>
							<td><?= $cit->getId(); ?></td>
							<td><?= $cit->getFecha(); ?></td>
							<td><?= $cit->getHora(); ?></td>
							<?php if($rol != "paciente"): ?>
								<td><?= $cit->getPaciente()->getNombre() . " " . $cit->getPaciente()->getApellido(); ?></td>
								<?php endif; ?>
								<?php if($rol != "medico"): ?>
									<td><?= $cit->getMedico()->getNombre() . " " . $cit->getMedico()->getApellido(); ?></td>
									<?php endif; ?>
									<td><?= $cit->getConsultorio()->getNombre(); ?></td>
									<?php if($rol == "admin"): ?>
									<td>
										<select class='form-select' name="estado[<?= $cit->getId(); ?>]">
									<option value="<?= $cit->getEstadoCita()->getId(); ?>" selected><?= $cit->getEstadoCita()->getValor(); ?></option>
									<?php foreach($cit->getEstadoCita()->consultarRestantes() as $ecr): ?>
										<?php if($ecr->getId() != $cit->getEstadoCita()->getId()): ?>
											<option value="<?= $ecr->getId(); ?>"><?= $ecr->getValor(); ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</td>
							<?php else: ?>
								<td><?= $cit->getEstadoCita()->getValor(); ?></td>
							<?php endif; ?>
						</tr>
						<?php endforeach; ?>
						</table>
						<?php if($rol == "admin"): ?>
						<p class="text-end">
							<button type="submit" name="guardar" class="btn btn-primary">Guardar Cambios</button>
						</p>
						</form>
						<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	
</div>
</body>