<?php
	
	class Inicio_model {
		
		private $pdo;
		//private $inicio;
		//private $ofertas;
		
		public function __construct(){
			$this->pdo = Conectar::conexion();
			//$this->ofertas = array();
			
		}
		
		public function get_inicio()
		{
			
			$sentencia=$this->pdo->prepare("SELECT * FROM `Oferta` LIMIT 3");
			$sentencia->execute();
			$listaOfertas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			
			return $listaOfertas;
		}
		 //metodo ocupado en el carrito 
		public function get_promo($id='')
		{
			$sentencia=$this->pdo->prepare("SELECT * FROM `Oferta` WHERE ID_Oferta like '$id'");
			$sentencia->execute();
			$oferta=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $oferta;
		}
	
	} 
?>