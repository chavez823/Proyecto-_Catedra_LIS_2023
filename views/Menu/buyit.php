<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="utf-8">
    <!--ICONO-->
    <link rel="shortcut icon" href="img/icono.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUYIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!--Propio-->
    <link rel="stylesheet" href="css/style_1.css">
    <!--Slider-->
    <link rel="stylesheet" href="css/style_2_s.css">
  </head>
  <body>
  <header class="bo_dy">
    <!--Ingresando el nuevo menu-->
    <nav class="navbar navbar-expand-lg  fixed-top" style="background-color: #86A3B8;">
      <div class="container-fluid">
         <!--Logo-->
        <a class="navbar-brand" href="#">
          <img class="logotipo" src="img/Logo_sin_slogan_t.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php?c=categoria">Categorias</a>
            </li>
           <!-- <li class="nav-item">
              <a class="nav-link" href="index.php?c=usuario">prueba login</a>
            </li>-->
            <li class="nav-item">
              <a class="nav-link" href="index.php?c=Inicio&a=mostrarCarrito"><i class="fa-solid fa-cart-shopping"></i> (<?php echo (empty($_SESSION['CARRITO'])?0:array_sum(array_column($_SESSION['CARRITO'],"CANTIDAD")));?>)</a>
			  <!--Nota jacky le borre () y lo demas lo comente  -->
            </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo  isset($_SESSION['session'])?$_SESSION['session']['nombre']:"Login" ?> <i class="fa-solid fa-user"></a></i>
          <ul class="dropdown-menu">
            <?php if(!isset($_SESSION['session']))  { ?>
            <li> <a class="dropdown-item " href="index.php?c=usuario"> Login</a></li>
            <li><hr class="dropdown-divider"></li>

            <?php  } else { ?>
            
            <li><a class="dropdown-item " href="index.php?c=cupon&a=ver_cupon">Historial de cupones</a></li>
            <li><hr class="dropdown-divider"></li>
            <li> <a class="dropdown-item " href="index.php?c=usuario&a=cambio">Cambiar Contraseña</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="index.php?c=usuario&a=logout">Cerrar Sesión</a></li>
            <?php } ?>
          </ul>
          </ul>
        </div>
      </div>
    </nav>
	 <!--luego puede ir el resto de la pagina -->
    <!--Slider-->
    
    <div class="wrapper altura-a-b">
        
        <i id="left" class="fa-solid fa-angle-left"></i>
        <div class="carousel">
            <img src="img/slider/IMAGEN-1.jpg" alt="">
            <img src="img/slider/IMAGEN-2.jpg" alt="">
            <img src="img/slider/IMAGEN-3.jpg" alt="">
            <img src="img/slider/IMAGEN-4.jpg" alt="">
            <img src="img/slider/IMAGEN-5.jpg" alt="">
            <img src="img/slider/IMAGEN-6.jpg" alt="">
            <img src="img/slider/IMAGEN-7.jpg" alt="">
            <img src="img/slider/IMAGEN-8.jpg" alt="">
            <img src="img/slider/IMAGEN-9.jpg" alt="">                 
        </div>
        <i id="right" class="fa-solid fa-angle-right"></i>
    </div>
    <!--End Slider-->
    </header>
    <Main>
    <!--BUIYT - CARDS -->
    <div class="profile-area">
            <p class="Parrafo">NUESTRAS MEJORES OFERTAS</p>
            <div class="container">
              <div class="row">
    <?php

               foreach($data["Ofertas"]  as $cupones){?>
        
          
                <div class="col-md-4">
                  <div class="card">
                    <div class="img1"><img src="<?php echo $cupones['Imagen'] ?>" alt=""></div><!--Fondo CARD-->
                                      
                    <div class="main-text">
                      <h1><?php echo $cupones['Titulo'] ?></h1>
                      <p>$<?php echo $cupones['PrecioOferta'] ?></p>
                      <a href="index.php?c=Inicio&a=carrito&id=<?=$cupones['ID_Oferta']?>" class="btn btn-primary">Agregar al carrito</a>
                      </form>
                                    
                    </div>    
                  </div>
                </div>
    <?php
    }
    ?>
    <!-- Ofrecemos -->
        <div class="altura-a-b"></div>
        </div>
      </div>
    </div>
    </Main>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!--SLIDER-->
    <script src="https://kit.fontawesome.com/5c72b9dab8.js" crossorigin="anonymous"></script>
    <script src="js/slider.js"></script>


  <footer>
        <img class="logotipo-footer" src="img/Logo_sin_slogan_t.png" alt="logotipo">
        <br>    
        <p>
        © Copyright  2023 BUYIT <br>
          Pagina Creada por<br>
          <i class="nav-link fa-brands fa-facebook "></i>
        <i class="nav-link fa-brands fa-instagram"></i>
        <i class="nav-link fa-brands fa-twitter"></i>
          
        </p>
</footer>
  </body>

  <!--Pie de la pagina-->
 


</html>