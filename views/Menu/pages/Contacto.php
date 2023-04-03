<?php
require '../php/modelo/Model.php';
include '../php/modelo/OfertaModel.php';
include '../carrito.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!--ICONO-->
    <link rel="shortcut icon" href="../img/icono.ico" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUYIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    <!--Propio-->
    <link rel="stylesheet" href="../css/style_3_C.css">

  </head>
  <body >
    
  <header>

    <!--Ingresando el nuevo menu-->
    <nav class="navbar navbar-expand-lg  fixed-top" style="background-color: #86A3B8;">
      <div class="container-fluid">
         <!--Logo-->
        <a class="navbar-brand" href="../buyit.php">
          <img class="logotipo" src="../img/Logo_sin_slogan_t.png" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="../buyit.php">Inicio</a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link" href="../pages/Categorias.php">Categorias</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../mostrarCarrito.php"">Carrito(<?php
                        //condicionador ternario
                        echo (empty($_SESSION['CARRITO'])?0:array_sum(array_column($_SESSION['CARRITO'],"CANTIDAD")));
                    ?>)</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Login <i class="fa-solid fa-user"></i></a>
            </li>
            
            
          </ul>
          
        </div>
      </div>
    </nav>
  </header>

   <!-- Main -->
   <main> 
    <section class="contacto altura-a-b">
        <div class="container">
            <div class="contact-box">
                <div class="left"></div>
                <div class="right">
                    <h2 class="Capital_letter_1">Contactenos</h2>
                    <input type="text" class="field" placeholder="Su nombre">
                    <input type="text" class="field" placeholder="Su correo">
                    <input type="text" class="field" placeholder="Telefono">
                    <textarea placeholder="Mensaje" class="field"></textarea>
                    <button class="btn">Enviar</button>
                </div>
            </div>
        </div>
    </section>

    </main>
  
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/5c72b9dab8.js" crossorigin="anonymous"></script>

    <!--SLIDER-->

  </body>

   <!--Pie de la pagina-->
   <?php
      include '../templates/footer.php'
   ?>
</html>