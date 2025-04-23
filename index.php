<?php 
require ("logica/Especialidad.php");
require "logica/Medico.php";
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Matasanos EPS</title>

<!-- Bootstrap -->
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
	rel="stylesheet">

<!-- FontAwesome -->
<link href="https://use.fontawesome.com/releases/v6.7.2/css/all.css"
	rel="stylesheet">
</head>

<body class="bg-light">

	<div class="container py-4">
		<div class="row align-items-center">
			<div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
				<img src="img/logo.png" alt="Logo Matasanos" class="img-fluid"
					style="width: 150px; height: auto;">
			</div>
			<div class="col-md-8 text-center text-md-start">
				<h1 class="text-primary">Matasanos EPS</h1>
				<p class="text-muted">Cuidamos tu salud y cuidamos de ti</p>
			</div>
		</div>
	</div>

	<nav class="bg-primary text-white py-2">
		<div
			class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
			<div class="fw-bold fs-5 mb-2 mb-md-0">Matasanos EPS</div>
			<div
				class="d-flex flex-column flex-md-row gap-3 text-center text-md-start">
				<a href="#" class="text-white text-decoration-none">Agendar citas</a>
				<a href="#" class="text-white text-decoration-none">Mas información</a>
				<a href="#" class="text-white text-decoration-none"><i
					class="fas fa-user me-1"></i>Autenticar</a>
			</div>
		</div>
	</nav>


	<div class="container my-5">
		<div class="text-center mb-5">
			<h2 class="text-primary fw-bold">Nuestros Servicios</h2>
			<p class="text-dark opacity-75">Ofrecemos atencion medica integral y
				especializada</p>
		</div>

		<div class="row row-cols-1 row-cols-md-3 g-4">

			<div class="col">
				<div class="card h-100 text-center">
					<div class="card-body">
						<h5 class="card-title">
							<i class="fas fa-check-circle text-success me-2"></i> Asignar
							cita
						</h5>
						<p class="card-text">Programa una nueva cita medica con nuestros
							profesionales de la salud.</p>
						<a href="#" class="btn btn-primary">Agendar</a>
					</div>
				</div>
			</div>


			<div class="col">
				<div class="card h-100 text-center">
					<div class="card-body">
						<h5 class="card-title">
							<i class="fas fa-clock text-warning me-2"></i> Reagendar cita
						</h5>
						<p class="card-text">No puedes asistir? Cambia la fecha y hora de
							tu cita facilmente.</p>
						<a href="#" class="btn btn-primary">Reagendar</a>
					</div>
				</div>
			</div>


			<div class="col">
				<div class="card h-100 text-center">
					<div class="card-body">
						<h5 class="card-title">
							<i class="fas fa-times-circle text-danger me-2"></i> Cancelar
							cita
						</h5>
						<p class="card-text">Cancela tu cita medica con antelacion si no
							puedes asistir.</p>
						<a href="#" class="btn btn-primary">Cancelar</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="col">
				<div class="card">
					<div class="card-header"><h4>Especialidades</h4></div>
					<div class="card-body">
        				<?php 
        				$especialidad = new Especialidad();
						$medico = new Medico();
        				$especialidades = $especialidad -> consultar();
        				echo "<ul>
						";
        				foreach($especialidades as $esp){
        				    echo "<li>" . $esp -> getNombre() ."
							";
							if($esp -> tieneMedicos() == true){
								echo "<ul>";
								$medico -> setEsp($esp);
								$medicos = $medico -> consultarPorEspecialidad();
								foreach($medicos as $m){
									echo "<li>". $m -> getNombre() ." " . $m -> getApellido() ." </li>";	
								}
								echo "</ul>";
							}
							echo "
								</li>
								";
        				}
        				echo "
						</ul>";
        				?>			
    				</div>
				</div>
			</div>
		</div>
	</div>



</body>
</html>

