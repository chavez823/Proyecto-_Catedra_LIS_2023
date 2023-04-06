<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Compras - BuyIt</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!--Luego Cambiar por direccion absoluta-->
    <link rel="stylesheet" href="http://localhost/Proyecto-_Catedra_LIS_2023/css/estilo_compra.css">

</head>
<body>

<div class="container">
  
  <div class="row">
    <div class="col-sm-12">
      <h3 style="text-align: center; font-weight: bold;">Cupones Adquiridos</h3>      
    </div>
  </div>
  
  <?php
  //Pruebas
  $cont=4;

  for($i=0;$i<$cont;$i++){
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
                    <h5>Lorem ipsum dolor sit amet consectetur </h5>
                </div>
                <div class="col-sm-2">
                    <em>Codigo</em>
                    <h5>04/26/2017</h5>
                </div>
            
            </div>
        </div>     
    </div>
<?php
  }
?>
    

</div><!-- end of container -->

<!-- partial -->

</body>
</html>
