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
	$active_tarjetas="";
	$active_usuarios="";
	$active_reportes="active";
	$active_caja_chica = "";
	$active_kardex="";
	$active_dashboard="";	
	$title="Reportes | SGB";
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
			<!--
			<div class="btn-group pull-right">
				<button type='button' class="btn btn-info" id="exportar"
				data-toggle="tooltip" data-placement="top" title="Exportar excel">
					<span class="glyphicon glyphicon-cloud-download" ></span>
				</button>
			</div>
			-->
			<h4><i class='glyphicon glyphicon-paste'></i> Consulta de Reportes</h4>
		</div>
					
			<div class="panel-body">
			<?php
			/*include("modal/registro_usuarios.php");
			include("modal/editar_usuarios.php");
			include("modal/cambiar_password.php");*/
			?>
			<form class="form-horizontal" role="form" style="margin-bottom: 25px;">
				
				<div class="form-group row">
					<label for="q" class="col-md-2 control-label">Seleccione:</label>
					<div class="col-md-4">
                        <select class="form-control" id="select_reporte">
					        <option value="">-- Selecciona tipo de reporte --</option>
					        <option value="cierre">Cierre de Caja</option>
					        <option value="kardex">Movimientos Kardex</option>
							<option value="detalle_prod">Venta Productos</option>
							
					         <!-- <option value="ventas">Ventas Detalladas</option>  -->
				        </select>
					</div>
				</div>							
				<div class="for-group row">

					 <label for="tel2" class="col-md-2 control-label">Desde</label>
                     <div class="col-md-2">
                        <input type="date" class="form-control input-sm" id="fecha_ini">
                     </div>

					 <label for="tel2" class="col-md-1 control-label">Hasta</label>
                     <div class="col-md-2">
                        <input type="date" class="form-control input-sm" id="fecha_fin">
                     </div>

					<div class="col-md-2">
						<button type="button" class="btn btn-success" data-toggle="modal" onclick="reportes(1)">
						<span class="glyphicon glyphicon-search"></span> Obtener Reporte
						</button>
					<div>	

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
	<script type="text/javascript" src="js/reportes.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="./css/print.min.css">
    <script src="./js/print.min.js"></script>
  </body>
</html>