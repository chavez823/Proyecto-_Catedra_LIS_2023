<?php

class Cupon_model {
		
    private $pdo;
    private $cupon;
   
    
    public function __construct(){
        $this->pdo = Conectar::conexion();
        $this->cupon = array();
    }


    public function insertar_cupon($ID_Cupon, $DUI,$ID_Oferta, $ID_Estado_Cupon){

        $sentencia = $this->pdo->prepare ("INSERT INTO cupon (ID_Cupon, DUI, ID_Oferta, ID_Estado_Cupon) 
        VALUES ('$ID_Cupon', '$DUI', '$ID_Oferta', '$ID_Estado_Cupon')");
          	$sentencia->execute();
              $row=$sentencia->fetchAll(PDO::FETCH_ASSOC);
              return  $row;
    }

  


}