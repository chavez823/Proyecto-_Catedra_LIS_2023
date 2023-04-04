<?php
	
	class Categoria_model {
		
		private $db;
		private $inicio;
		private $ofertas;
		
		public function __construct(){
			$this->db = Conectar::conexion();
			$this->ofertas = array();
			
		}
		
          //consulta que muestra todas las ofertas 
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



		  //consultas para las categorias  segun su id de empresa 
		public function belleza(){
		$sql = " SELECT * FROM `oferta` WHERE ID_Empresa='EMP004'";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc())
		{
			$this->ofertas[] = $row;
		}
		return $this->ofertas;
	}

	public function restaurante(){
		$sql = " SELECT * FROM `oferta` WHERE ID_Empresa='EMP001'";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc())
		{
			$this->ofertas[] = $row;
		}
		return $this->ofertas;
	}

	public function salud(){
		$sql = " SELECT * FROM `oferta` WHERE ID_Empresa='EMP003'";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc())
		{
			$this->ofertas[] = $row;
		}
		return $this->ofertas;
	}

	public function super(){
		$sql = " SELECT * FROM `oferta` WHERE ID_Empresa='EMP002'";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc())
		{
			$this->ofertas[] = $row;
		}
		return $this->ofertas;
	}

	


		







		
	
	} 
?>