<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!--ICONO-->
    <link rel="shortcut icon" href="img/icono.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUYIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel='stylesheet' href='https://getuikit.com/assets/uikit/dist/css/uikit.css?nc=2479'>
    <!--Propio-->
    <link rel="stylesheet" href="../css/style_1.css">
    <!--Slider-->
    <link rel="stylesheet" href="../css/style_2_s.css">
  </head>
  <body >
  <header>
    <!--Ingresando el nuevo menu-->
    <nav class="navbar navbar-expand-lg  fixed-top" style="background-color: #86A3B8;">
      <div class="container-fluid">
         <!--Logo-->
        <a class="navbar-brand" href="../buyit.php">
          <img class="logotipo" src="img/Logo_sin_slogan_t.png" alt="" width="150px" heigth="150px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="buyit.php">Inicio</a>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link active" href="../pages/Categorias.php">Categorias</a>
            </li>-->
            <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item active" href="pages/Belleza.php">Belleza</a></li>
            <li><a class="dropdown-item" href="pages/salud.php">Salud</a></li>
            <li><a class="dropdown-item" href="pages/Restaurant.php">Restaurante</a></li>
            <li><a class="dropdown-item" href="pages/Super.php">Supermercado</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="pages/Categorias.php">Principal</a></li>
          </ul>
        </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Carrito(<?php
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
    <br>
    <h3>Lista del carrito</h3>
    <?php 
    //Comprueba si tiene algo el carrito
    if(!empty($_SESSION['CARRITO'])) {
    ?>
    <div class="data">
    <div class="uk-overflow-auto uk-box-shadow-small uk-margin-top bg-white rounded">
    <table class="uk-table uk-table-divider uk-table-hover">
        <tbody>
            <tr>
                <th width="40%">Descripcion</th>
                <th width="15%" class="text-center">Cantidad</th>
                <th width="20%" class="text-center">Precio</th>
                <th width="20%" class="text-center">Total</th>
                <th width="5%">--</th>
            </tr>
            <?php $total=0;?>
            <?php foreach ($_SESSION['CARRITO'] as $indice => $producto) { ?>
            <tr>
                <td width="40%" class="text-center"><?php echo $producto['NOMBRE']?></td>
                <td width="15%" class="text-center"><?php echo $producto['CANTIDAD']?></td>
                <td width="20%" class="text-center"><?php echo $producto['PRECIO']?></td>
                <td width="20%" class="text-center"><?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2);?></td>
                <td width="5%">
                    <form method="post" action="">
                    <input 
                    type="hidden" 
                    name="id" 
                    id="id" 
                    value="<?php echo $producto['ID'];?>">
                    <button 
                    class="btn btn-danger" 
                    type="submit"
                    name="btnAccion";
                    value="Eliminar"
                    >Eliminar</button>                      
                    </form>

                    <form method="post" action="">
                    <input type="hidden" name="id" id="id" value="<?php echo $producto['ID'];?>">
                    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1;?>">
                    <button 
                    class="btn btn-primary" 
                    type="submit"
                    name="btnAccion";
                    value="AgregarNuevo"
                    >+</button>                      
                    </form>

                    <form method="post" action="">
                    <input type="hidden" name="id" id="id" value="<?php echo $producto['ID'];?>">
                    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1;?>">
                    <button 
                    class="btn btn-primary" 
                    type="submit"
                    name="btnAccion";
                    value="QuitarElemento"
                    >-</button>                      
                    </form>
                </td>
                    
            </tr>
            <?php $total=$total+$producto['PRECIO']*$producto['CANTIDAD']; ?>
            <?php } ?>
            <tr>
                <td colspan="3" align="right"><h3>Total</h3></td>
                <td align="center"><h3><?php echo number_format($total,2)?></h3></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    </div>
    </div>
    <?php
    }else{
    ?>
        <div class="alert alert-success">
            No hay productos en el carrito...
        </div>
    <?php }?>
<?php
include 'templates/footer.php';
?>