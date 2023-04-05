<?php
  include 'templates/header.php'
?>
    <!-- Main -->
    <!--Funcional con php-->

   <main> 
    <?php
    //$model=new OfertaModel();
    //$listaCupones=$model->get_oferta(5);   
    ?>
      
      <div class="profile-area">
            <p class="Parrafo">LO MEJOR PARA TUS COMPRAS</p>
            <div class="container">
              <div class="row">
    <?php

    foreach($ot as $cupones){?>
        
         
                <div class="col-md-4">
                  <div class="card">
                    <div class="img1"><img src="<?php echo $cupones['Imagen'] ?>" alt=""></div><!--Fondo CARD-->
                    <div class="img2"><img src="img/ramen_3.jpg" alt=""></div>                  
                    <div class="main-text">
                      <h1><?php echo $cupones['Titulo'] ?></h1>
                      <p>$<?php echo $cupones['PrecioOferta'] ?></p>
                      <form action="" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo  $cupones['ID_Oferta'];?>">
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo $cupones['Titulo'];?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $cupones['PrecioOferta'];?>">
                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1;?>">
                        <button class="btn btn-primary" 
                                type="submit" 
                                name="btnAccion" 
                                value="Agregar"
                                >Agregar al carrito
                        </button>
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
    
      
    
    
    
  </main>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!--SLIDER-->
    <script src="https://kit.fontawesome.com/5c72b9dab8.js" crossorigin="anonymous"></script>
    <script src="./js/slider.js"></script>


    <!--Pie de la pagina-->
    <?php
      include 'templates/footer.php'
    ?>
  </body>

  <!--Pie de la pagina-->
 


</html>