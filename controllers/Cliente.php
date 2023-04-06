<?php
// doc de librería de php mailer 
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
        //echo var_dump($_SESSION['registro_nuevo_cliente']);
    }

    //muestra la pagina de login
    public function login()
    {
        require_once "views/Usuario/login.php";
    }


    public function nuevo()
    {
        $Nombres = $_POST['name'];
        $Apellidos = $_POST['apellido'];
        $Dui = $_POST['dui'];
        $Correo = $_POST['email'];
        $Contrasenia = $_POST['password'];
        $Telefono = $_POST['telefono'];
        $Direccion = $_POST['direccion'];
        //$Token = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $Token=1599;
        $clientes = new Cliente_model();
        $ID_Usuario=substr(number_format(time() * rand(), 0, '', ''), 0, 6);
       
        

        if ($clientes->registrodui($Dui) != null || $clientes->registrocorreo($Correo) != null) {
          //echo var_dump($clientes->registrodui($Dui));
          //echo var_dump($clientes->registrocorreo($Correo));
           // echo "Dui y/o correo ya están en uso ";
           //echo '<script language="javascript">alert("Dui y/o correo ya están en uso");window.location.href="index.php?c=cliente"</script>';
          
        $errores=array();
      
        array_push($errores,"Dui y/o correo ya están en uso");
          
        require_once "views/cliente/cliente.php";


        } else {
            

          // $mail = new PHPMailer(true);

            try {

              /*  $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = '';
                $mail->Password = '';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom('', 'Tienda-tech.com');
                $mail->addAddress($Correo, $Nombres);
                $mail->isHTML(true);
                $mail->Subject = 'Verificación de Correo ';
                $mail->Body    = '<p>Tu código de verificación es : <b style="font-size: 30px;">' . $Token . '</b></p>';
                $mail->send();*/

               // session_start();
              /* echo var_dump($clientes->registrodui($Dui));
               echo var_dump($clientes->registrocorreo($Correo));*/

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

               $this->verificacion();


               exit();
            } catch (Exception $e) {
               // echo "Nose envió su token vuelva a intentarlo. Mailer Error: {/$mail->ErrorInfo}";
               $errores=array();
      
               array_push($errores,"Nose envió su token vuelva a intentarlo");
              
             require_once "views/cliente/cliente.php";
             //$this->verificacion();
    
            }
        }
        
    }


    public function registrar()
    {

        $email = $_POST["email"];
        $verification_code = $_POST["verification_code"];
        $Tipo="Cliente";
        $clientes = new Cliente_model();
        $usuario=  new  Usuario_model();
       
       // session_start();
        if ($_SESSION['registro_nuevo_cliente'][4] == $email && $_SESSION['registro_nuevo_cliente'][7] == $verification_code) {
               

            $usuario->insertar_usuario($_SESSION['registro_nuevo_cliente'][8], $_SESSION['registro_nuevo_cliente'][1],
            $_SESSION['registro_nuevo_cliente'][2], $_SESSION['registro_nuevo_cliente'][4],  $_SESSION['registro_nuevo_cliente'][3],$Tipo);

           $clientes->insertar($_SESSION['registro_nuevo_cliente'][0], $_SESSION['registro_nuevo_cliente'][1], $_SESSION['registro_nuevo_cliente'][2], $_SESSION['registro_nuevo_cliente'][3], $_SESSION['registro_nuevo_cliente'][4], $_SESSION['registro_nuevo_cliente'][5], $_SESSION['registro_nuevo_cliente'][6], $_SESSION['registro_nuevo_cliente'][7], $_SESSION['registro_nuevo_cliente'][8]);
            //session_destroy();
            $this->login();
        } else {
           // echo "Correo y/o código equivocado";
           //echo '<script language="javascript">alert("Error de autentificacion");window.location.href="index.html"</script>';

           $errores=array();
      
           array_push($errores,"Correo y/o código equivocado");
          
        // $this->verificacion();// require_once "views/cliente/cliente.php";
        require_once "views/cliente/emailverification.php";
        }
    }
}

