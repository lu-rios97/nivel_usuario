<?php include("vistas/cabecera.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>Multiusuarios PHP MySQL: Niveles de Usuarios</title>
		
<!-- <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../js/jquery-1.12.4-jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script> -->
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 20px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
    .fondo { 
        background-image: url("imagenes/01.png");
        background-size: -800px;
        background-repeat: no-repeat;   
        background-position: left bottom;   
        background-color: #FAF7F0;     
        
    }

    
</style>
</head>
	<body class="fondo">
<?php include("../header.php");?>
	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		 
			<center>
				<h1>Pagina Administrativa</h1>

                

				<h3>
				<?php
				session_start();

				if(!isset($_SESSION['admin_login']))	
				{
					header("location: ../index.php");  
				}

				if(isset($_SESSION['personal_login']))	
				{
					header("location: ../personal/personal_portada.php");	
				}

				if(isset($_SESSION['usuarios_login']))	
				{
					header("location: ../usuarios/usuarios_portada.php");
				}
				
				if(isset($_SESSION['admin_login']))
				{
				?>
					Bienvenido,
				<?php
						echo $_SESSION['admin_login'];
				}
				?>
				</h3>
					
			</center>

            <a><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></></a>
            <hr>
			
		</div>
		
		<?php
		include_once "../conexion.php";
		$sentencia = $bd -> query("select * from persona");
		$persona = $sentencia->fetchAll(PDO::FETCH_OBJ);
		//print_r($persona);
	?>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <!-- inicio alerta -->
                    <?php 
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Rellena todos los campos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php 
                        }
                    ?>


                    <?php 
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Registrado!</strong> Se agregaron los datos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php 
                        }
                    ?>   
                    
                    

                    <?php 
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Vuelve a intentar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php 
                        }
                    ?>   



                    <?php 
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Cambiado!</strong> Los datos fueron actualizados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php 
                        }
                    ?> 


                    <?php 
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Eliminado!</strong> Los datos fueron borrados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php 
                        }
                    ?> 

                    <!-- fin alerta -->
                    <div class="card">
                        <div class="card-header">
                            Listado
                        </div>
                        <div class="p-4">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">correo</th>
                                        <th scope="col">contraseña</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col" colspan="2">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                        foreach($persona as $dato){ 
                                    ?>

                                    <tr>
                                        <td scope="row"><?php echo $dato->codigo; ?></td>
                                        <td><?php echo $dato->usuario; ?></td>
                                        <td><?php echo $dato->correo; ?></td>
                                        <td><?php echo $dato->contraseña; ?></td>
                                        <td><?php echo $dato->rol; ?> </td>

                                        <td><a class="text-success" href="editar.php?codigo=<?php echo $dato->codigo; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                        <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?php echo $dato->codigo; ?>"><i class="bi bi-trash"></i></a></td>
                                    </tr>

                                    <?php 
                                        }
                                    ?>

                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Ingresar datos:
                        </div>
                        <form class="p-4" method="POST" action="registrar.php">
                            <div class="mb-3">
                                <label class="form-label">Usuario: </label>
                                <input type="text" class="form-control" name="usuario" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Correo: </label>
                                <input type="email" class="form-control" name="correo" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contraseña: </label>
                                <input type="password" class="form-control" name="contraseña" autofocus required>
                            </div>
                        <div class="form-group">
                            <label class="col-sm-6 text-left">Seleccionar rol</label>
                            <div class="col-sm-12">
                            <select class="form-control" name="rol">
                                <option value="" selected="selected"> - selecccionar rol - </option>
								<option value="Admin">Admin</option>
                                <option value="personal">Personal</option>
                                <option value="usuarios">Usuarios</option>
                            </select>
                            </div> 
                        </div>  
                        <br>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<center>
<a href="../cerrar_sesion.php"><button class="btn btn-danger text-left"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cerrar Sesion</button></a>
            <hr>
            </center>
		
	</div>
			
	</div>
										
	</body>
</html>


<?php include("vistas/pie.php"); ?>