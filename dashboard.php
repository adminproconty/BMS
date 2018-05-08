<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_tarjetas="";
	$active_usuarios="";	
	$active_reportes="";
	$active_caja_chica = "";
	$active_kardex="";
	$active_dashboard="active";
	$title="Consumos | SGB";

	include('ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	$session_id= session_id();
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$delete=mysqli_query($con, "DELETE FROM tmp WHERE session_id='".$session_id."'");

	
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
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h4>
							<strong id="consumo-dia">$0.00</strong>
						</h4>
						<strong>Consumos</strong>
					</div>
					<a href="facturas.php" class="small-box-footer">
						Consumos
						<i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="small-box bg-green">
					<div class="inner">
						<h4>
							<strong id="caja-chica-dia">$0.00</strong>
						</h4>
						<strong>Caja Chica</strong>
					</div>
					<a href="caja_chica.php" class="small-box-footer">
						Caja Chica
						<i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h4>
							<strong id ="topFive">00</strong>
						</h4>
						<strong>Top 5</strong>
					</div>
					<a href="productos.php" class="small-box-footer">
						Top 5
						<i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="small-box bg-red">
					<div class="inner">
						<h4>
							<strong id="topTen">00</strong>
						</h4>
						<strong>Top 10</strong>
					</div>
					<a href="productos.php" class="small-box-footer">
						Top 10
						<i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		</div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Consumos
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
							<canvas id="chart-area" width="100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Caja Chica
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
							<canvas id="chart-line" width="100%"></canvas>							
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            TOP 5 Productos / Día
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
							<canvas id="chart-pie" width="100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            TOP 10 Productos / Mes
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
						<canvas id="myChartBar" width="100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/dashboard.js"></script>
	<script type="text/javascript" src="js/Chart.min.js"></script>
	<link rel="stylesheet" href="./css/dashboard.css">
	<link rel="stylesheet" href="./font-awesome/css/font-awesome.css">
  </body>
</html>