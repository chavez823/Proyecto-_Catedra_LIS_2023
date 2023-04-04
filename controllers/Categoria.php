<?php
	
	class CategoriaController {
		
		public function __construct(){
			require_once "models/CategoriaModel.php";
		}
		//abre la pagina de categorias
		public function index(){
			//$inicio = new Categoria_model();
			//$data["titulo"] = "Inicio";
			//$data["Categorias"] = $inicio->get_inicio();

			
			
			require_once "views/Menu/pages/Categorias.php";	
		}






		

		
		
	}
?>