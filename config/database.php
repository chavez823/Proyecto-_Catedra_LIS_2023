<?php
	
	class Conectar {
		/*mvc*/
		public static function conexion(){
			$servidor="mysql:dbname=proyecto;host=localhost";

			try {

				$pdo= new PDO($servidor,"root","",
					  array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
					  //echo "<script>alert('Conectado...')</script>";
			} catch (PDOException $e) {
				echo "<script>alert('Error...')</script>";
			}


			//$conexion = new mysqli("localhost", "root", "", "Proyecto");
			//echo "Si conecto";
			return $pdo;
			
		}
	}
?>