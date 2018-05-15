

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
   $active_caja_chica = "active";
   $active_kardex="";
   $active_dashboard="";
   $title="SGB | Registro de Proveedor";
   
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
               <h4><i class='glyphicon glyphicon-edit'></i> Nuevo Proveedor</h4>
            </div>
            <div class="panel-body">
               <form class="form-horizontal" role="form" id="nuevo_proveedor">
                  <div class="form-group row">
                     <label for="nombre_pro" class="col-md-3 control-label">Nombre y Apellido o Razón Social </label>
                     <div class="col-md-3">
                        <input type="text" class="form-control input-sm" id="nombre_pro" placeholder="Nombre y Apellido o Razón Social " required>
                     </div>
                     <label for="ruc_pro" class="col-md-1 control-label">RUC</label>
                     <div class="col-md-2">
                        <input type="number" class="form-control input-sm" id="ruc_pro" placeholder="RUC" required>
                     </div>
                     <label for="mail_pro" class="col-md-1 control-label">Email</label>
                     <div class="col-md-2">
                        <input type="email" class="form-control input-sm" id="mail_pro" placeholder="Email">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="direccion_pro" class="col-md-1 control-label">Dirección</label>
                     <div class="col-md-3">
                        <input type="text" class="form-control input-sm" id="direccion_pro" placeholder="Dirección">
                     </div>
                     <label for="celular_pro" class="col-md-2 control-label">Número Celular</label>
                    <div class="col-md-2">
                        <input type="number" class="form-control input-sm" id="celular_pro" placeholder="Celular">
                     </div>
                     <label for="convencional_pro" class="col-md-2 control-label">Número Convencional</label>
                    <div class="col-md-2">
                        <input type="number" class="form-control input-sm" id="convencional_pro" placeholder="Convencional" required>
                     </div>
                </div>

                <div class="form-group row">
                     <label for="opcional_pro" class="col-md-2 control-label">Número Opcional</label>
                     <div class="col-md-2">
                        <input type="number" class="form-control input-sm" id="opcional_pro" placeholder="Opcional">
                     </div>
                     <label for="credito_pro" class="col-md-2 control-label">Días de Crédito</label>
                    <div class="col-md-2">
                        <input type="number" class="form-control input-sm" id="credito_pro" placeholder="">
                     </div>
                     <label for="web_pro" class="col-md-2 control-label">Página Web</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control input-sm" id="web_pro" placeholder="www.proconty.com">
                     </div>                     
                </div>
                   
                <div class="form-group row">  
                    <label for="contaco_pro" class="col-md-2 control-label">Persona de Contacto</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control input-sm" id="contacto_pro" placeholder="" required>
                     </div>
                     <div class="col-md-7">
                     <label for="nota_pedido" class="col-md-3 control-label">Nota Pedido</label>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="nota_pedido" id="nota_si" value = "si" >
                        <label class="form-check-label" for="exampleRadios1">Si</label>
                        <input class="form-check-input" type="radio" name="nota_pedido" id="nota_no" value = "no" checked>
                        <label class="form-check-label" for="exampleRadios2">No</label>
                     </div>

                     <label for="parte_relacionada" class="col-md-3 control-label">Parte Relacionada</label>
                     <div class="form-check">
                       <input class="form-check-input" type="radio" name="parte_relacionada" id="parte_si" value = "si" >
                       <label class="form-check-label" for="exampleRadios1">Si</label>
                       <input class="form-check-input" type="radio" name="parte_relacionada" id="parte_no" value = "no" checked >
                       <label class="form-check-label" for="exampleRadios2">No</label>
                     </div>               
                     <label for="automatico" class="col-md-3 control-label">332 Automático (Dátil)</label>
                     <div class="form-check">
                       <input class="form-check-input" type="radio" name="automatico" id="automatico_si" value= "si" >
                       <label class="form-check-label" for="exampleRadios1">Si</label>
                       <input class="form-check-input" type="radio" name="automatico" id="automatico_no" value= "no" checked>
                       <label class="form-check-label" for="exampleRadios2">No</label> 
                     </div>
                  </div>
            </div>
            <div class="col-md-12">
            <div class="pull-right">
            <button type="submit" class="btn btn-success" id="btn-guardar">
            <span class="glyphicon glyphicon-ok"></span> Guardar
            </button>
            <button type="button" class="btn btn-default" onclick="javascript:window.location.reload();">
            <span class="glyphicon glyphicon-erase"></span> Limpiar Pantalla
            </button>            
            </div>
            </div>
            </form>
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
      
        <link rel="stylesheet" href="./css/nuevo_proveedor.css">
        <script type="text/javascript" src="js/nuevo_proveedor.js"></script>
   </body>
</html>

