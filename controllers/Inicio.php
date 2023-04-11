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
		
		



  //recibe la variable id  que trae el numero de la vista y el id de la oferta 

				public function carrito($id){
				
				//se convirtio de nuevo a un arreglo con emplode con indice de cero a uno 
					$info_oferta=explode("/",$id); 
					if(!empty($_SESSION['session'])){

					
					$inicio = new Inicio_model();//se instancia la clase de inicio para poder usar su metodos 
					$promo=$inicio->get_promo($info_oferta[0]);//get promo obtiene la oferta elegida para comprar
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
						$_SESSION['CARRITO'][0]=$elemento; //la oferta elegida se almacena en la primera posicion del arreglo
						//Dependiendo desde que categoria se agregue al carrito se direccionara a la vista correspondiente
						//array 
						if($info_oferta[1]=='')
						{
							header('location:'.'/index.php?c=Inicio');
						}else if($info_oferta[1]=='2'){
							header('location:'.'/index.php?c=categoria&a=belleza');
						}else if($info_oferta[1]=='3'){
						header('location:'.'/index.php?c=categoria&a=restaurante');
						}else if($info_oferta[1]=='4'){
						header('location:'.'/index.php?c=categoria&a=salud');
						}else if($info_oferta[1]=='5'){
							header('location:'.'/index.php?c=categoria&a=super');
						}
						else{
							header('location:'.'/index.php?c=Inicio&a=mostrarCarrito');
						}
					}else{ 
						
						$IdProductos=array_column($_SESSION['CARRITO'],"ID"); 
						//array column deposita todos los ids que estan en el carrito de compras
						//in array verifica que si el ID de la oferta elegida esta en el arreglo IdProductos 
						if(in_array($ID,$IdProductos)){
							$carro=$_SESSION['CARRITO'];
							$codigo_producto=$ID;
							foreach ($carro as $indice => $oferta) {
							if($oferta['ID']==$codigo_producto){//recorre todo el arreglo del carrito y cuando encuentra que los ID conciden modifica el valor de la cantidad en el indice que encontro la coincidencia
								$carro[$indice]['CANTIDAD'] += 1;
							}
						}
							$_SESSION['CARRITO']=$carro;
							//cargando la vista de ofertas
							//echo var_dump($_SESSION['CARRITO']);
							if($info_oferta[1]==''){
								header('location:'.'/index.php?c=Inicio');
							}else if($info_oferta[1]=='2'){
								header('location:'.'/index.php?c=categoria&a=belleza');
							}else if($info_oferta[1]=='3'){
								header('location:'.'/index.php?c=categoria&a=restaurante');
							}else if($info_oferta[1]=='4'){
								header('location:'.'/index.php?c=categoria&a=salud');
							}else if($info_oferta[1]=='5'){
								header('location:'.'/index.php?c=categoria&a=super');
							}
							else{
								header('location:'.'/index.php?c=Inicio&a=mostrarCarrito');
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
						//Se almacena la oferta segun el numero de ofertas que estan actualmente en el carrito
						$_SESSION['CARRITO'][$numeroProductos]=$elemento;
						//cargando la vista de ofertas
						if($info_oferta[1]==''){
							header('location:'.'/index.php?c=Inicio');
						}else if($info_oferta[1]=='2'){
							header('location:'.'/index.php?c=categoria&a=belleza');
						}else if($info_oferta[1]=='3'){
							header('location:'.'/index.php?c=categoria&a=restaurante');
						}else if($info_oferta[1]=='4'){
							header('location:'.'/index.php?c=categoria&a=salud');
						}else if($info_oferta[1]=='5'){
							header('location:'.'/index.php?c=categoria&a=super');
						}
						else{
							header('location:'.'/index.php?c=Inicio&a=mostrarCarrito');
						}
						}
						
					}
				}else{
				//por si la session no esta definida 
					header('location:'.'/index.php?c=Usuario');
				}

				} 

				public function mostrarCarrito(){
					require_once ('views/Menu/pages/mostrarCarrito.php');//mustra la vista del carrtio 
				}
				public function pagar(){
					require_once ('views/carrito/Pago_tarjeta.php');//muestra la vista para pagar
				}
			 	
				

				public function delete($ID){
						//Aqui se define cada objeto del carrito mediante del indice
						foreach ($_SESSION['CARRITO'] as $indice => $producto) {
							if($producto['ID']==$ID){//cuando el indice en el arreglo del carrito coicide con el que se paso por parametro se procede a la eliminacion
								//un vaciado dependiendo el id de oferta 
								unset($_SESSION['CARRITO'][$indice]);
								//echo "<script>alert('Elemento borrado...');</script>";
							}
						}
						header('location:'.'/index.php?c=Inicio&a=mostrarCarrito');
				}
				public function restar($ID, $CANTIDAD=1){
					
					$carro=$_SESSION['CARRITO'];//almacenamos el arreglo del carrito en la variable carro para poder comparar los elementos
					foreach ($carro as $indice => $producto) {
					if($producto['ID']==$ID){//cuando el ID coicida con el indice pasado por parametro 
						$identificador=$indice;//se guarda el indice 
						$cantidadActual=$producto['CANTIDAD'];//se guarda la cantidad actual
						}
					}
					if($cantidadActual==1){
						unset($_SESSION['CARRITO'][$identificador]);//si la cantidad corresponde a 1 se elimina el elemento
					}
					else{
						$carro[$identificador]['CANTIDAD'] -= $CANTIDAD;//si es mayor a uno solo se resta un elementos
						$_SESSION['CARRITO']=$carro; //el arreglo carro se alamcena en la variable de sesion del carrito
					}
					header('location:'.'/index.php?c=Inicio&a=mostrarCarrito');
				}
							
				
	}
?>