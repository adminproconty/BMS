<?php



	include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

	/* Connect To Database*/

	require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos

	require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos

	if (isset($_GET['id'])){
        $inventario = array();
		$query=mysqli_query($con, "SELECT inv.`cantidad_inventario`, prod.`nombre_producto`
                FROM `inventario` as inv 
                JOIN `products` as prod ON (inv.`producto_inventario` = prod.`id_producto`)");
        while($row=mysqli_fetch_array($query)){
            $inventario_item = array(
                "cantidad" => $row['cantidad_inventario'],
                "producto" => $row['nombre_producto']
            );
            array_push($inventario, $inventario_item);
        }
        echo json_encode($inventario);

	}

?>