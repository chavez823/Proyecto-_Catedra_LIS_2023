<?php
	
	class Inicio_model {
		
		private $db;
		private $inicio;
		private $ofertas;
		
		public function __construct(){
			$this->db = Conectar::conexion();
			$this->ofertas = array();
			
		}
		
        //consulta que muestra solo 3 ofertas para la pagina inicio(buyit)
		public function get_inicio()
		{
			$sql = " SELECT * FROM `oferta` LIMIT 3";
			$resultado = $this->db->query($sql);
			while($row = $resultado->fetch_assoc())
			{
				$this->ofertas[] = $row;
			}
			return $this->ofertas;
		}
	


		







		
	
	} 
?>