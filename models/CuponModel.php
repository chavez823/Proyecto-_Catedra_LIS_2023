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
    public function  getNombreEmpresa($id=''){
        $sentencia=$this->pdo->prepare("SELECT E.ID_Empresa FROM oferta O 
        INNER JOIN Empresa E ON E.ID_Empresa = O.ID_Empresa WHERE ID_Oferta like '$id'");
        $sentencia->execute();
        $oferta=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $oferta;
    
    }

  


}