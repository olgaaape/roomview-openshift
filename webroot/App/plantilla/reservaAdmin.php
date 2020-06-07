<?php $auto = $_SERVER['PHP_SELF']; ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="author" content="Javier y Olga" />
		<title>RoomView</title>

		<!-- BOOTSTRAP CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
		<script src='webroot/Web/js/fullcalendar/jquery.min.js'></script>
		<script src='webroot/Web/js/fullcalendar/moment.min.js'></script>

		<!-- FULLCALENDAR CSS-->
		<link href='webroot/Web/css/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
		<script src='webroot/Web/js/fullcalendar/fullcalendar.min.js'></script>

		<!-- FULLCALENDAR JS PLUGINS-->
		<script src='webroot/Web/js/fullcalendar/es.js'></script>

		<!-- BOOTSTRAP JS -->
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


		<!-- CUSTOM CSS -->
		<link rel="stylesheet" href="webroot/Web/css/main.css">
		<link rel="shortcut icon" type="image/x-icon" href="webroot/Web/favicon/favicon.ico" />

		<!-- ENLACES RELOJ -->
		<link href="webroot/Web/css/clockpicker/clockpicker.css" rel="stylesheet" />
		<script src="webroot/Web/js/clockpicker/clockpicker.js"></script>

		<script>
			$(document).ready(function(){
				$('#calendar').fullCalendar({
					header:{
						left:'today,prev,next,Miboton',
						center:'title',
						right:'month,basicWeek,agendaWeek,agendaDay'
					},
				
					dayClick:function(date,jsEvent,view){
						$('#txtFecha').val(date.format());
						$("#ModalReserva").modal();
					},
					//Rellenar el formulario con los datos de la BD
					events:'webroot/App/dat/reserva.json',

					eventClick:function(calEvent,jsEvent,view){
						$('#tituloEvento').html(calEvent.title);

						//Mostrar info de inputs
						$('#txtDescripcion').val(calEvent.descripcion);
						$('#txtID').val(calEvent.id);
						$('#txtTitulo').val(calEvent.title);
						$('#txtColor').val(calEvent.color);
						$('#txtSala').val(calEvent.sala_no);
						$('#txtEmp').val(calEvent.emp_no);

						//Convierte el elemento en fecha y hora
						FechaHora= calEvent.start._i.split(" ");
						$('#txtFecha').val(FechaHora[0]);
						$('#txtHora').val(FechaHora[1]);
						$("#ModalReserva").modal();
					}
				});

				
			});

			
		</script>
	</head>
	<body>
		<!-- CABECERA -->
		
		<nav class="navbar" id="cabecera">
		<div class="container-fluid">
			<div class="col-auto mr-auto" >
				<img src="webroot/Web/img/logo.png" style="width: 15%" alt="logo bootstrap">
			</div>
			<div class="col-auto" >
				<a href="<?= $auto?>?orden=Cerrar"><img src="webroot/Web/img/logout.png"></a>
				<b>Usuario:</b> <?=  $_SESSION['user'];?>
				
			</div>
		</div>
		</nav>

		<!-- CONTENIDO-->
		
		<div id="contenido" class=" container-fluid pt-3">
			<input  class="btn btn-outline-light" type="button" value="Incidencias" id="verIncidencias" >
				<div class="row p-4">
					<div id="calendar" class="col-md-8 bg-white p-3 border border-secondary rounded offset-md-2"></div>
				</div>
				
			
			<!-- Modal para crear reserva -->
			<div class="modal fade" id="ModalReserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="tituloEvento">DATOS DE RESERVA</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <h2><?= (isset($msg))?$msg:"" ?></h2>
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form  method="post" action="index.php?orden=Modificar">
							<div class="modal-body">
                                <div class="form-row">
									<div class="form-group col-md-2">
										<label>Id: </label>
										<input class="form-control" type="text" id="txtID" name="txtID">
									</div>
									<div class="form-group col-md-3">
										<label>Empleado: </label>
										<input class="form-control" type="text" id="txtEmp" name="txtEmp" >
									</div>
									<div class="form-group col-md-3">
										<label>Fecha: </label>
										<input class="form-control" type="text" id="txtFecha" name="txtFecha" >
									</div>
									<div class="form-group col-md-4">
										<label>Hora: </label>
										<div class="input-group clockpicker" data-autoclose="true">
											<input class="form-control" type="text" id="txtHora" name="txtHora">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Titulo: </label>
									<input class="form-control" type="text" id="txtTitulo" name="txtTitulo">
								</div>
                                <div class="form-group">
									<label>Salas:</label>
									<select id="txtSala" name="txtSala" class="form-control">
										<?php foreach ($salas as $clave => $datosalas) : ?>
											<option value="<?= $clave?>">Sala <?= $clave?></option>
										<?php endforeach; ?>
									</select>
                                </div>
                                <div class="form-group">
									<label>Descripcion:</label>
									<textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="3"></textarea>
                                </div>
                                <div class="form-group">
									<label>Color:</label>
									<input class="form-control" style="height:30px;" type="color" id="txtColor" name="txtColor">
                                </div>
                                
                            </div>
							<!-- Pie del modal -->
							<div class="modal-footer">
								<input  type="submit" name="orden" value="Modificar" class="btn btn-success">
								<input type="submit" id="borrar" name="orden" value="Borrar" class="btn btn-danger" data-dismiss="modal">
								<button type="button" id="cancelar" class="btn btn-default">Cancelar</button>
							</div>
						</form>
					</div>
				</div>
			</div>


			<div class="modal fade" id="ModalVerIncidencias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="tituloEvento">DATOS DE RESERVA</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <h2><?= (isset($msg))?$msg:"" ?></h2>
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
							<form method="post" action="index.php?orden=BorrarIncidencias">
								<div class="modal-body">
									<table><th>Nº Inc.</th><th>Nº Res.</th><th>Usuario</th><th>Descripcion</th><th>Realizado</th>
									<?php foreach ($listIncidencias as $clave => $datosIncidencia): ?>
									<tr>
									<?php for($i=0; $i<count($datosIncidencia);$i++):?>
									<td><?= $datosIncidencia[$i] ?></td>
									<?php endfor;?>
									<td><input type="checkbox" name="incidencias[]" id="checkboxid" value="<?= $datosIncidencia[0]?>" ></input></td>
									</tr>
									<?php endforeach; ?>
									</table>
								</div>
								<!-- Pie del modal -->
								<div class="modal-footer">
								<button type="submit" class="btn btn-success">Aceptar</button>
								<button type="button" id="cancelarIncidencias" class="btn btn-default">Cancelar</button>
								</div>
							<form>
					</div>
				</div>
			</div>
		</div>
		
		<script>
			var NuevoEvento;

			
			$('#cancelar').click(function(){
			
				$("#ModalReserva").modal('toggle');
			});

			$('#cancelarIncidencias').click(function(){
				$("#ModalVerIncidencias").modal('toggle');
			});

			$('#verIncidencias').click(function(){
				$("#ModalVerIncidencias").modal();
			});

			$('#borrar').click(function(){
				var id = document.getElementById('txtID');
		
				 if(confirm("¿Quieres eliminar el evento:  "+id.value+ "?")){
					 document.location.href="?orden=Borrar&id="+id.value;
				 }
				 
			});

				
			$('.clockpicker').clockpicker();


			
		</script>
	</body>
</html>