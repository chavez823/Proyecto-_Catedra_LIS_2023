<?php
	include_once "controllers/vendor/autoload.php";
	//include_once './Core/config.php';
	use Dompdf\Dompdf;
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
					//echo var_dump(conunt($usuarios->sesion($Correo,$Contrasenia)));
	
				}
	  
					else{
	  
					
					  echo "Usuario y/o Contraseña incorrectos";
					  
					 
					}
	
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
			 	public function compra_completa()
				{
					require_once ('views/carrito/Gracias.php');
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
				
				public function generarPdf(){
       
					$dompdf = new Dompdf();
					
					$productos=$_SESSION['CARRITO'];
					ob_start(); 
					echo "<!DOCTYPE html>";
					echo "<html lang=\"en\">";
					echo "<head>";
					echo " <meta charset=\"UTF-8\">";
					echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
					echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
					echo "<title>PDF</title>";
					echo "<style>";
					echo ".img1{";
					echo "width: 200px;";
					echo "height: 100px;";
					echo "}";
					echo ".tdb{";
					echo "border: none;";
					echo "}";
					echo ".center {";
					echo "text-align: center;";
					echo "border: 3px solid green;";
					echo "}";
					echo "h1{";
					echo "text-align: center;";
					echo "font-family: \"Lucida Console\, \"Courier New\", monospace;";
					echo "text-decoration: underline;";
					echo "}";
					echo "table {";
					echo "width: 100%;";
					echo "border: none;";
					echo "}";
					echo "th, td {";
					echo "font-family: \"Lucida Console\", \"Courier New\", monospace;";
					echo "width: 25%;";
					echo "text-align: center;";
					echo "vertical-align: top;";
					echo "border: 1px solid #000;";
					echo " border-collapse: collapse;";
					echo "padding: 0.3em;";
					echo "caption-side: bottom;";
					echo "}";
					echo "th {";
					echo "background: #D1F2EB;";
					echo "font-size: 20px;";
					echo "}";
					echo "</style>";
					echo "</head>";
					echo "<body>";
					$nombreImagen = "img/Logo_1.png";
					$imagenBase64 =  "data:image/png;base64," .base64_encode(file_get_contents($nombreImagen));
					echo "<img src=".$imagenBase64." class=\"img1\">";
					echo "<h1>Detalle de compra</h1>";
					echo "<br/>";
					echo "<table>";
					echo "<thead>";
					echo "<th>Código</th>";
					echo "<th>Nombre</th>";
					echo "<th>Descripción</th>";
					echo "<th>Cantidad</th>";
					echo "<th>Imagen</th>";
					echo "<th>Precio</th>";
					echo "</thead>";
					$total=0;
					for ($i=0; $i < sizeof($productos) ; $i++) { 
					echo "<tr>";
					foreach ($productos[$i] as $clave => $valor) {
						if($clave=='IMAGEN')
						{
							$nombreImagen = "img/Logo_1.png";
							$imagenBase64 = "data:image/png;base64," .base64_encode(file_get_contents($nombreImagen));;
							echo "<td><img src=".$imagenBase64." width=\"100\" height=\"100\"/></td>";
						}
						else
						{
							if($clave=="CANTIDAD"){
								$cantidad=$valor;
							}
							if($clave=="PRECIO")
							{
								$precio=$valor;
								$total=$cantidad*$precio;
								echo "<td>$".$valor."</td>";
							}
							else{
								echo "<td>".$valor."</td>";
							}
						}
					}
					echo "</tr>";
				}
					echo "<tr>";
					echo "<td class=\"tdb\"></td>";
					echo "<td class=\"tdb\"></td>";
					echo "<td class=\"tdb\"></td>";
					echo "<td class=\"tdb\"></td>";
					echo "<th>Total</th>";
					echo "<td>$". $total."</td>";
					echo "</tr>";
					echo "</table>";
					echo "</body>";
					echo "</html>";
					$html = ob_get_clean(); //ob_get_clean captura toda la información y lo amacenamos en una variable
					$dompdf->loadHtml($html); //loadHtml carga la información contenida en la variable $html
					$rutaGuardado = "./View/assets/pdfs/";; //se define una ruta en donde se gurdara el pdf
					srand (time());
					$nombre=rand(1,100);
					for ($i=0; $i < 5; $i++) { 
						$nombre .= rand(1,100);
					}
					$nombreArchivo=$nombre.".pdf"; // el nombre del archivo 
					$dompdf->render(); // renderiza el archivo
					header("Content-type: application/pdf"); // define el tipo
					header("Content-Disposition: inline; filename=".$nombreArchivo."");// define el nombre y la disposicion en la que se vera el documento en el navegador
					echo $dompdf->output(); //crea el archivo
					$outPut=$dompdf->output();
					file_put_contents($rutaGuardado.$nombreArchivo,$outPut); // funcion que mueve el archivo a la ruta definida 
				}
	}
?>