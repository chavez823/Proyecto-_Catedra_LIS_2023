<?php
	
	class CategoriaController {
		
		public function __construct(){
			require_once "models/CategoriaModel.php";
		}
		//abre la pagina de categorias
		public function index(){
		
			require_once "views/Menu/pages/Categorias.php";	
		}


     // public prueba()




		public function belleza (){
			$belleza =  new Categoria_model();

		$belleza->belleza();
		$ofertas=$belleza->belleza();
		require_once "views/Menu/pages/Belleza.php";
		}


		public function restaurante (){
		$restaurante =  new Categoria_model();
		$restaurante->restaurante();
		$resta=$restaurante->restaurante();
		require_once "views/Menu/pages/Restaurante.php";
		}
         


		public function salud (){
			$salud =  new Categoria_model();
		$salud->salud();
		$sa=$salud->salud();
		require_once "views/Menu/pages/salud.php";
		}

		public function otros (){
			$otros =  new Categoria_model();

		$otros->otros();
		$ot=$otros->otros();
		require_once "views/Menu/pages/salud.php";
		}


		

		
		
	}
?>