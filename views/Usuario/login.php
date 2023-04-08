<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style_login.css">
    <!--link rel="stylesheet" href="css/style_error.css"-->
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600&family=Poiret+One&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--nose de que son link-->

	  <!--ICONO-->
	  <link rel="shortcut icon" href="img/icono.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUYIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!--Propio-->
    <link rel="stylesheet" href="css/style_1.css">
    <link rel="stylesheet" href="css/categories.css">

</head>
<body>

  
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
					<input class="input100" type="text" name="email" placeholder="Correo" >	 
					<span class="focus-efecto"></span> 
				</div> 
				<!-- CONTRASEÑA --> 
				<div class="wrap-input100"> 
					<input class="input100" type="password" name="password" placeholder="Contraseña"> 
					<span class="focus-efecto"></span> 
				</div>
                <h6>¿No tienes una cuenta?</h6>
                <h6>Regístrate<a href="index.php?c=cliente" class="">   aquí</a>
	            </h6>			
<br>
<h6>¿Olvidaste tu contraseña?</h6>
                <h6>Recuperala<a href="index.php?c=usuario&a=recuperacion" class="">   aquí</a>
	            </h6>
                <button class="sesion">
                    Ingresar
                </button>
			</form> 
		</div> 
	</div> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
	<script>
		$(document).ready(function(){
			$(".info .close").click(function(){
				$(this).closest(".info").remove();
			})
		})
	</script>

<?php
    include 'templates/footer.php'
  ?>


    
</body>
</html>
