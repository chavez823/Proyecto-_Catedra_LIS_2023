<?php
	
	class Categoria_model {
		
		private $db;
		private $inicio;
		private $ofertas;
		
		public function __construct(){
			$this->db = Conectar::conexion();
			$this->ofertas = array();
			
		}
		

		public function get_inicio()
		{
			$sql = " SELECT * FROM `oferta`";
			$resultado = $this->db->query($sql);
			while($row = $resultado->fetch_assoc())
			{
				$this->ofertas[] = $row;
			}
			return $this->ofertas;
		}
	


		







		
	
	} 
?>