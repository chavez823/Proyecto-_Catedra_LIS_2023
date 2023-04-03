<?php
/*require '../php/modelo/Model.php';
include '../php/modelo/OfertaModel.php';
include '../carrito.php';*/
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!--ICONO-->
    <link rel="shortcut icon" href="img/icono.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUYIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!--Propio-->
    <link rel="stylesheet" href="css/style_1.css">
    <link rel="stylesheet" href="css/categories.css">
  </head>
  <body >
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
            <li class="nav-item">
              <a class="nav-link" href="../pages/Contacto.php">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../mostrarCarrito.php">Carrito(<?php
                        //condicionador ternario
                        echo (empty($_SESSION['CARRITO'])?0:array_sum(array_column($_SESSION['CARRITO'],"CANTIDAD")));
                    ?>)</a>
            </li>
            <li class="nav-item">
              <a href="index.php?c=usuario" class="nav-link">Login <i class="fa-solid fa-user"></i></a>
            </li>
            <li class="nav-item">  
            </li>
          </ul> 
        </div>
      </div>
    </nav>
  </header>
  
    <!-- Main -->
    <main> 

      <div class="container altura-a-b">
        <div class="fila">

          <div class="column">
            <!--<h1 class="title">PRUEBA</h1>-->
            <img src="img/Logo_sin_slogan_t.png" alt="" srcset="">
            <p class="tex_t">Los cupones mostrados a continuacion esta sujetos a restricciones.</p>
            <!--<button class="btn_" type="button">Explore</button>-->
            
          </div>

          <div class="column c2">            
            <div class="flip-card c2">
                <div class="flip-card-inner">
                    <div class="flip-card-front card1">
                       <!-- <p class="title">FLIP CARD</p>
                        <p>Hover Me</p>-->
                        <img src="img/Cat/belleza.png" alt="" class="img1">
                    </div>
                    <div class="flip-card-back">                                            
                          <div class="waviy title">
                            <a href="../pages/Belleza.php" class="a_w">
                              <span style="--i:1" class="belle">B</span>
                              <span style="--i:2" class="belle">E</span>
                              <span style="--i:3" class="belle">L</span>
                              <span style="--i:4" class="belle">L</span>
                              <span style="--i:5" class="belle">E</span>
                              <span style="--i:6" class="belle">Z</span>
                              <span style="--i:7" class="belle">A</span>
                            </a>
                          </div>  
                                            
                    </div>
                </div>
            </div>

            <div class="flip-card c2">
                <div class="flip-card-inner">
                    <div class="flip-card-front card2">
                        <!-- <p class="title">FLIP CARD</p>
                        <p>Hover Me</p>-->
                        <img src="img/Cat/salud_1.png" alt="" class="img2">
                        
                    </div>
                    <div class="flip-card-back">
                        
                        <div class="waviy title ">                          
                          <a href="../pages/salud.php" class="a_w">
                            <span style="--i:1" class="salu_d">S</span>
                            <span style="--i:2" class="salu_d">A</span>
                            <span style="--i:3" class="salu_d">L</span>
                            <span style="--i:4" class="salu_d">U</span>
                            <span style="--i:5" class="salu_d">D</span>
                          </a>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="flip-card c2">
                <div class="flip-card-inner ">
                    <div class="flip-card-front card3">
                        <!-- <p class="title">FLIP CARD</p>
                        <p>Hover Me</p>-->
                        <img src="img/Cat/restaurante.png" alt="" class="img3">
                    </div>
                    <div class="flip-card-back">                        
                        <div class="waviy title ">
                          <a href="../pages/Restaurant.php" class="a_w">
                            <span style="--i:1">R</span>
                            <span style="--i:2">E</span>
                            <span style="--i:3">S</span>
                            <span style="--i:4">T</span>
                            <span style="--i:5">A</span>
                            <span style="--i:6">U</span>
                            <span style="--i:7">R</span>
                            <span style="--i:8">A</span>
                            <span style="--i:9">N</span>
                            <span style="--i:10">T</span>
                            <span style="--i:11">E</span>
                          </a>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="flip-card c2">
                <div class="flip-card-inner">
                    <div class="flip-card-front card4">
                        <!-- <p class="title">FLIP CARD</p>-->
                        <img src="img/Cat/super.png" alt="" class="img4">
                    </div>
                    <div class="flip-card-back">                        
                        <div class="waviy title">
                          <a href="../pages/Super.php" class="a_w">
                            <span style="--i:1" class="super">S</span>
                            <span style="--i:2" class="super">U</span>
                            <span style="--i:3" class="super">P</span>
                            <span style="--i:4" class="super">E</span>
                            <span style="--i:5" class="super">R</span>  
                          </a>                        
                        </div>                        
                    </div>
                </div>
            </div>

          </div>
        </div>
      </div>
            
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!--SLIDER-->
    <script src="https://kit.fontawesome.com/5c72b9dab8.js" crossorigin="anonymous"></script>
    <script src="js/slider.js"></script>


  <!--Pie de la pagina-->
  <?php
    include 'templates/footer.php'
  ?>
  </body>
</html>