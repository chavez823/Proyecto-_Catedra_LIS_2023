<?php
	
	class Conectar {
		/*mvc*/
		public static function conexion(){
			
			$conexion = new mysqli("localhost", "root", "", "Proyecto");
			echo "Si conecto";
			return $conexion;
			
		}
	}
?>