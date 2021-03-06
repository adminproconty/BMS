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
    $active_caja_chica = "";
	$active_kardex="active";
	$active_dashboard="";
	$title="Productos | SGB";
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
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Productos</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
			include("modal/producto_kadex.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Código o nombre</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Código o nombre del producto" onkeyup='load(1);'>
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
	<script type="text/javascript" src="js/kardex.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  </body>
</html>
<script>

	function obtener_datos(id){
			var id_producto = id;
			var nombre_producto = $("#nombre_producto"+id).val();
            var cantidad = $("#cantidad"+id).val();
            
            if(cantidad == 0){
                $('#btn-bajar').hide();
            }
			
			$("#mod_id_producto").val(id_producto);
			$("#mod_nombre_producto").val(nombre_producto);
            $("#mod_cantidad").val(cantidad);  
            
            $('#disminuir').hide();
            $('#aumentar').hide();
            $('#motivo').hide();
            
        }
</script>