	<?php
		if (isset($con))
		{
			require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos

			require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos


			$query_id = mysqli_query($con, "SELECT codigo_producto as codigo FROM products
																				ORDER BY codigo_producto DESC LIMIT 1")
																				or die('error '.mysqli_error($con));

			$count = mysqli_num_rows($query_id);

			if ($count <> 0) {
		
					$data_id = mysqli_fetch_assoc($query_id);
					$codigo    = $data_id['codigo'] + 1;
			} else {
					$codigo = 100000;
			}


			//$codigo_id   = str_pad($codigo, 6, "0", STR_PAD_LEFT);
			$codigo_id = $codigo;
	
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo producto</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
			<div id="resultados_ajax_productos"></div>
			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Código</label>
				<div class="col-sm-8">
				<input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $codigo_id; ?>" readonly required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required maxlength="255" ></textarea>
				</div>
			  </div>
			  <div class="form-group">
					<label for="categoria" class="col-sm-3 control-label">Categoría</label>
					<div class="col-sm-8">
							<select class="form-control" id="categoria" name="categoria" required>
								<option value="">-- Selecciona Tipo --</option>
								<?php
										$sql="select * from categorias";
										
										$query=mysqli_query($con,$sql);
										
										while($rw=mysqli_fetch_array($query)){
										echo '<option value="'.$rw[id_categorias].'">'.$rw[nombre_categoria].'</option>';
										}
										?>
							</select>
					</div>
				</div>
			  
				
				
			  <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Precio Estudiantes</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio de venta del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
			 
				<div class="form-group">
                  <label for="precio_flacso" class="col-sm-3 control-label">Precio Flacso</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="precio_flacso" name="precio_flacso" placeholder="Precio de venta del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
                  </div>
               </div>
							 <div class="form-group">
                  <label for="precio_publico" class="col-sm-3 control-label">Precio Externo</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="precio_publico" name="precio_publico" placeholder="Precio de venta del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
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