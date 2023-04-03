<?php
  
	class Cliente_model {
		
		private $db;
		private $clientes;
		
		public function __construct(){
			$this->db = Conectar::conexion();
			$this->clientes = array();
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
		}*/

        public function insertar($Dui,$Nombres, $Apellidos,$Contrasenia, $Correo, $Telefono, $Direccion, $Token, $ID_Usuario)
        {  
           $resultado = $this->db->query("INSERT INTO `cliente` (`DUI`, `Nombres`, `Apellidos`, `Contrasenia`, `Correo`, `Telefono`, `Direccion`, `Token`, `ID_Usuario`) VALUES ('$Dui','$Nombres', '$Apellidos','$Contrasenia', '$Correo', '$Telefono', '$Direccion', '$Token', '$ID_Usuario' )");
           return $resultado;
         
        }
    

        public function modificar($email, $verification_code){
            $resultado = $this->db->query("UPDATE Cliente SET Fecha_Verificacion_Email = NOW() WHERE Correo = '$email' AND Token = '$verification_code' " );
            return $resultado;

        }

           public function registrodui($Dui ){
            $resultado = $this->db->query("SELECT * FROM Cliente WHERE DUI='$Dui'");
            $row = $resultado->fetch_array();
                  return  $row;
                
           }
       

        public function registrocorreo($Correo){
            $resultado = $this->db->query("SELECT * FROM Cliente WHERE  Correo='$Correo'");
            $row = $resultado->fetch_array();
                  return  $row;    
           }

               
           }
          






















 
        




    

?>