<?php
   session_start();
   date_default_timezone_set('America/Bogota');
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
   $active_caja_chica = "active";
   $active_kardex="";
   $title="SGB | Registro de Compra";
   
   /* Connect To Database*/
   require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
   require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
   
   $session_id= session_id();	
   
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
               <h4><i class='glyphicon glyphicon-shopping-cart'></i> Nueva Compra</h4>
            </div>
            <div class="panel-body">
            <?php 
                include("modal/agregar_producto.php");
            ?>
               <form class="form-horizontal" role="form" id="datos_factura" method="get" action="./ajax/registrar_caja_chica.php">
                  <div class="form-group row">					 
					 <label for="id_usuario" class="col-md-1 control-label">Usuario</label>
                     <div class="col-md-2">
                        <select class="form-control input-sm" id="id_usuario" name="id_usuario" readonly>
                           <?php
                              $sql_vendedor=mysqli_query($con,"select * from users where user_id = ".$_SESSION['user_id']." order by lastname");
                              while ($rw=mysqli_fetch_array($sql_vendedor)){
                              	$id_usuario=$rw["user_id"];
                              	$nombre_vendedor=$rw["firstname"]." ".$rw["lastname"];
                              	if ($id_usuario==$_SESSION['user_id']){
                              		$selected="selected";
                              	} else {
                              		$selected="";
                              	}
                              	?>
                           <option value="<?php echo $id_usuario?>" <?php echo $selected;?>><?php echo $nombre_vendedor?></option>
                           <?php
                              }
                              ?>
                        </select>
                     </div>
                     <label for="tel2" class="col-md-1 control-label">Fecha</label>
                     <div class="col-md-2">
                        <input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
                        <input type="hidden" id="total" name="total">
                     </div>
                     <!--
                        <label for="email" class="col-md-1 control-label">Pago</label>
                        -->
                     <div class="col-md-3">
                        <select class='form-control input-sm' id="condiciones" name="condiciones"  style="visibility:hidden">
                           <option value="1">Efectivo</option>
                           <option value="2">Cheque</option>
                           <option value="3">Transferencia bancaria</option>
                           <option value="4">Crédito</option>
                        </select>
                     </div>
                  </div>	 
                  <div class="col-md-12">
                     <div class="pull-right">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modAddProducto" id="addproducto">
                        <span class="glyphicon glyphicon-plus"></span> Agregar ítem
                        </button>
                        <button type="submit" class="btn btn-success" id="btn-comprar">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Comprar
                        </button>
                        <button type="button" class="btn btn-default" onclick="<?php $delete=mysqli_query($con, "DELETE FROM `tmp_caja_chica` WHERE `sesion__tempcc` = '".$session_id."'");?> javascript:window.location.reload();">
                        <span class="glyphicon glyphicon-erase"></span> Limpiar Pantalla
                        </button>
                     </div>
                  </div>
               </form>
               <div id="resultados" class='col-md-12' style="margin-top:10px"></div>
               <!-- Carga los datos ajax -->			
            </div>
         </div>
         <div class="row-fluid">
            <div class="col-md-12">
            </div>
         </div>
      </div>
      <hr>
      <?php
         include("footer.php");
         ?>
      <script type="text/javascript" src="js/nueva_compra.js"></script>
   </body>
</html>

