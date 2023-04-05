<?php
//require '../php/modelo/Model.php';
//include '../php/modelo/OfertaModel.php';
//include '../carrito.php';
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
    <!--Slider-->
    <link rel="stylesheet" href="css/style_2_s.css">
  </head>
  <body >
  <header>
    <!--Ingresando el nuevo menu-->
    <nav class="navbar navbar-expand-lg  fixed-top" style="background-color: #86A3B8;">
      <div class="container-fluid">
         <!--Logo-->
        <a class="navbar-brand" href="index.php?c=Inicio">
          <img class="logotipo" src="img/Logo_sin_slogan_t.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php?c=Inicio">Inicio</a>
            </li>
           <!-- <li class="nav-item">
              <a class="nav-link active" href="index.php?c=categoria">Categorias</a>
            </li>-->
            <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item active" href="index.php?c=categoria&a=belleza">Belleza</a></li>
            <li><a class="dropdown-item" href="index.php?c=categoria&a=salud">Salud</a></li>
            <li><a class="dropdown-item" href="index.php?c=categoria&a=restaurante">Restaurante</a></li>
            <li><a class="dropdown-item" href="index.php?c=categoria&a=otros">Otros</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="index.php?c=categoria">Principal</a></li>
          </ul>
        </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?c=Inicio&a=mostrarCarrito">Carrito(<?php
                        //condicionador ternario
                        echo (empty($_SESSION['CARRITO'])?0:array_sum(array_column($_SESSION['CARRITO'],"CANTIDAD")));
                    ?>)</a>
            </li>
            <li class="nav-item">
             
              <a href="index.php?c=usuario" class="nav-link">Login <i class="fa-solid fa-user"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>