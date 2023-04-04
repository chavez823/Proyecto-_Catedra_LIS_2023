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
          // print_r($belleza);
		 // var_dump($ofertas);
		  
		require_once "views/Menu/pages/Belleza.php";
		//echo "sirve ";

		}






		

		
		
	}
?>