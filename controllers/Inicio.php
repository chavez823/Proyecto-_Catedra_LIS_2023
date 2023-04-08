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
			$data["titulo"] = "Inicio";
			$data["Ofertas"] = $inicio->get_inicio();
			require_once "views/Menu/buyit.php";	
		}

		/*Para Inicio de sesion*/
		public function sesion(){ 
			$Correo = $_POST['email'];
			$Contrasenia=$_POST['password'];
			$usuarios=new Usuario_model();

			 if(empty($Correo) || empty($Contrasenia)){
				$errores=array();    
				array_push($errores,"Debes completar todos los campos");							   
			  	require_once "views/Usuario/login.php";				
			 }

			 /*Con el correo Semita@horchata no dejara logearse*/
			 if(validar_correo($Correo)){
				$errores=array();
				array_push($errores, "Tienes que ingresar un correo Valido");
				require_once "views/Usuario/login.php";
			 }
			 			 


			 else{
			
				if(count($usuarios->sesion($Correo,$Contrasenia)) > 0){
					//echo var_dump($usuarios->sesion($Correo,$Contrasenia));
					$usuario=$usuarios->sesion($Correo,$Contrasenia);
					//echo var_dump($usuario);
				    $_SESSION['session']=array();
					$_SESSION['session']["ID_Usuario"]=   $usuario[0]['ID_Usuario'];
					$_SESSION['session']["nombre"]=   $usuario[0]['Nombres'];
					$_SESSION['session']["apellido"]=   $usuario[0]['Apellidos'];
					$_SESSION['session']["tipo_usuario"]=   $usuario[0]['Tipo'];
					//capturando contrseña y corre para el cambio
					$_SESSION['session']["Contrseña"]=   $usuario[0]['Contrasenia'];
					$_SESSION['session']["correo"]=   $usuario[0]['Correo'];

				 
					$inicio = new Inicio_model();
					$data["titulo"] = "Inicio";
					$data["Ofertas"] = $inicio->get_inicio();
		
					
					
					require_once "views/Menu/buyit.php";	
					//echo var_dump(conunt($usuarios->sesion($Correo,$Contrasenia)));
	
				}
	  
				else{					
					 // echo "Usuario y/o Contraseña incorrectos";
				$errores=array();
				array_push($errores,"Correo y/o contraseña equivocado");	
				require_once "views/Usuario/login.php";	 
				}
			}
	
		}



	public function recuperar(){
		    $Correo = $_POST['email'];
		
			$usuarios=new Usuario_model();

			 if(empty($Correo)){
				$errores=array();      
				array_push($errores,"Debes colocar tu correo");			   
			  	require_once "views/Usuario/recuperacioncontraseña.php";
				
			 }

			/*Con el correo Semita@horchata no dejara logearse*/
			 if(validar_correo($Correo)){
				$errores=array();
				array_push($errores, "Tienes que ingresar un correo Valido");
				require_once "views/Usuario/login.php";
			 }


			 else{
			
				if(count($usuarios->registrocorreo($Correo)) > 0){
					$Contrasenia=substr(number_format(time() * rand(), 0, '', ''), 0, 6);
					$cambio=$usuarios->registrocorreo($Correo);
					//$_SESSION['enviocontra']=array();
					$nombre=  $cambio[0]['Nombres'];
					//$_SESSION['enviocontra']["id"]=  " $cambio[0]['ID_Usuario']";
					
				   // $mail = new PHPMailer(true);
					

					try {

						/* $mail->SMTPDebug = 0;
						  $mail->isSMTP();
						  $mail->Host = 'smtp.gmail.com';
						  $mail->SMTPAuth = true;
						  $mail->Username = 'yam182141@gmail.com';
						  $mail->Password = 'sfxovgjaykgnmmgb';
						  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
						  $mail->Port = 587;
						  $mail->setFrom('yam182141@gmail.com', 'Buyit.com');
						  $mail->addAddress($Correo, $nombre);
						  $mail->isHTML(true);
						  $mail->Subject = 'Verificación de Correo ';
						  $mail->Body    = '<p>Tu nueva contraseña de verificación para BUYIT es : <b style="font-size: 30px;">' . $Contrasenia . '</b></p>';
						  $mail->send();*/

						  //modificando la contrseña en la base de datos
						  $usuarios->modificar_contraseña($Correo,$Contrasenia);

						 require_once "views/Usuario/login.php";
		  
						
						 exit();
					  } catch (Exception $e) {
						 
						 $errores=array();
				
						 array_push($errores,"No se ha enviado su nueva contraseña, vuelva a intentarlo");
						
						 require_once "views/Usuario/recuperacioncontraseña.php";
					   
			  
					  }
					}
				

					else{

					 $errores=array();
					 array_push($errores,"Correo no existe o esta equivocado");
					
				   require_once "views/Usuario/recuperacioncontraseña.php";
					}
				} 
			}
			
            public function cambiocontraseña(){

			//$Correo = $_POST['email'];
			$Contrasenia=$_POST['password'];
			$usuarios=new Usuario_model();

			 if(empty($Contrasenia)){

				$errores=array();
      
				array_push($errores,"Debes escribir una contraseña");
			   
			  require_once "views/Usuario/cambiodecontraseña.php";
				
			 }

			 else{
				//if($Contrasenia1==$_SESSION['session']["Contrseña"]){

					$usuarios->modificar_contraseña($_SESSION['session']["correo"],$Contrasenia);
					$inicio = new Inicio_model();
					$data["titulo"] = "Inicio";
					$data["Ofertas"] = $inicio->get_inicio();
				
					//require_once "views/Usuario/login.php";
					require_once "views/Menu/buyit.php";

				}

				/*else{

					$errores=array();
      
				array_push($errores,"Debes escribir una contraseña");
			   
			  require_once "views/Usuario/cambiodecontraseña.php";


				}*/

			 }


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