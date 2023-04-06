<?php
  
	class Cliente_model {
		
		private $pdo;
		private $clientes;
		
		public function __construct(){
			$this->pdo = Conectar::conexion();
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
           $sentencia = $this->pdo->prepare("INSERT INTO `cliente` (`DUI`, `Nombres`, `Apellidos`, `Contrasenia`, `Correo`, `Telefono`, `Direccion`, `Token`, `ID_Usuario`) VALUES ('$Dui','$Nombres', '$Apellidos','$Contrasenia', '$Correo', '$Telefono', '$Direccion', '$Token', '$ID_Usuario' )");
           $sentencia->execute();
           $row=$sentencia->fetchAll(PDO::FETCH_ASSOC);
           return  $row;
   
         
        }
    
           //este llano en vez de el ocupamos las variables de session
        /*public function modificar($email, $verification_code){
            $resultado = $this->db->query("UPDATE Cliente SET Fecha_Verificacion_Email = NOW() WHERE Correo = '$email' AND Token = '$verification_code' " );
            return $resultado;
        }*/

           public function registrodui($Dui){
            $sentencia=$this->pdo->prepare("SELECT * FROM Cliente WHERE DUI='$Dui'");
           /* $sentencia->execute();
            $row=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            $num=array_sum($row);
            return  $num;*/
           $sentencia->execute();
		$row=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        return  $row;
                
           }
       

        public function registrocorreo($Correo){

            $sentencia=$this->pdo->prepare("SELECT * FROM Cliente WHERE  Correo='$Correo'");
           /* $sentencia->execute();
            $row=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            $num=array_sum($row);
            return  $num; */
            $sentencia->execute();
		$row=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        return  $row;
            
            





           }

               
           }  






















 
        




    

?>