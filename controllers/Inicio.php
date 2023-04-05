<?php
	
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

		public function sesion(){ 
			$Correo = $_POST['email'];
			$Contrasenia=$_POST['password'];
			$usuarios=new Usuario_model();
			
				if(count($usuarios->sesion($Correo,$Contrasenia)) > 0){
					//echo var_dump($usuarios->sesion($Correo,$Contrasenia));
					$usuario=$usuarios->sesion($Correo,$Contrasenia);
					//echo var_dump($usuario);
				    $_SESSION['session']=array();
					$_SESSION['session']["nombre"]=   $usuario[0]['Nombres'];
					$_SESSION['session']["apellido"]=   $usuario[0]['Apellidos'];
					$_SESSION['session']["tipo_usuario"]=   $usuario[0]['Tipo'];
					
				 
					$inicio = new Inicio_model();
					$data["titulo"] = "Inicio";
					$data["Ofertas"] = $inicio->get_inicio();
		
					
					
					require_once "views/Menu/buyit.php";	
					echo var_dump(conunt($usuarios->sesion($Correo,$Contrasenia)));
	
				}
	  
					else{
	  
					
					  echo "Usuario y/o Contraseña incorrectos";
					  
					 
					}
	
				}



				public function carrito($id){
				
				
					$info_oferta=explode("/",$id);
					

					
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
						$IdProductos=array_column($_SESSION['CARRITO'],"ID"); //array column deposita todos los ids que estan en el carrito de compras
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

				} 

				public function mostrarCarrito(){
					require_once ('views/Menu/pages/mostrarCarrito.php');
				}
				public function pagar(){
					require_once ('views/carrito/Pago_tarjeta.php');
				}
			 	public function compra_completa()
				{
					require_once ('views/carrito/Gracias.php');
				}
				public function pdf(){
					echo var_dump($_SESSION['CARRITO']);
				}

		
	}
?>