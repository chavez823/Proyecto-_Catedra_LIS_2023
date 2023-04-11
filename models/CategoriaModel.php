<?php
	
	class Categoria_model {
		
		private $pdo;
		//private $inicio;
		private $ofertas;
		
		public function __construct(){
			$this->pdo = Conectar::conexion();
			$this->ofertas = array();
			
		}
		

		  //consultas para las categorias  segun su categoria de rubro de empresa 
		  public function belleza(){
			$sentencia=$this->pdo->prepare( " SELECT * FROM `Oferta` WHERE `Categoria`='Belleza'");		
			$sentencia->execute();
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $listaOfertas;
			
		}
	
		public function restaurante(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `Oferta` WHERE Categoria='Restaurante'");		
			$sentencia->execute();			
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $listaOfertas;
		}
	
		public function salud(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `Oferta` WHERE Categoria='Salud'");		
			$sentencia->execute();
			
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $listaOfertas;
		}
	
		public function otros(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `Oferta` WHERE Categoria='otros'");		
			$sentencia->execute();
			
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $listaOfertas;
		}

		public function super(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `Oferta` WHERE Categoria='Super'");		
			$sentencia->execute();
			
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $listaOfertas;
		}



	
	} 
?>