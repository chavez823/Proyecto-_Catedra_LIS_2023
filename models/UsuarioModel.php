<?php

class Usuario_model {
		
    private $db;
    private $usuarios;
    private $clientes;
    
    public function __construct(){
        $this->db = Conectar::conexion();
        $this->usuarios = array();
    }

    public function insertar_usuario($ID_Usuario, $Nombres, $Apellidos, $Correo, $Contrasenia,  $Tipo){

        $resultado = $this->db->query ("INSERT INTO usuario (ID_Usuario, Nombres, Apellidos, Contrasenia, Correo, Tipo) 
        VALUES ('$ID_Usuario' , ' $Nombres' , '$Apellidos', '$Contrasenia', '$Correo', '$Tipo')");
          // return $resultado;



    }
   ///para el login nos devuelve el numero de filas que cumplan la consulta 
    public function sesion( $Correo, $Contrasenia){
      
        $resultado = $this->db->query("SELECT * FROM Usuario WHERE  Correo='$Correo' AND Contrasenia='$Contrasenia' ");
     $row = $resultado->fetch_array();
    
           return  $row;

     
 }



}

