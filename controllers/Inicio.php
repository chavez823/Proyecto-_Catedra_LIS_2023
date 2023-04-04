<?php
	
	class InicioController {
		
		public function __construct(){
			require_once "models/InicioModel.php";
		}
		
		public function index(){
			$inicio = new Inicio_model();
			
			$data["Ofertas"] = $inicio->get_inicio();
			require_once "views/Menu/buyit.php";	
		}






		

		
		
	}
?>