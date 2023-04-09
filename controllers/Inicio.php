<?php
	include_once "controllers/vendor/autoload.php";
	require_once "./core/validaciones.php";
	//include_once './Core/config.php';
	//pdf
	use Dompdf\Dompdf;
	//envio de correo
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	class InicioController {
			
		public function __construct(){
			require_once "models/InicioModel.php";
			require_once "models/UsuarioModel.php";
			
		}
		
		public function index(){
			$inicio = new Inicio_model();
			//$data["titulo"] = "Inicio";
			$data["Ofertas"] = $inicio->get_inicio();
			require_once "views/Menu/buyit.php";	
		}

		/*Para Inicio de sesion*/
		
		





				public function carrito($id){
				
				
					$info_oferta=explode("/",$id);
					if(!empty($_SESSION['session'])){

					
					$inicio = new Inicio_model();
					$promo=$inicio->get_promo($info_oferta[0]);
					$ID=$promo[0]['ID_Oferta'];
					$NOMBRE=$promo[0]['Titulo'];
					$DESCRIPCION=$promo[0]['Descripcion'];
					$IMAGEN=$promo[0]['Imagen'];
					$PRECIO=$promo[0]['PrecioOferta'];
					
					if(!isset($_SESSION['CARRITO'])){ //SI NO EXITE NADA EN EL CARRITO
						$elemento=array(//CAPTURAMOS LOS DATOS DEL FORMULARIO
							'ID'=>$ID,
							'NOMBRE'=>$NOMBRE,
							'DESCRIPCION'=>$DESCRIPCION,
							'CANTIDAD'=>1,
							'IMAGEN'=>$IMAGEN,
							'PRECIO'=>$PRECIO
						);
						$_SESSION['CARRITO'][0]=$elemento;
						//cargando la vista de ofertas
						//echo var_dump($_SESSION['CARRITO']);
						if($info_oferta[1]=='')
						{
							header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=Inicio');
						}else if($info_oferta[1]=='2'){
							header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=belleza');
						}else if($info_oferta[1]=='3'){
						header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=restaurante');
						}else if($info_oferta[1]=='4'){
						header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=salud');
						}else if($info_oferta[1]=='5'){
							header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=otros');
						}
						else{
							header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=Inicio&a=mostrarCarrito');
						}
					}else{ 
						$IdProductos=array_column($_SESSION['CARRITO'],"ID"); 
						//array column deposita todos los ids que estan en el carrito de compras
						if(in_array($ID,$IdProductos)){
							$carro=$_SESSION['CARRITO'];
							$codigo_producto=$ID;
							foreach ($carro as $indice => $oferta) {
							if($oferta['ID']==$codigo_producto){
								$carro[$indice]['CANTIDAD'] += 1;
							}
						}
							$_SESSION['CARRITO']=$carro;
							//cargando la vista de ofertas
							//echo var_dump($_SESSION['CARRITO']);
							if($info_oferta[1]==''){
								header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=Inicio');
							}else if($info_oferta[1]=='2'){
								header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=belleza');
							}else if($info_oferta[1]=='3'){
								header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=restaurante');
							}else if($info_oferta[1]=='4'){
								header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=salud');
							}else if($info_oferta[1]=='5'){
								header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=otros');
							}
							else{
								header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=Inicio&a=mostrarCarrito');
							}
		
						}else{
							//SI YA HAY 1 PRODUCTO EN EL CARRITO 
							//echo var_dump($_SESSION['CARRITO']);
						$numeroProductos=count($_SESSION['CARRITO']);//NUMERO DE ELEMENTOS EN CARRITO
						$elemento=array(//CAPTURAMOS LOS DATOS DEL FORMULARIO
							'ID'=>$ID,
							'NOMBRE'=>$NOMBRE,
							'DESCRIPCION'=>$DESCRIPCION,
							'CANTIDAD'=>1,
							'IMAGEN'=>$IMAGEN,
							'PRECIO'=>$PRECIO
						);
						$_SESSION['CARRITO'][$numeroProductos]=$elemento;
						//cargando la vista de ofertas
						if($info_oferta[1]==''){
							header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=Inicio');
						}else if($info_oferta[1]=='2'){
							header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=belleza');
						}else if($info_oferta[1]=='3'){
							header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=restaurante');
						}else if($info_oferta[1]=='4'){
							header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=salud');
						}else if($info_oferta[1]=='5'){
							header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=categoria&a=otros');
						}
						else{
							header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=Inicio&a=mostrarCarrito');
						}
						}
						
					}
				}else{
				
					header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=Usuario');
				}

				} 

				public function mostrarCarrito(){
					require_once ('views/Menu/pages/mostrarCarrito.php');
				}
				public function pagar(){
					require_once ('views/carrito/Pago_tarjeta.php');
				}
			 	
				public function pdf(){
					echo var_dump($_SESSION['CARRITO']);
				}

				public function delete($ID){
						//Aqui se define cada objeto del carrito mediante del indice
						foreach ($_SESSION['CARRITO'] as $indice => $producto) {
							if($producto['ID']==$ID){
								unset($_SESSION['CARRITO'][$indice]);
								echo "<script>alert('Elemento borrado...');</script>";
							}
						}
						header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=Inicio&a=mostrarCarrito');
				}
				public function restar($ID, $CANTIDAD=1){
					$carro=$_SESSION['CARRITO'];
					foreach ($carro as $indice => $producto) {
					if($producto['ID']==$ID){
						$identificador=$indice;
						$cantidadActual=$producto['CANTIDAD'];
						}
					}
					if($cantidadActual==1){
						unset($_SESSION['CARRITO'][$identificador]);
					}
					else{
						$carro[$identificador]['CANTIDAD'] -= $CANTIDAD;
						$_SESSION['CARRITO']=$carro;
					}
					header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=Inicio&a=mostrarCarrito');
				}
							
				
	}
?>