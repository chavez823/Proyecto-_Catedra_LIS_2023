<?php
	
	class CategoriaController {
		
		public function __construct(){
			require_once "models/CategoriaModel.php";

		}
		   //llama y muestra la pagina de categorias 
		public function index(){
			require_once "views/Menu/pages/Categorias.php";	
		}


//metodos que se llaman igual a los que estan en la clase de categorias model por que cada uno  de estos ecuta la consulta y la muestra  
   public function belleza(){
	$Categoria = new Categoria_model();
			
			$data["Categorias"] = $Categoria->belleza();

	require_once "views/Menu/pages/Belleza.php";

}

public function restaurante(){
	$Categoria = new Categoria_model();
	
			$data["Categorias"] = $Categoria->restaurante();

	require_once "views/Menu/pages/Restaurante.php";

}


public function salud(){
	$Categoria = new Categoria_model();
			
			$data["Categorias"] = $Categoria->salud();

	require_once "views/Menu/pages/salud.php";

}



public function super(){
	$Categoria = new Categoria_model();
	
$data["Categorias"] = $Categoria->super();

	require_once "views/Menu/pages/super.php";

}


		   






		

		
		
	}
?>