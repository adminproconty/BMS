

<?php
   if (isset($con))
   {
   	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
   
   	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
   ?>
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar cliente</h4>
         </div>
         <div class="modal-body">
            <form class="form-horizontal" method="post" id="editar_cliente" name="editar_cliente">
               <div id="resultados_ajax2"></div>
               <div class="form-group">
                  <label for="mod_codigo" class="col-sm-3 control-label">Código</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="mod_codigo" name="mod_codigo" readonly>
                  </div>
               </div>
               <div class="form-group">
                  <label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="mod_nombre" name="mod_nombre"  required>
                     <input type="hidden" name="mod_id" id="mod_id">
                  </div>
               </div>
               <div class="form-group">
                  <label for="mod_documento" class="col-sm-3 control-label">Cédula</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="mod_documento" name="mod_documento">
                  </div>
               </div>
               <div class="form-group">
                  <label for="mod_telefono" class="col-sm-3 control-label">Teléfono</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="mod_telefono" name="mod_telefono">
                  </div>
               </div>
               <div class="form-group">
                  <label for="mod_email" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-8">
                     <input type="email" class="form-control" id="mod_email" name="mod_email">
                  </div>
               </div>
               <!--
                  <div class="form-group">
                  <label for="mod_direccion" class="col-sm-3 control-label">Dirección</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" id="mod_direccion" name="mod_direccion" ></textarea>
                  </div>
                   </div>
                   -->
               <div class="form-group">
                  <label for="mod_empresa" class="col-sm-3 control-label">Tipo Cliente</label>
                  <div class="col-sm-8">
										<select class="form-control" id="mod_empresa" name="mod_empresa" required>
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
                  <label for="mod_saldo" class="col-sm-3 control-label">Saldo</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="mod_saldo" name="mod_saldo" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" disabled>
                  </div>
               </div>
               <div class="form-group">
                  <label for="mod_descuento" class="col-sm-3 control-label">Descuento(%)</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="mod_descuento" name="mod_descuento" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
                  </div>
               </div>
               <div class="form-group">
                  <label for="mod_estado" class="col-sm-3 control-label">Estado</label>
                  <div class="col-sm-8">
                     <select class="form-control" id="mod_estado" name="mod_estado" required>
                        <option value="">-- Selecciona estado --</option>
                        <option value="1" selected>Activo</option>
                        <option value="0">Inactivo</option>
                     </select>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         <button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
         </div>
         </form>
      </div>
   </div>
</div>
<?php
   }
   ?>

