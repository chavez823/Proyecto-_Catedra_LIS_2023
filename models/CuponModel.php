<?php

class Cupon_model {
		
    private $pdo;
    private $cupon;
   
    
    public function __construct(){
        $this->pdo = Conectar::conexion();
        //$this->cupon = array();
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

      //obtiene el dui del usuario
      public function  getDUI($id=''){
        $sentencia=$this->pdo->prepare("SELECT C.DUI FROM Cliente C 
        INNER JOIN Usuario U ON U.ID_Usuario = C.ID_Usuario WHERE C.ID_Usuario like '$id'");
        $sentencia->execute();
        $oferta=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $oferta;

    }
   //obtiene todos los cupones segun el dui del usuario
    public function  getCupones($DUI){
        $sentencia=$this->pdo->prepare("SELECT C.ID_Cupon, O.Titulo, O.Descripcion FROM cupon C 
        INNER JOIN Cliente Cl ON Cl.DUI=C.DUI INNER JOIN Oferta O ON O.ID_Oferta=C.ID_Oferta WHERE C.DUI like '$DUI' ORDER BY O.Titulo");
        $sentencia->execute();
        $oferta=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $oferta;

    }
   //para obtener el dato del cupon, ocupado ala hora de generar pdf  este metodo es llamado 
    public function getCupon($ID_CUPON){
        $sentencia=$this->pdo->prepare("SELECT C.ID_Cupon, O.Titulo, O.Descripcion FROM cupon C INNER JOIN Cliente Cl ON Cl.DUI=C.DUI INNER JOIN Oferta O ON O.ID_Oferta=C.ID_Oferta WHERE C.ID_Cupon like '$ID_CUPON'");
        $sentencia->execute();
        $oferta=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $oferta;
    }






  


}