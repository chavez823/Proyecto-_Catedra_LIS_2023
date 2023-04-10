<?php
include_once "controllers/vendor/autoload.php";	
use Dompdf\Dompdf;
require 'Phpmailer/Exception.php';
require 'Phpmailer/PHPMailer.php';
require 'Phpmailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class CuponController {
		
		public function __construct(){
			require_once "models/CuponModel.php";
			
			
		}
		//abre la pagina de categorias
		public function ver_cupon(){
			if(!empty($_SESSION['session'])){
			$model = new Cupon_model();
			$DUI=$model->getDUI($_SESSION['session']['ID_Usuario']);
			$cupones =$model->getCupones($DUI[0]['DUI']);
			require_once "views/Compras/compras.php";}else{
				
				header('location:'.'/Proyecto-_Catedra_LIS_2023/index.php?c=Usuario');
			}

		}

		public function compra_completa()
				{
					$fecha = $_POST['fecha_exp'];
					$codigovencimiento=$_POST['cvv'];
					$nombre_representate=$_POST['Nombre_t'];
					




					$model = new Cupon_model();//se instancia la clase del modelo cupon para usar sus metodos 
					$dompdf = new Dompdf();//se instacia la clase dompdf que genera el pdf
					//Comienza la generacion del pdf
					$productos=$_SESSION['CARRITO'];//todos los elementos del carrito se almacenan en productos
					ob_start(); //da la pauta para comenzar a generar el contenido del pdf
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
					$nombreImagen = "img/Logo_1.png";//ubicacion de la imagen del logo
					$imagenBase64 =  "data:image/png;base64," .base64_encode(file_get_contents($nombreImagen));//se convierte la imagen del logo a base 64 para que se vea en el detalle
					echo "<img src=".$imagenBase64." class=\"img1\">";
					echo "<h1>Detalle de compra</h1>";
					echo "<br/>";
					echo "<table>";
					echo "<thead>";
					echo "<th>Código</th>";
					echo "<th>Nombre</th>";
					echo "<th>Descripción</th>";
					echo "<th>Precio</th>";
					echo "<th>Codigo Cupon</th>";
					echo "</thead>";
					$total=0;
					foreach ($_SESSION['CARRITO'] as $cupon) {//dividimos cada elemento del arreglo del carrito en un arreglo cupon que incluye toda la informacion de la oferta 
							
						for ($j=0; $j < $cupon['CANTIDAD']; $j++) { //se corre el ciclo la cantidad de veces que se a comprado una oferta para generar un numero de cupon unico por cada oferta.
							echo "<tr>";
							echo "<td>".$cupon['ID']."</td>";
							echo "<td>".$cupon['NOMBRE']."</td>";
							echo "<td>".$cupon['DESCRIPCION']."</td>";
							echo "<td>$ ".$cupon['PRECIO']."</td>";
							$total=$total+$cupon['PRECIO'];//se suman los precios para luego mostrar el total.
							$num_aleatorio=rand(0,9);//genera el primer numero aleatorio
							$nombre_empresa=$model->getNombreEmpresa($cupon['ID']);//se obtiene el nombre de la empresa dependiendo del id del cupon
							for ($i=0; $i < 6; $i++) { 
								$num_aleatorio .= rand(0,9);//se concatena los siguientes 6 numeros aletorios
							}
							//Definiendo valores a insertar a la tabla del cupon
							$codigo_cupon=$nombre_empresa[0]['ID_Empresa'].$num_aleatorio; //Creacion del codigo del cupon
							echo "<td>".$codigo_cupon."</td>"; //impresion del codigo en el pdf
							$DUI=$model->getDUI($_SESSION['session']['ID_Usuario']);//se obtiene el numero de dui del cliente mediante su id de usuario
							$model->insertar_cupon($codigo_cupon, $DUI[0]['DUI'],$cupon['ID'], 2);//cada cupon se inserta en la tabla cupon 1 por 1 
							echo "</tr>";
						}
					}
					echo "<tr>";
					echo "<td class=\"tdb\"></td>";
					echo "<td class=\"tdb\"></td>";
					echo "<td class=\"tdb\"></td>";
					echo "<th>Total</th>";
					echo "<td>$".$total."</td>";
					echo "</tr>";
					echo "</table>";
					echo "</body>";
					echo "</html>";


					$html = ob_get_clean(); //ob_get_clean captura toda la información y lo amacenamos en una variable
					$dompdf->loadHtml($html); //loadHtml carga la información contenida en la variable $html
					$rutaGuardado = "pdfs/";; //se define una ruta en donde se gurdara el pdf
					srand (time());
					$nombre=rand(1,100);
					for ($i=0; $i < 5; $i++) { 
						$nombre .= rand(1,100);
					}
					$nombreArchivo=$nombre.".pdf"; // el nombre del archivo 
					$dompdf->render(); // renderiza el archivo
					//header("Content-type: application/pdf"); // define el tipo
					//header("Content-Disposition: inline; filename=".$nombreArchivo."");// define el nombre y la disposicion en la que se vera el documento en el navegador
					$dompdf->output(); //crea el archivo
					$outPut=$dompdf->output();
					file_put_contents($rutaGuardado.$nombreArchivo,$outPut); // funcion que mueve el archivo a la ruta definida 

					//Envio del correo
					$archivo = $rutaGuardado.$nombreArchivo;
					$nombre='Envio del detalle de la compra';
					try {   
						/*$mail = new PHPMailer(true);
						$mail->IsSMTP(); // Using SMTP.
						$mail->CharSet = 'utf-8';
						$mail->SMTPDebug = 0; // Enables SMTP debug information - SHOULD NOT be active on production servers!
						$mail->SMTPSecure = 'tls';
						$mail->SMTPAuth = 'true'; // Enables SMTP authentication.
						$mail->Host = "smtp.gmail.com"; // SMTP server host.
						$mail->Port = 587; // Setting the SMTP port for the GMAIL server.

						//Usuario con contraseña autorizada por gmail
						$mail->Username = "yam182141@gmail.com"; // SMTP account username (GMail email address).
						$mail->Password = 'sfxovgjaykgnmmgb'; // Contraseña creada a partir de google, para permisos de aplicacion
						
						//Envio de mensaje
						$mail->SetFrom('yam182141@gmail.com', 'me'); // De quien - match the GMail email.
						$mail->AddAddress($_SESSION['session']['correo'], 'Someone Else'); // Para email / name.

						//Mensaje
						$mail->Subject = 'CONFIRMACION DE LA COMPRA';
						$mail->Body = 'Nombre' .$nombre;
						//mensaje con archivo, direccion del archivo
						$mail->addAttachment($archivo); 
						$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';*/
						
						//Para enviar
						//$mail->send();
					} catch (Exception $e) {
						//echo "La cotización no ha sido enviada: {$mail->ErrorInfo}";
					}
					//Borra todas las ofertas del carrito y se renderiza la vista de gracias.
					$_SESSION['CARRITO']=array();
					require_once ('views/carrito/Gracias.php');
				}

				public function generarCupon($id_cupon){
					$model = new Cupon_model();
					$cupon_detalle=$model->getCupon($id_cupon);//se obtiene el cupon mediante el id del cupon pasado por parametro
					$dompdf = new Dompdf();
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
					echo "<h1>Cupón</h1>";
					echo "<br/>";
					echo "<table>";
					echo "<thead>";
					echo "<th>Código Cupon</th>";
					echo "<th>Nombre</th>";
					echo "<th>Descripción</th>";
					echo "</thead>";
					foreach ($cupon_detalle as $cupon) {	
							//se imprimen todos los detalles del cupon 
							echo "<tr>";
							echo "<td>".$cupon['ID_Cupon']."</td>";
							echo "<td>".$cupon['Titulo']."</td>";
							echo "<td>".$cupon['Descripcion']."</td>";
					}
					echo "</table>";
					echo "</body>";
					echo "</html>";
					$html = ob_get_clean(); //ob_get_clean captura toda la información y lo amacenamos en una variable
					$dompdf->loadHtml($html); //loadHtml carga la información contenida en la variable $html
					$rutaGuardado = "pdfs_cupon/";; //se define una ruta en donde se gurdara el pdf
					srand (time());
					$nombre=rand(1,100);
					for ($i=0; $i < 5; $i++) { 
						$nombre .= rand(1,100);
					}
					$nombreArchivo=$nombre.".pdf"; // el nombre del archivo 
					$dompdf->render(); // renderiza el archivo
					//header("Content-type: application/pdf"); // define el tipo
					//header("Content-Disposition: inline; filename=".$nombreArchivo."");// define el nombre y la disposicion en la que se vera el documento en el navegador
					$dompdf->output(); //crea el archivo
					$outPut=$dompdf->output();
					file_put_contents($rutaGuardado.$nombreArchivo,$outPut); // funcion que mueve el archivo a la ruta definida 
					header("location:pdfs_cupon/".$nombreArchivo);//se redirecciona al pdf 
				}



    }