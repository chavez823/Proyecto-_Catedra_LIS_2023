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
					
					$model = new Cupon_model();
					$dompdf = new Dompdf();
					//Comienza la generacion del pdf
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
					echo "<th>Precio</th>";
					echo "<th>Codigo Cupon</th>";
					echo "</thead>";
					$total=0;
					foreach ($_SESSION['CARRITO'] as $cupon) {
							
						for ($j=0; $j < $cupon['CANTIDAD']; $j++) { 
							//Creacion del cupon
							echo "<tr>";
							echo "<td>".$cupon['ID']."</td>";
							echo "<td>".$cupon['NOMBRE']."</td>";
							echo "<td>".$cupon['DESCRIPCION']."</td>";
							echo "<td>$ ".$cupon['PRECIO']."</td>";
							$total=$total+$cupon['PRECIO'];
							$num_aleatorio=rand(0,9);
							$nombre_empresa=$model->getNombreEmpresa($cupon['ID']);
							for ($i=0; $i < 6; $i++) { 
								$num_aleatorio .= rand(0,9);
							}
							//Definiendo valores a insertar a la tabla del cupon
							$codigo_cupon=$nombre_empresa[0]['ID_Empresa'].$num_aleatorio;
							echo "<td>".$codigo_cupon."</td>";
							$DUI=$model->getDUI($_SESSION['session']['ID_Usuario']);
							$model->insertar_cupon($codigo_cupon, $DUI[0]['DUI'],$cupon['ID'], 2);
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
						$mail = new PHPMailer(true);
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
						$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
						
						//Para enviar
						$mail->send();
					} catch (Exception $e) {
						echo "La cotización no ha sido enviada: {$mail->ErrorInfo}";
					}
					//Borra todas las ofertas del carrito
					$_SESSION['CARRITO']=array();
					require_once ('views/carrito/Gracias.php');
				}



    }