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
	$active_reportes="";
	$active_kardex="";
	$active_caja_chica = "active";
	$active_dashboard="";
	$title="Caja Chica | SGB";
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
		    <div class="btn-group pull-right">
				<a href="nueva_compra.php" class="btn btn-info">
					<span class="glyphicon glyphicon-plus" ></span> 
					Nueva Compra
				</a>
			</div>
			<h4><i class='glyphicon glyphicon-shopping-cart'></i> Compras de Caja Chica</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
				include("modal/editar_clientes.php");
			?>
			<form class="form-horizontal" role="form" style="margin-bottom: 25px;">
				
				<div class="form-group row">					
							
					<div class="col-md-3">
						<button type="button" class="btn btn-default" onclick='load(1);' style="display: none;">
							<span class="glyphicon glyphicon-search" ></span> Buscar</button>
							<span id="loader"></span>
						</div>
					</div>

                <div class="for-group row">
                    <div class="col-md-6 pull-right">
                        <label for="q" class="control-label">Desde:</label>
                        <input type="date" id="desde">
                        <input type="hidden" id="inicio">

						<label for="q" class="control-label">Hasta:</label> 
                        <input type="date" id="hasta">
                        <input type="hidden" id="fin">

						<button type='button' class="btn btn-info" id="btn_consultar">
							<span class="glyphicon glyphicon-search" ></span>
						</button>
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
	<script type="text/javascript" src="js/caja_chica.js"></script>
  </body>
</html>
