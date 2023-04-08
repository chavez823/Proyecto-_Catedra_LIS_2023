
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <!--ICONO-->
    <link rel="shortcut icon" href="img/icono.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compras BUYIT</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!--Luego Cambiar por direccion absoluta-->
    <link rel="stylesheet" href="http://localhost/Proyecto-_Catedra_LIS_2023/css/estilo_compra.css">
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
              <a class="nav-link" href="./pages/Contacto.php">Contacto</a>
            </li>-->
            <li class="nav-item">
              <a class="nav-link" href="index.php?c=Inicio&a=mostrarCarrito"><i class="fa-solid fa-cart-shopping"></i> (<?php echo (empty($_SESSION['CARRITO'])?0:array_sum(array_column($_SESSION['CARRITO'],"CANTIDAD")));?>)</a>
			  <!--Nota jacky le borre () y lo demas lo comente  -->
            </li>
            <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="index.php?c=usuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo  isset($_SESSION['session'])?$_SESSION['session']['nombre']:"Login" ?> <i class="fa-solid fa-user"></i></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item active" href="index.php?c=cupon&a=ver_cupon">Historial de cupones</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="index.php?c=categoria">Cerrar Sesión</a></li>
          </ul>
          </ul>
        </div>
      </div>
    </nav>







<div class="container">
  
  <div class="row">
    <div class="col-sm-12">
      <h3 style="text-align: center; font-weight: bold;">Cupones Adquiridos</h3>      
    </div>
  </div>
  
  <?php
  //Pruebas
  foreach ($cupones as $cupon) {
  ?>
  <!-- Todo lo de abajo se tendra que repetir en el foreach para leer los datos de la base-->
  
    
    <div class="row event_container">
      
      <div class="col-sm-2 event event_online" id="show-list-link1" title="Show registered guests">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ticket" width="52" height="52" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <line x1="15" y1="5" x2="15" y2="7" />
        <line x1="15" y1="11" x2="15" y2="13" />
        <line x1="15" y1="17" x2="15" y2="19" />
        <path d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
        </svg>        
      </div>

        <div class="col-sm-10 event-details">
            <div class="row">
                <div class="col-sm-5">
                    <em>Nombre - Cupon</em>
                    <h5><?=$cupon['Titulo']?> </h5>
                    <em><?=$cupon['Descripcion']?> </em>
                </div>
                <div class="col-sm-2">
                    <em>Codigo</em>
                    <h5><?=$cupon['ID_Cupon']?></h5>
                </div>
                <a href="index.php?c=Cupon&a=generarCupon&id=<?=$cupon['ID_Cupon']?>">Generar PDF</a>
            
            </div>
        </div>     
    </div>
<?php
  }
?>
    

</div><!-- end of container -->

<!-- partial -->
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
</html>
