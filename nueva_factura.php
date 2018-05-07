

<?php
   session_start();
   if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
          header("location: login.php");
   	exit;
          }
   $active_facturas="active";
   $active_productos="";
   $active_clientes="";
   $active_tarjetas="";
   $active_usuarios="";	
   $active_reportes="";
   $active_caja_chica = "";
   $active_kardex="";
   $title="SGB | Registro de Breaks";
   
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
               <div class="btn-group pull-right">
                  <button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevaTarjeta">
                  <span class="glyphicon glyphicon-plus" ></span> Comprar Tarjeta
                  </button>
               </div>
               <h4><i class='glyphicon glyphicon-edit'></i> Nuevo Comsumo</h4>
            </div>
            <div class="panel-body">
               <?php 
                  include("modal/buscar_productos.php");
                  include("modal/registro_clientes.php");
                  include("modal/registro_productos.php");
                  include("modal/consulta_productos.php");
                  include("modal/registro_tarjeta.php");
                  ?>
               <form class="form-horizontal" role="form" id="datos_factura" method="get" action="./pdf/documentos/factura_pdf.php">
                  <div class="form-group row">
                     <label for="nombre_cliente" class="col-md-1 control-label">Cliente</label>
                     <div class="col-md-3">
                        <input type="text" class="form-control input-sm" id="nombre_cliente" placeholder="Nombre/Cédula Cliente" required>
                        <input id="id_cliente" type='hidden' name="id_cliente">	
                     </div>
                     <label for="documento_cli" class="col-md-1 control-label">Cédula</label>
                     <div class="col-md-2">
                        <input type="text" class="form-control input-sm" id="documento_cli" placeholder="Cédula" readonly>
                     </div>
                     <!-- <label for="tel1" class="col-md-1 control-label">Teléfono</label>
                        <div class="col-md-2"> -->
                     <input type="hidden" class="form-control input-sm" id="tel1" placeholder="Teléfono" readonly>
                     <!--			</div> -->
                     <label for="mail" class="col-md-1 control-label">Email</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control input-sm" id="mail" placeholder="Email" readonly>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="saldo_cliente" class="col-md-1 control-label">Saldo Tarjeta</label>
                     <div class="col-md-2">
                        <input type="text" class="form-control input-sm" id="saldo_cliente" placeholder="Saldo" readonly>
                     </div>
                     <label for="nombre_empresas" class="col-md-1 control-label">Tipo Cliente</label>
                     <div class="col-md-2">
                        <input readonly type="text" class="form-control input-sm" id="nombre_empresas" placeholder="Tipo Cliente" required>
                     </div>
                     <label for="id_vendedor" class="col-md-1 control-label">Vendedor</label>
                     <div class="col-md-2">
                        <select class="form-control input-sm" id="id_vendedor" name="id_vendedor" readonly>
                           <?php
                              $sql_vendedor=mysqli_query($con,"select * from users where user_id = ".$_SESSION['user_id']." order by lastname");
                              while ($rw=mysqli_fetch_array($sql_vendedor)){
                              	$id_vendedor=$rw["user_id"];
                              	$nombre_vendedor=$rw["firstname"]." ".$rw["lastname"];
                              	if ($id_vendedor==$_SESSION['user_id']){
                              		$selected="selected";
                              	} else {
                              		$selected="";
                              	}
                              	?>
                           <option value="<?php echo $id_vendedor?>" <?php echo $selected;?>><?php echo $nombre_vendedor?></option>
                           <?php
                              }
                              ?>
                        </select>
                     </div>
                     <label for="tel2" class="col-md-1 control-label">Fecha</label>
                     <div class="col-md-2">
                        <input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
                     </div>
                     
                  </div>
                  
                  <div class="form-group row">
                     <label for="descuento_cliente" class="col-md-1 control-label">Descuento(%)</label>
                     <div class="col-md-1">
                        <input type="text" class="form-control input-sm" id="descuento_cliente" placeholder="%" readonly>
                        <input type="hidden" id="gastos_producto" name="gastos_producto">
                     </div>
                     <label for="email" class="col-md-1 control-label">F. Pago</label>
                     <div class="col-md-3">
                        <select class='form-control input-sm' id="condiciones" name="condiciones">
                           <option value="1" selected>Efectivo</option>
                           <option value="2">Transferencia bancaria</option>
                           <option value="3">Tarjeta Prepago</option>
                        </select>
                     </div>
                   
                   </div>
                   <div class="form-group row">  
                     <label for="aplica_descuento" class="col-md-2 control-label">Aplica Descuento</label>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="aplica_descuento" id="descuento_si" onclick="actualiza_dsco(0)">
                        <label class="form-check-label" for="exampleRadios1">Si</label>
                        <input class="form-check-input" type="radio" name="aplica_descuento" id="descuento_no" value=0 checked onclick="actualiza_dsco(0)">
                        <label class="form-check-label" for="exampleRadios2">No</label>
                     </div>

                     <label for="aplica_tarjeta" class="col-md-2 control-label">Compra con Tajeta</label>
                     <div class="form-check">
                       <input class="form-check-input" type="radio" name="aplica_tarjeta" id="tarjeta_si" value = "si" >
                       <label class="form-check-label" for="exampleRadios1">Si</label>
                       <input class="form-check-input" type="radio" name="aplica_tarjeta" id="tajeta_no" value = "no" checked >
                       <label class="form-check-label" for="exampleRadios2">No</label>
                     </div>               
                     <label for="aplica_iva" class="col-md-2 control-label">Paga IVA</label>
                     <div class="form-check">
                       <input class="form-check-input" type="radio" name="aplica_iva" id="iva_si" value=0.12 onclick="actualiza_dsco(0)" >
                       <label class="form-check-label" for="exampleRadios1">Si</label>
                       <input class="form-check-input" type="radio" name="aplica_iva" id="iva_no" value=0 checked onclick="actualiza_dsco(0)" >
                       <label class="form-check-label" for="exampleRadios2">No</label> 
                     </div>
                  
            </div>
            <div class="col-md-12">
            <div class="pull-right">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#consultaProducto" id="getproductos">
            <span class="glyphicon glyphicon-search"></span> Consulta productos
            </button>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" id="addproducto">
            <span class="glyphicon glyphicon-plus"></span> Agregar productos
            </button>
            <button type="submit" class="btn btn-success" id="btn-comprar">
            <span class="glyphicon glyphicon-shopping-cart"></span> Comprar
            </button>
            <button type="button" class="btn btn-default" onclick="<?php $delete=mysqli_query($con, "DELETE FROM tmp WHERE session_id='".$session_id."'");?> javascript:window.location.reload();">
            <span class="glyphicon glyphicon-erase"></span> Limpiar Pantalla
            </button>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProducto" style="display: none;">
            <span class="glyphicon glyphicon-plus"></span> Nuevo producto
            </button>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoCliente" style="display: none;">
            <span class="glyphicon glyphicon-user"></span> Nuevo cliente
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
      <script type="text/javascript" src="js/VentanaCentrada.js"></script>
      <script type="text/javascript" src="js/nueva_factura.js"></script>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <script>
         $(function() {
         	$("#nombre_cliente").autocomplete({
         		source: "./ajax/autocomplete/clientes.php",
         		minLength: 2,
         		select: function(event, ui) {
                        event.preventDefault();
                        var saldo = ui.item.saldo_cliente * 1;
                        saldo = saldo.toFixed(2);
         			$('#id_cliente').val(ui.item.id_cliente);
         			$('#nombre_cliente').val(ui.item.nombre_cliente);
         			$('#tel1').val(ui.item.telefono_cliente);
         			$('#mail').val(ui.item.email_cliente);
         			$('#saldo_cliente').val(saldo);
                        $('#documento_cli').val(ui.item.documento_cliente);
                        $('#nombre_empresas').val(ui.item.nombre_empresas); 
                        $('#descuento_cliente').val(ui.item.descuento*100); 
                        $('#descuento_si').val(ui.item.descuento*100); 
         
         			localStorage.setItem('descuento', ui.item.descuento);
         		}
         });
         				 
         				
         			});
         			
         $("#nombre_cliente" ).on( "keydown", function( event ) {
         				if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
         				{
         					$("#id_cliente" ).val("");
         					$("#tel1" ).val("");
         					$("#mail" ).val("");
         					$("#saldo_cliente" ).val("");
         					$("#documento" ).val("");
         									
         				}
         				if (event.keyCode==$.ui.keyCode.DELETE){
         					$("#nombre_cliente" ).val("");
         					$("#id_cliente" ).val("");
         					$("#tel1" ).val("");
         					$("#mail" ).val("");
         					$("#saldo_cliente" ).val("");
         					$("#documento" ).val("");
         				}
         	});	
      </script>
      <script>
         localStorage.setItem("cantidad_productos", 0); 
         localStorage.setItem("total_factura", 0);
      </script>
   </body>
</html>

