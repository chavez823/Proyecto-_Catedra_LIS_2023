<?php
	
	class CategoriaController {
		
		public function __construct(){
			require_once "models/CategoriaModel.php";
		}
		//abre la pagina de categorias
		public function index(){
		
			require_once "views/Menu/pages/Categorias.php";	
		}






		

		
		
	}
?>