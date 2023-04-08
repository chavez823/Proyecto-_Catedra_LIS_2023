<?php
define("Aqui","<a href='index.php?c=cliente' > aquí</a>");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600&family=Poiret+One&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	  <!--ICONO-->
	  <link rel="shortcut icon" href="img/icono.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUYIT</title>
    
    <!--Propio-->
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="stylesheet" href="css/style_1.css">
    <link rel="stylesheet" href="css/categories.css">
    <link rel="stylesheet" href="css/two_c.css">

</head>
<body>
<header>
    <!--Ingresando el nuevo menu-->
    <nav class="navbar navbar-expand-lg  fixed-top" style="background-color: #86A3B8;">
      <div class="container-fluid">
         <!--Logo-->
        <a class="navbar-brand" href="index.php?c=inicio">
          <img class="logotipo" src="img/Logo_sin_slogan_t.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

          <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php?c=inicio">Inicio</a>
            </li>
          
          </ul> 
        </div>
      </div>
    </nav>
  </header>

  
    <div class="container-login"> 
		<div class="wrap-login"> 
			<form action="index.php?c=Inicio&a=sesion" method="post"> 
      <?php
                        if(isset($errores)){
                            if(count($errores)>0){
                                echo "<div class='alert alert-danger'><ul>";
                                foreach ($errores as $error) {
                                    echo "<li>$error</li>";
                                }
                                echo "</ul></div>";

                            }
                        }

                            
                    ?>

				<!-- LOGO --> 
				<span class="login-form-title">Iniciar Sesión</span> 
				<!--<img class="avatar"src="img/user.svg" alt="" align="center"> -->
                <img class="avatar"src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png" alt="" align="center">
					<!-- USUARIO --> 
				<div class="wrap-input100"> 
					<input class="input100" type="text" name="email" placeholder="Correo"  value="<?php if(isset($Correo)) echo  $Correo ?>">	 
					<span class="focus-efecto"></span> 
				</div> 
				<!-- CONTRASEÑA --> 
				<div class="wrap-input100"> 
					<input class="input100" type="password" name="password" placeholder="Contraseña" value="<?php if(isset($Contrasenia)) echo  $Contrasenia ?>"> 
					<span class="focus-efecto"></span> 
				</div>
        <!---Haciendo Pruebas de popover
                <h6>¿No tienes una cuenta?</h6>
                <h6>Regístrate<a href="index.php?c=cliente" class="">   aquí</a></h6>			
                <br>

                <h6>¿Olvidaste tu contraseña?</h6>
                <h6>Recuperala<a href="index.php?c=usuario&a=recuperacion" class="">   aquí</a></h6>-->

                <section class="dos-columnas">
                    <div class="columna-izquierda">
                      <h6 class="first">¿No tienes una cuenta?</h6>
                      <h6 class="second">Regístrate<a href="index.php?c=cliente" class="">   aquí</a></h6>	
                    </div>
                    <div class="columna-derecha">
                      <h6 class="first">¿Olvidaste tu contraseña?</h6>
                      <h6 class="second">Recuperala<a href="index.php?c=usuario&a=recuperacion" class="">   aquí</a></h6>
                    </div>
                </section>



                <button class="sesion">
                    Ingresar
                </button>
			</form> 
		</div> 
	</div> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	  <!--Prueba-->
    



   
	
  <script>
    $(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
    });
  </script>

<?php
    include 'templates/footer.php'
  ?>


    
</body>
</html>
