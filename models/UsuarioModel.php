<?php

class Usuario_model {
		
    private $pdo;
    private $usuarios;
    private $clientes;
    
    public function __construct(){
        $this->pdo = Conectar::conexion();
        $this->usuarios = array();
    }


    public function registrocorreo($Correo){
        $sentencia=$this->pdo->prepare("SELECT * FROM Usuario WHERE  Correo='$Correo'");
		$sentencia->execute();
		$row=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        return  $row;


    }

      public function modificar_contraseña($Correo,$Contrasenia){

      
        $sentencia = $this->pdo->prepare ("  UPDATE usuario SET Contrasenia = '$Contrasenia' WHERE Correo= $Correo");
          	$sentencia->execute();
              $row=$sentencia->fetchAll(PDO::FETCH_ASSOC);
              return  $row;

      }

    public function insertar_usuario($ID_Usuario, $Nombres, $Apellidos, $Correo, $Contrasenia,  $Tipo){

        $sentencia = $this->pdo->prepare ("INSERT INTO usuario (ID_Usuario, Nombres, Apellidos, Contrasenia, Correo, Tipo) 
        VALUES ('$ID_Usuario' , ' $Nombres' , '$Apellidos', '$Contrasenia', '$Correo', '$Tipo')");
          	$sentencia->execute();
              $row=$sentencia->fetchAll(PDO::FETCH_ASSOC);
              return  $row;
       



    }

    public function sesion( $Correo, $Contrasenia){
      
        $sentencia=$this->pdo->prepare("SELECT * FROM Usuario WHERE  Correo='$Correo' AND Contrasenia='$Contrasenia'");
		$sentencia->execute();
		$row=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        return  $row;

     
 }

//esta llano
 /*public function sesionempleado( $Correo, $Contrasenia){
      
    $resultado = $this->db->query("SELECT * FROM Usuario WHERE  Correo='$Correo' AND Contrasenia='$Contrasenia' ");
 $row = $resultado->fetch_array();
       return  $row;
 
}*/

}