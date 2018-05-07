<?php

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_tarjetas="active";
	$active_usuarios="";	
	$active_reportes="";
	$active_kardex="";
	$title="Tarjetas | SGB";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>
	
    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Tarjeta</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
				include("modal/editar_tarjeta.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Cliente</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Cédula o nombre del Cliente" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);' style="display: none;">
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			
		
	
			
			
			
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>	
    <script type="text/javascript" src="js/tarjetas.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
			$("#input_cliente").autocomplete({
				source: "./ajax/autocomplete/clientes.php?term="+$("#input_cliente").val(),
				minLength: 2,
				select: function(event, ui) {
					event.preventDefault();
					$('#id_cliente').val(ui.item.id_cliente);
					$('#nombre_cliente').val(ui.item.nombre_cliente);
					$('#tel1').val(ui.item.telefono_cliente);
					$('#mail').val(ui.item.email_cliente);
					$('#saldo_cliente').val(ui.item.saldo_cliente);
					$('#documento_cli').val(ui.item.documento_cliente);
				}
			});
		});
	</script>
  </body>
</html>
