<?php
	
	class CategoriaController {
		
		public function __construct(){
			require_once "models/CategoriaModel.php";

		}
		
		public function index(){
			$Categoria = new Categoria_model();
			//$data["titulo"] = "Inicio";
			$data["Categorias"] = $Categoria->get_inicio();

			require_once "views/Menu/pages/Categorias.php";	
		}

   public function belleza(){
	$Categoria = new Categoria_model();
			//$data["titulo"] = "Inicio";
			$data["Categorias"] = $Categoria->get_inicio();

	require_once "views/Menu/pages/Belleza.php";

}



		   






		

		
		
	}
?>