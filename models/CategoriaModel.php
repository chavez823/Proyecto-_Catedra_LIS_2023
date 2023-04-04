<?php
	
	class Categoria_model {
		
		private $pdo;
		private $inicio;
		private $ofertas;
		
		public function __construct(){
			$this->pdo = Conectar::conexion();
			$this->ofertas = array();
			
		}
		

		/*public function get_inicio()
		{
			$sql = " SELECT * FROM `oferta` LIMIT 3";
			$resultado = $this->db->query($sql);
			while($row = $resultado->fetch_assoc())
			{
				$this->ofertas[] = $row;
			}
			return $this->ofertas;


			$sentencia=$this->pdo->prepare("SELECT * FROM `oferta` LIMIT 3");
			$sentencia->execute();
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);


			//$sql = "SELECT * FROM `oferta` LIMIT 3";
			//$resultado = $this->db->query($sql);
			//while($row = $resultado->fetch_assoc())
			//{
			//	$this->ofertas[] = $row;
			//}
			
			return $listaOfertas;
		}*/
	


		//Intentado actualizar consultas de mysqli a pdo

		  //consultas para las categorias  segun su id de empresa 
		  public function belleza(){
			$sentencia=$this->pdo->prepare( " SELECT * FROM `oferta` WHERE ID_Empresa='EMP004'");		
			$sentencia->execute();
			$resultado=$sentencia;
			//$row =$sentencia
			while($row = $resultado->fetchAll(PDO::FETCH_ASSOC))
			{
				$this->ofertas[] = $row;
			}
			return $this->ofertas;
		}
	
		public function restaurante(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `oferta` WHERE ID_Empresa='EMP001'");		
			$sentencia->execute();
			$resultado=$sentencia;
			while($row = $resultado->fetchAll(PDO::FETCH_ASSOC))
			{
				$this->ofertas[] = $row;
			}
			return $this->ofertas;
		}
	
		public function salud(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `oferta` WHERE ID_Empresa='EMP003'");		
			$sentencia->execute();
			$resultado=$sentencia;
			while($row = $resultado->fetchAll(PDO::FETCH_ASSOC))
			{
				$this->ofertas[] = $row;
			}
			return $this->ofertas;
		}
	
		public function super(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `oferta` WHERE ID_Empresa='EMP002'");		
			$sentencia->execute();
			$resultado=$sentencia;
			while($row = $resultado->fetchAll(PDO::FETCH_ASSOC))
			{
				$this->ofertas[] = $row;
			}
			return $this->ofertas;
		}



	
	} 
?>