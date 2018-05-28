<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="editProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar proveedor</h4>
		  </div>
		  <div class="modal-body">
		    <form class="form-horizontal" id="editar_proveedor" name="editar_proveedor">
			<div id="resultados_ajax2"></div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Nombre y Apellido o Razón Social</label>
				<div class="col-sm-8">
                <input type="text" class="form-control input-sm" id="nombre_pro" placeholder="Nombre y Apellido o Razón Social " required>
                <input type="hidden" id="id_proveedor">
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">R.U.C.</label>
				<div class="col-sm-8">
                <input type="number" class="form-control input-sm" id="ruc_pro" placeholder="RUC" required>
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
                <input type="email" class="form-control input-sm" id="mail_pro" placeholder="Email">
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Dirección</label>
				<div class="col-sm-8">
                <input type="text" class="form-control input-sm" id="direccion_pro" placeholder="Dirección">
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Número Celular</label>
				<div class="col-sm-8">
                <input type="number" class="form-control input-sm" id="celular_pro" placeholder="Celular">
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Número Convencional</label>
				<div class="col-sm-8">
                <input type="number" class="form-control input-sm" id="convencional_pro" placeholder="Convencional" required>
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Número Opcional</label>
				<div class="col-sm-8">
                <input type="number" class="form-control input-sm" id="opcional_pro" placeholder="Opcional">
				</div>
			</div>

             <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Días de Crédito</label>
				<div class="col-sm-8">
                <input type="number" class="form-control input-sm" id="credito_pro" placeholder="">
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Web</label>
				<div class="col-sm-8">
                <input type="text" class="form-control input-sm" id="web_pro" placeholder="www.proconty.com">
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Persona de Contacto</label>
				<div class="col-sm-8">
                <input type="text" class="form-control input-sm" id="contacto_pro" placeholder="" required>
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Nota Pedido</label>
				<div class="col-sm-8">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nota_pedido" id="nota_si" value = "si" >
                    <label class="form-check-label" for="exampleRadios1">Si</label>
                    <input class="form-check-input" type="radio" name="nota_pedido" id="nota_no" value = "no">
                    <label class="form-check-label" for="exampleRadios2">No</label>
                </div>
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Parte Relacionada</label>
				<div class="col-sm-8">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="parte_relacionada" id="parte_si" value = "si" >
                    <label class="form-check-label" for="exampleRadios1">Si</label>
                    <input class="form-check-input" type="radio" name="parte_relacionada" id="parte_no" value = "no">
                    <label class="form-check-label" for="exampleRadios2">No</label>
                </div>  
				</div>
			</div>

            <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">332 Automático (Dátil)</label>
				<div class="col-sm-8">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="automatico" id="automatico_si" value= "si" >
                    <label class="form-check-label" for="exampleRadios1">Si</label>
                    <input class="form-check-input" type="radio" name="automatico" id="automatico_no" value= "no">
                    <label class="form-check-label" for="exampleRadios2">No</label> 
                </div>
				</div>
			</div>
			  
			<div class="form-group">
				<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-8">
				<select class="form-control" id="mod_estado" name="estado_pro" required>
					<option value="1" selected>Activo</option>
					<option value="0">Inactivo</option>
				  </select>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_proveedor">Actualizar proveedor</button>
		</div>
	</form>
</div>
</div>
</div>

<?php
	}
?>