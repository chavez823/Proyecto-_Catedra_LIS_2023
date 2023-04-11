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

class UsuarioController{


    public function __construct(){
        require_once "models/UsuarioModel.php";
        require_once "models/InicioModel.php";

    }
      //abre  ala pagina login 
    public function index(){
        require_once "views/Usuario/login.php";	
    }
    //abre  ala pagina recuperacion
    public function recuperacion(){
        require_once "views/Usuario/recuperacioncontraseña.php";	
    }
       //abre  ala pagina de cambio de contraseña 
    public function cambio(){
        require_once "views/Usuario/cambiodecontraseña.php";	
    }

//metodo ocupado en la pagina de login 
    public function sesion(){ 
        
        $Correo = $_POST['email'];
        $Contrasenia=$_POST['password'];
        $usuarios=new Usuario_model();
          //validaciones
         if(empty($Correo) || empty($Contrasenia)){
            $errores=array();    
            array_push($errores,"Debes completar todos los campos");							   
              require_once "views/Usuario/login.php";				
         }

         /*Con el correo Semita@horchata no dejara logearse*/
         if(!validar_correo($Correo)){
            $errores=array();
            array_push($errores, "Tienes que ingresar un correo Valido");
            require_once "views/Usuario/login.php";
         }
                      


         else{
              //comprueba que el usuario exista 
            if(count($usuarios->sesion($Correo,$Contrasenia)) > 0){
                 //
                $usuario=$usuarios->sesion($Correo,$Contrasenia);
                //
                $_SESSION['session']=array();
                $_SESSION['session']["ID_Usuario"]=   $usuario[0]['ID_Usuario'];
                $_SESSION['session']["nombre"]=   $usuario[0]['Nombres'];
                $_SESSION['session']["apellido"]=   $usuario[0]['Apellidos'];
                $_SESSION['session']["tipo_usuario"]=   $usuario[0]['Tipo'];
                //capturando contrseña y corre para el cambio
                $_SESSION['session']["Contrseña"]=   $usuario[0]['Contrasenia'];
                $_SESSION['session']["correo"]=   $usuario[0]['Correo'];

             
                $inicio = new Inicio_model();
                //
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
          //validaciones 
         if(empty($Correo)){
            $errores=array();      
            array_push($errores,"Debes colocar tu correo");			   
              require_once "views/Usuario/recuperacioncontraseña.php";
            
         }

        /*Con el correo Semita@horchata no dejara logearse*/

         if(!validar_correo($Correo)){
            $errores=array();
            array_push($errores, "Tienes que ingresar un correo Valido");
            require_once "views/Usuario/login.php";
         }


         else{
         //comprueba que el correo exita en la base de datos 
            if(count($usuarios->registrocorreo($Correo)) > 0){
                $Contrasenia=substr(number_format(time() * rand(), 0, '', ''), 0, 6);

                $cambio=$usuarios->registrocorreo($Correo);
                
                $nombre=  $cambio[0]['Nombres'];
                
                //envia la nueva contraseña 
                $mail = new PHPMailer(true);
                

                try {

                      $mail->SMTPDebug = 0;
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
                      $mail->send();

                      //modificando la contrseña en la base de datos

                      //inserta la nueva contraseña 
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

    
        $Contrasenia=$_POST['password'];
        $usuarios=new Usuario_model();
           //validacion 
         if(empty($Contrasenia)){

            $errores=array();
  
            array_push($errores,"Debes escribir una contraseña");
           
          require_once "views/Usuario/cambiodecontraseña.php";
            
         }

         else{
        
                //inserta la nueva contraseña recordando  que $_SESSION['session']["correo"] toma el valor del correo con el que inicio el cliente sesion 
                $usuarios->modificar_contraseña($_SESSION['session']["correo"],$Contrasenia);
                $inicio = new Inicio_model();
                
                $data["Ofertas"] = $inicio->get_inicio();
            
                
                require_once "views/Menu/buyit.php";

            }

            

         }
        // metodo que sirve para cerrar sesion 

         public function logout(){
              //vacia las varables de sesion
             session_unset();
             //destruye las varibles de  sesiones 
             session_destroy();
            //nos redirreciona ala pagina de inicio 
             header('location: index.php?c=Inicio');
            
            
            
            
             }


    







   




}