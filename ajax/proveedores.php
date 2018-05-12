<?php


	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

	/* Connect To Database*/

	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos

    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    
    $numrow = COUNT($_POST['data']);

    $data = $_POST['data'];

    include 'pagination.php'; //include pagination file

    $page = $_POST['page'];

    //pagination variables

    $per_page = 10; //how much records you want to show

    $adjacents  = 4; //gap between pages after number of adjacents

    $offset = ($page - 1) * $per_page;

    $total_pages = ceil($numrow/$per_page);

    $reload = './proveedores.php';

    if ($numrow > 0) {

    ?>
 
        <div class="table-responsive">
 
            <table class="table">
 
                <tr  class="info">
 
                    <th>R.U.C.</th>
 
                    <th>Nombre</th>
 
                    <th>Dirección</th>
 
                    <th>Correo</th>
 
                    <th>Convencional</th>
 
                    <th>Contacto</th>
 
                    <th>Estado</th>

                    <th class='text-right'>Acciones</th>
 
                </tr>
 
                <?php
 
                for ($i = 0; $i < COUNT($_POST['data']); $i++){

                        $id_proveedor = $data[$i]['id_proveedor'];
                        $ruc = $data[$i]['ruc'];
                        $nombre = $data[$i]['nombre'];
                        $direccion = $data[$i]['direccion'];
                        $correo = $data[$i]['correo'];
                        $celular = $data[$i]['celular'];
                        $convencional = $data[$i]['convencional'];
                        $opcional = $data[$i]['opcional'];
                        $dias_credito = $data[$i]['dias_credito'];
                        $web = $data[$i]['web'];
                        $contacto = $data[$i]['contacto'];
                        $nota_pedido = $data[$i]['nota_pedido'] * 1;
                        $parte_relacionada = $data[$i]['parte_relacionada'] * 1;
                        $automatico_datil = $data[$i]['automatico_datil'] * 1;
                        $activo = $data[$i]['activo'] * 1;

                        if ($nota_pedido == 1) {
                            $nota_pedido = "si";
                        } else {
                            $nota_pedido = "no";
                        }

                        if($parte_relacionada == 1) {
                            $parte_relacionada = "si";
                        } else {
                            $parte_relacionada = "no";
                        }

                        if ($automatico_datil == 1) {
                            $automatico_datil = "si";
                        } else {
                            $automatico_datil = "no";
                        }
 
                        if ($activo==1){$estado="Activo";$label_class='label-success';}
 
                        else {$estado="Inactivo";$label_class='label-danger';}
 
                        
 
                    ?>
 
                    
 
                    <input type="hidden" value="<?php echo $id_proveedor;?>" id="id_proveedor<?php echo $id_proveedor;?>">
 
                    <input type="hidden" value="<?php echo $ruc;?>" id="ruc<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $direccion;?>" id="direccion<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $correo;?>" id="correo<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $celular;?>" id="celular<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $convencional;?>" id="convencional<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $opcional;?>" id="opcional<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $dias_credito;?>" id="dias_credito<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $web;?>" id="web<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $contacto;?>" id="contacto<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $nota_pedido;?>" id="nota_pedido<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $parte_relacionada;?>" id="parte_relacionada<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $automatico_datil;?>" id="automatico_datil<?php echo $id_proveedor;?>">

                    <input type="hidden" value="<?php echo $activo;?>" id="activo<?php echo $id_proveedor;?>">
 
                    <tr>
 
                        
 
                        <td><?php echo $ruc; ?></td>
 
                        <td><?php echo $nombre; ?></td>
 
                        <td><?php echo $direccion;?></td>
 
                        <td><?php echo $correo;?></td>

                        <td><?php echo $convencional;?></td>

                        <td><?php echo $contacto;?></td>

                        <td><span class="label <?php echo $label_class;?>"><?php echo $estado; ?></span></td>
 
                        <td>
                            <span class="pull-right">
 
                                <a href="#" class='btn btn-default' title='Editar proveedor' onclick="obtener_datos('<?php echo $id_proveedor;?>');" data-toggle="modal" data-target="#editProveedor"><i class="glyphicon glyphicon-edit"></i></a> 
 
                                <!-- <a href="#" class='btn btn-default' title='Borrar cliente' onclick="eliminar('<?php echo $id_cliente; ?>')"><i class="glyphicon glyphicon-trash"></i> </a> -->
                            </span>
                        </td>
 
                        
 
                    </tr>
 
                    <?php
 
                }
 
                ?>
 
                <tr>
 
                    <td colspan=8><span class="pull-right">
 
                    <?php
 
                     echo paginate($reload, $page, $total_pages, $adjacents);
 
                    ?></span></td>
 
                </tr>
 
              </table>
 
            </div>
 
            <?php


    } else {
        echo "";
    }
	

?>