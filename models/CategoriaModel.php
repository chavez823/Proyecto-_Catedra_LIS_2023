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
			$sentencia=$this->pdo->prepare( " SELECT * FROM `oferta` WHERE Categoria='Belleza'");		
			$sentencia->execute();
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $listaOfertas;
			
		}
	
		public function restaurante(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `oferta` WHERE Categoria='Restaurante'");		
			$sentencia->execute();			
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $listaOfertas;
		}
	
		public function salud(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `oferta` WHERE Categoria='Salud'");		
			$sentencia->execute();
			
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $listaOfertas;
		}
	
		public function otros(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `oferta` WHERE Categoria='otros'");		
			$sentencia->execute();
			
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $listaOfertas;
		}

		public function super(){
			$sentencia=$this->pdo->prepare(" SELECT * FROM `oferta` WHERE Categoria='Super'");		
			$sentencia->execute();
			
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $listaOfertas;
		}



	
	} 
?>