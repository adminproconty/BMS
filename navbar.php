	<?php

		if (isset($title))

		{

	

			$user_id = $_SESSION['user_id'];

			$query_usuario=mysqli_query($con,"select * from users where user_id='".$user_id."'");

			$row2=mysqli_fetch_array($query_usuario);		



	?>

<nav class="navbar navbar-default ">

  <div class="container-fluid">

    <!-- Brand and toggle get grouped for better mobile display -->

    <div class="navbar-header">

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

        <span class="sr-only">Toggle navigation</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

      </button>

      <a class="navbar-brand" href="#">::: SGB :::</a>

    </div>



    <!-- Collect the nav links, forms, and other content for toggling -->

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">

        

		<?php

		   if ($row2['perfil'] == "Administrador") {

		?>	   
			<li class="<?php echo $active_dashboard;?>"><a href="dashboard.php"><i class='glyphicon glyphicon-dashboard'></i> Inicio<span class="sr-only"></span></a></li>

			<li class="<?php if(isset($active_perfil)){echo $active_perfil;}echo $active_usuarios;?> dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i  class='glyphicon glyphicon-cog'></i> 
                Administración 
                <span class="sr-only">(current)</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="perfil.php">Configuración</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <!-- <li><a href="#">Empleados</a></li> -->
            </ul>
        	</li>

			<li class="<?php echo $active_facturas; echo $active_tarjetas; echo $active_clientes;?> dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class='glyphicon glyphicon-list-alt'></i>
                Ingresos 
                <span class="sr-only">(current)</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="facturas.php">Facturación</a></li>
                <li><a href="clientes.php">Clientes</a></li>
                <li><a href="tarjetas.php">Tarjetas</a></li>
                <!-- <li><a href="#">Cuentas x Cobrar</a></li> -->
            </ul>
        	</li>

			<li class="<?php echo $active_caja_chica;?> dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i  class='glyphicon glyphicon-shopping-cart'></i>
                Egresos 
                <span class="sr-only">(current)</span>
            </a>
            <ul class="dropdown-menu">
                <!-- <li><a href="#">Compras</a></li> -->
                <li><a href="caja_chica.php">Caja Chica</a></li>
                <li><a href="proveedores.php">Proveedores</a></li>
                <!-- <li><a href="#">Cuenta x pagar</a></li> -->
            </ul>
        	</li>

			<li class="<?php echo $active_productos; echo $active_kardex;?> dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class='glyphicon glyphicon-barcode'></i>
                Bodega 
                <span class="sr-only">(current)</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="productos.php">Productos</a></li>
                <li><a href="kardex.php">Movimientos Kardex</a></li>
            </ul>
        	</li>

			<li class="<?php echo $active_reportes;?>"><a href="reportes.php"><i  class='glyphicon glyphicon-paste'></i> Reportes</a></li>

			<!-- <li class="<?php echo $active_facturas;?>"><a href="facturas.php"><i class='glyphicon glyphicon-list-alt'></i> Consumos</a></li> -->

			<!-- <li class="<?php echo $active_productos;?>"><a href="productos.php"><i class='glyphicon glyphicon-barcode'></i> Productos</a></li> -->

			<!-- <li class="<?php echo $active_clientes;?>"><a href="clientes.php"><i class='glyphicon glyphicon-user'></i> Clientes</a></li> -->

			<!-- <li class="<?php echo $active_tarjetas;?>"><a href="tarjetas.php"><i class='glyphicon glyphicon-credit-card'></i> Tarjetas</a></li> -->

			<!-- <li class="<?php echo $active_usuarios;?>"><a href="usuarios.php"><i  class='glyphicon glyphicon-lock'></i> Usuarios</a></li> -->

			<!-- <li class="<?php echo $active_caja_chica;?>"><a href="caja_chica.php"><i  class='glyphicon glyphicon-shopping-cart'></i> Caja Chica</a></li> -->

			<!-- <li class="<?php echo $active_kardex;?>"><a href="kardex.php"><i  class='glyphicon glyphicon-list-alt'></i> Kardex</a></li> -->

			
			<!-- <li class="<?php if(isset($active_perfil)){echo $active_perfil;}?>"><a href="perfil.php"><i  class='glyphicon glyphicon-cog'></i> Configuración</a></li> -->

		<?php

		   } elseif ($row2['perfil'] == "Ventas") {

		?>

		

			<li class="<?php echo $active_facturas;?>"><a href="facturas.php"><i class='glyphicon glyphicon-list-alt'></i> Consumos <span class="sr-only">(current)</span></a></li>

			<li class="<?php echo $active_caja_chica;?>"><a href="caja_chica.php"><i  class='glyphicon glyphicon-shopping-cart'></i> Caja Chica</a></li>

			<li class="<?php echo $active_reportes;?>"><a href="reportes.php"><i  class='glyphicon glyphicon-paste'></i> Reportes</a></li>

		<?php

		   } 

		?>	

       </ul>

      <ul class="nav navbar-nav navbar-right">

        <li><a href="http://www.proconty.com" target='_blank'><i class='glyphicon glyphicon-envelope'></i> Soporte</a></li>

		<li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>

      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>

	<?php

		}

	?>