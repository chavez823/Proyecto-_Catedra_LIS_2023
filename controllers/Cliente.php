<?php
// doc de librería de php mailer 
//require_once 'vendor/autoload.php';
require_once "./core/validaciones.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'controllers/vendor/autoload.php';
require 'Phpmailer/Exception.php';
require 'Phpmailer/PHPMailer.php';
require 'Phpmailer/SMTP.php';


class ClienteController
{
    public function __construct()
    {
        require_once "models/ClienteModel.php";
        require_once "models/UsuarioModel.php";
    }

    //llama ala pagina de registro de nuevo cliente  y la muestra
    public function index()
    {
        require_once "views/cliente/cliente.php";
    }

    //llama y muestra la pagina de verificacion de cliente
    public function verificacion()
    {
        require_once "views/cliente/emailverification.php";
        
    }

    //muestra la pagina de login
    public function login()
    {
        require_once "views/Usuario/login.php";
    }

   //para tomar los datos del nuevo cliente y su usuario
    public function nuevo()
    {
    
        $Nombres = $_POST['name'];
        $Apellidos = $_POST['apellido'];
        $Dui = $_POST['dui'];
        $Correo = $_POST['email'];
        $Contrasenia = $_POST['password'];
        $Telefono = $_POST['telefono'];
        $Direccion = $_POST['direccion'];
        $Token = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        //$Token=1599;
        $clientes = new Cliente_model();
        $ID_Usuario=substr(number_format(time() * rand(), 0, '', ''), 0, 6);

           //vlidaciones
        if(empty($Nombres)|| empty($Apellidos)|| empty($Dui)|| empty($Correo)|| empty($Contrasenia)||empty($Telefono)||empty($Direccion)){
            $errores=array();      
            array_push($errores,"Debes completar todos los campos");              
            require_once "views/cliente/cliente.php";
        }


        if(!texto($Nombres)){
            $errores=array();
            array_push($errores,"Debes Ingresar Unicamente datos validos en nombre");                    
            require_once "views/cliente/cliente.php";
        }

        if(!texto($Apellidos)){
            $errores=array();
            array_push($errores,"Debes Ingresar Unicamente datos validos en apellido");                    
            require_once "views/cliente/cliente.php";
        }

        if(!validar_dui($Dui)){
            $errores=array();
            array_push($errores,"Debes Ingresar un numero de DUI valido");                    
            require_once "views/cliente/cliente.php";
        }

        if(!validar_tel($Telefono)){
            $errores=array();
            array_push($errores,"Debes Ingresar un numero de telefono valido");                    
            require_once "views/cliente/cliente.php";
        }
        




        else{
        
           //comprueba que el correo y el dui no esten registrados 
        if ($clientes->registrodui($Dui) !=null || $clientes->registrocorreo($Correo)!=null) {
          //echo var_dump($clientes->registrodui($Dui));
          //echo var_dump($clientes->registrocorreo($Correo));
           // echo "Dui y/o correo ya están en uso ";
           //echo '<script language="javascript">alert("Dui y/o correo ya están en uso");window.location.href="index.php?c=cliente"</script>';
          
        $errores=array();
      
        array_push($errores,"Dui y/o correo ya están en uso");
          
        require_once "views/cliente/cliente.php";


        } else {
            //envia el correo con el token 

         //  $mail = new PHPMailer(true);

            try {

               /* $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'yam182141@gmail.com';
			    $mail->Password = 'sfxovgjaykgnmmgb';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom('yam182141@gmail.com', 'Tienda-tech.com');
                $mail->addAddress($Correo, $Nombres);
                $mail->isHTML(true);
                $mail->Subject = 'Verificación de Correo ';
                $mail->Body    = '<p>Tu código de verificación es : <b style="font-size: 30px;">' . $Token . '</b></p>';
                $mail->send();*/

               
              /* echo var_dump($clientes->registrodui($Dui));
               echo var_dump($clientes->registrocorreo($Correo));*/
                 //se almacenan los datos del nuevo cliente en variables de sesión 
                $_SESSION['registro_nuevo_cliente'] = array();
                $_SESSION['registro_nuevo_cliente'][0] = $Dui;
                $_SESSION['registro_nuevo_cliente'][1] = $Nombres;
                $_SESSION['registro_nuevo_cliente'][2] = $Apellidos;
                $_SESSION['registro_nuevo_cliente'][3] = $Contrasenia;
                $_SESSION['registro_nuevo_cliente'][4] = $Correo;
                $_SESSION['registro_nuevo_cliente'][5] = $Telefono;
                $_SESSION['registro_nuevo_cliente'][6] = $Direccion;
                $_SESSION['registro_nuevo_cliente'][7] = $Token;
                $_SESSION['registro_nuevo_cliente'][8] = $ID_Usuario;
                //luego ocupamos el metodo de verificacion
               $this->verificacion();


               exit();
            } catch (Exception $e) {
               // echo "Nose envió su token vuelva a intentarlo. Mailer Error: {/$mail->ErrorInfo}";
               $errores=array();
      
               array_push($errores,"Nose envió su token vuelva a intentarlo");
              
             require_once "views/cliente/cliente.php";
            
    
            }
        }
    }

        
    }

     //este metodo registra funciona con la pagina de verificacion de correo 
    public function registrar()
    {

        $email = $_POST["email"];
        $verification_code = $_POST["verification_code"];
        $Tipo="Cliente";
        $clientes = new Cliente_model();
        $usuario=  new  Usuario_model();
         //comprueba que el correo sea igual al que se ingreso en la pagina de de registro y que el token sea igual que se mando al correo 
       
        if ($_SESSION['registro_nuevo_cliente'][4] == $email && $_SESSION['registro_nuevo_cliente'][7] == $verification_code) {
               
           //inserta los datos necesarios en tabla usuario 
            $usuario->insertar_usuario($_SESSION['registro_nuevo_cliente'][8], $_SESSION['registro_nuevo_cliente'][1],
            $_SESSION['registro_nuevo_cliente'][2], $_SESSION['registro_nuevo_cliente'][4],  $_SESSION['registro_nuevo_cliente'][3],$Tipo);
              //inserta los datos necesarios en tabla cliente 
           $clientes->insertar($_SESSION['registro_nuevo_cliente'][0], $_SESSION['registro_nuevo_cliente'][1], $_SESSION['registro_nuevo_cliente'][2], $_SESSION['registro_nuevo_cliente'][3], $_SESSION['registro_nuevo_cliente'][4], $_SESSION['registro_nuevo_cliente'][5], $_SESSION['registro_nuevo_cliente'][6], $_SESSION['registro_nuevo_cliente'][7], $_SESSION['registro_nuevo_cliente'][8]);
            //llamamos al metodo login 
            $this->login();
        } else {
           // echo "Correo y/o código equivocado";
           //echo '<script language="javascript">alert("Error de autentificacion");window.location.href="index.html"</script>';

           $errores=array();
      
           array_push($errores,"Correo y/o código equivocado");
          
        
        require_once "views/cliente/emailverification.php";
        }
    }
}



