<?php
  
	class Cliente_model {
		
		private $db;
		private $clientes;
		
		public function __construct(){
			$this->db = Conectar::conexion();
			//$this->clientes = array();
		}
        //consulta por siquisieramos ver todos los clientes 
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
         //para insertar un nuevo cliente 
        public function insertar($Dui,$Nombres, $Apellidos,$Contrasenia, $Correo, $Telefono, $Direccion, $Token, $ID_Usuario)
        {  
           $resultado = $this->db->query("INSERT INTO `cliente` (`DUI`, `Nombres`, `Apellidos`, `Contrasenia`, `Correo`, `Telefono`, `Direccion`, `Token`, `ID_Usuario`) VALUES ('$Dui','$Nombres', '$Apellidos','$Contrasenia', '$Correo', '$Telefono', '$Direccion', '$Token', '$ID_Usuario' )");
           return $resultado;
         
        }
            //Nos devuelve la cantidad de filas en la que cumpla la consulta donde el dui que ingresa el cliente para registrarse es igual al de la base de datos 
           public function registrodui($Dui ){
            $resultado = $this->db->query("SELECT * FROM Cliente WHERE DUI='$Dui'");
            $row = $resultado->fetch_array();
                  return  $row;
                
           }
       
     //Nos devuelve la cantidad de filas en la que cumpla la consulta donde el correo que ingresa el cliente para registrarse es igual al de la base de datos 

        public function registrocorreo($Correo){
            $resultado = $this->db->query("SELECT * FROM Cliente WHERE  Correo='$Correo'");
            $row = $resultado->fetch_array();
                  return  $row;    
           }

               
           }
          






















 
        




    

?>