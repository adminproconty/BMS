

<?php
   if (isset($con))
   {
		require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos

		require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos


		$query_id = mysqli_query($con, "SELECT codigo as codigo FROM clientes
																			ORDER BY codigo DESC LIMIT 1")
																			or die('error '.mysqli_error($con));

		$count = mysqli_num_rows($query_id);

		if ($count <> 0) {
	
				$data_id = mysqli_fetch_assoc($query_id);
				$codigo    = $data_id['codigo'] + 1;
		} else {
				$codigo = 1000;
		}


		//$codigo_id   = str_pad($codigo, 6, "0", STR_PAD_LEFT);
		$codigo_id = $codigo;
	

   ?>
<!-- Modal -->
<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo cliente</h4>
         </div>
         <div class="modal-body">
            <form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
               <div id="resultados_ajax"></div>
               <div class="form-group">
                  <label for="codigo" class="col-sm-3 control-label">Código</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $codigo_id; ?>" readonly required>
                  </div>
               </div>
               <div class="form-group">
                  <label for="nombre" class="col-sm-3 control-label">Nombre</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="nombre" name="nombre" required>
                  </div>
               </div>
               <div class="form-group">
                  <label for="documento" class="col-sm-3 control-label">Cédula</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="documento" name="documento" >
                  </div>
               </div>
               <div class="form-group">
                  <label for="telefono" class="col-sm-3 control-label">Teléfono</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="telefono" name="telefono" >
                  </div>
               </div>
               <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-8">
                     <input type="email" class="form-control" id="email" name="email" >
                  </div>
               </div>
               <!--
                  <div class="form-group">
                  <label for="direccion" class="col-sm-3 control-label">Dirección</label>
                  <div class="col-sm-8">
                  <textarea class="form-control" id="direccion" name="direccion"   maxlength="255" ></textarea>
                   
                  </div>
                  </div>
                  -->
               <div class="form-group">
                  <label for="empresa" class="col-sm-3 control-label">Tipo Cliente</label>
                  <div class="col-sm-8">
                     <select class="form-control" id="empresa" name="empresa" required>
                        <option value="">-- Selecciona Tipo --</option>
                        <?php
                           $sql="select * from empresas";
                           
                           $query=mysqli_query($con,$sql);
                           
                           while($rw=mysqli_fetch_array($query)){
                           echo '<option value="'.$rw[id_empresas].'">'.$rw[nombre_empresas].'</option>';
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="descuento" class="col-sm-3 control-label">Descuento</label>
                  <div class="col-sm-8">
                     <input type="number" min="0" step="0.1" class="form-control" id="descuento" name="descuento" >
                  </div>
               </div>
               <div class="form-group">
                  <label for="estado" class="col-sm-3 control-label">Estado</label>
                  <div class="col-sm-8">
                     <select class="form-control" id="estado" name="estado" required>
                        <option value="">-- Selecciona estado --</option>
                        <option value="1" selected>Activo</option>
                        <option value="0">Inactivo</option>
                     </select>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
         </div>
         </form>
      </div>
   </div>
</div>
<?php
   }
   ?>

