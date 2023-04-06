<?php
class CuponController {
		
		public function __construct(){
			require_once "models/CuponModel.php";
		}
		//abre la pagina de categorias
		public function ver_cupon(){
		
			require_once "views/Compras/compras.php";	
		}
    }