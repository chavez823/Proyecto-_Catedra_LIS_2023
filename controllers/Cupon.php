<?php
class CuponController {
		
		public function __construct(){
			require_once "models/CuponModel.php";
		}
		//abre la pagina de categorias
		public function ver_cupon(){
		
			require_once "views/Compras/compras.php";	
		}

		public function compra_completa()
				{
					//echo var_dump($_SESSION['CARRITO']);
					//echo var_dump($_SESSION['session']);
					$model = new Cupon_model();
					
				
					foreach ($_SESSION['CARRITO'] as $cupon) {
						for ($j=0; $j < $cupon['CANTIDAD']; $j++) { 
							//Creacion del cupon
							$num_aleatorio=rand(0,9);
							$nombre_empresa=$model->getNombreEmpresa($cupon['ID']);
							for ($i=0; $i < 6; $i++) { 
								$num_aleatorio .= rand(0,9);
							}
							//Definiendo valores a insertar a la tabla del cupon
							$codigo_cupon=$nombre_empresa[0]['ID_Empresa'].$num_aleatorio;
							$DUI="167564";
							$model->insertar_cupon($codigo_cupon, $DUI,$cupon['ID'], 2);
						}
					}

					//Borra todas las ofertas del carrito
					$_SESSION['CARRITO']=array();
					require_once ('views/carrito/Gracias.php');
				}



    }