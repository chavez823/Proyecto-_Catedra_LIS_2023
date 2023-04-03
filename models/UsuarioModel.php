<?php

class Usuario_model {
		
    private $db;
    private $usuarios;
    private $clientes;
    
    public function __construct(){
        $this->db = Conectar::conexion();
        $this->usuarios = array();
    }

   /* public function get_Clientes()
    {
        $sql = "SELECT * FROM cliente";
        $resultado = $this->db->query($sql);
        while($row = $resultado->fetch_assoc())
        {
            $this->clientes[] = $row;
        }
        return $this->clientes;
    }


    public function get_Usuarios()
    {
        $sql = "SELECT * FROM usuario";
        $resultado = $this->db->query($sql);
        while($row = $resultado->fetch_assoc())
        {
            $this->usuarios[] = $row;
        }
        return $this->usuarios;
    }*/

    public function insertar_usuario($ID_Usuario, $Nombres, $Apellidos, $Correo, $Contrasenia,  $Tipo){

        $resultado = $this->db->query ("INSERT INTO usuario (ID_Usuario, Nombres, Apellidos, Contrasenia, Correo, Tipo) 
        VALUES ('$ID_Usuario' , ' $Nombres' , '$Apellidos', '$Contrasenia', '$Correo', '$Tipo')");
           return $resultado;



    }

    public function sesion( $Correo, $Contrasenia){
      
        $resultado = $this->db->query("SELECT * FROM Cliente WHERE  Correo='$Correo' AND Contrasenia='$Contrasenia' ");
     $row = $resultado->fetch_array();
    
           return  $row;

     
 }


 public function sesionempleado( $Correo, $Contrasenia){
      
    $resultado = $this->db->query("SELECT * FROM Usuario WHERE  Correo='$Correo' AND Contrasenia='$Contrasenia' ");
 $row = $resultado->fetch_array();

       return  $row;

 
}

}