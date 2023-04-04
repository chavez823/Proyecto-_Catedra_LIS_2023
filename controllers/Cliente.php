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
    }

    //muestra la pagina de login
    public function login()
    {
        require_once "views/Usuario/login.php";
    }

 //metodo que se ejecuta luego de apretar el boton de crear cuenta del formulario de registro de cliente 
    public function nuevo()
    {
        $Nombres = $_POST['name'];
        $Apellidos = $_POST['apellido'];
        $Dui = $_POST['dui'];
        $Correo = $_POST['email'];
        $Contrasenia = $_POST['password'];
        $Telefono = $_POST['telefono'];
        $Direccion = $_POST['direccion'];

        //codigo random del token 
        $Token = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        //obejeto de la clase cliente model 
        $clientes = new Cliente_model();
        //crea un id de usuario random;
        $ID_Usuario=substr(number_format(time() * rand(), 0, '', ''), 0, 6);
       //comprueba que el dui y el correo no esten  registrados o en uso 
        if ($clientes->registrodui($Dui) > 0 || $clientes->registrocorreo($Correo) > 0) {
            echo "Dui y/o correo ya están en uso ";
        } else {


            // si no esta registrado envia el codigo del token al correo y crea las variables de Session que serviran en el metodo registrar para guardar el usuario y cliente nuevo 

            $mail = new PHPMailer(true);

            try {

                $mail->SMTPDebug = 0;


                $mail->isSMTP();


                $mail->Host = 'smtp.gmail.com';


                $mail->SMTPAuth = true;


                $mail->Username = 'buyitshoplis@gmail.com';


                $mail->Password = 'nwbjbxlpvjvooqwj';


                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


                $mail->Port = 587;


                $mail->setFrom('pepeshoes01lis@gmail.com', 'Tienda-tech.com');


                $mail->addAddress($Correo, $Nombres);

                $mail->isHTML(true);


                $mail->Subject = 'Verificación de Correo ';
                $mail->Body    = '<p>Tu código de verificación es : <b style="font-size: 30px;">' . $Token . '</b></p>';

                $mail->send();
                //creando las variables de session
                session_start();
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
                //llama al metdo verificacion que es el que abre el formulario de verificacion
                $this->verificacion();


                exit();
            } catch (Exception $e) {
                echo "Nose envió su token vuelva a intentarlo. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }


    //registra o guarda un nuevo cliente 
    public function registrar()
    {

        $email = $_POST["email"];
        $verification_code = $_POST["verification_code"];
        $Tipo="Cliente";
        $clientes = new Cliente_model();
        $usuario=  new  Usuario_model();
        session_start();
          //verifica que el correo y el token o codigo sean iguales al que ingreso en el formulario de registro y que el toque sea igual al que se envio al correo si es asi se crea el nuevo cliente guardando los datos en la base de datos
        if ($_SESSION['registro_nuevo_cliente'][4] == $email || $_SESSION['registro_nuevo_client'][7] = $verification_code) {
               
            //llena primero la tabla usuario 
            $usuario->insertar_usuario($_SESSION['registro_nuevo_cliente'][8], $_SESSION['registro_nuevo_cliente'][1],
            $_SESSION['registro_nuevo_cliente'][2], $_SESSION['registro_nuevo_cliente'][4],  $_SESSION['registro_nuevo_cliente'][3],$Tipo);
            //llena de segundo la tabla cliente 
           $clientes->insertar($_SESSION['registro_nuevo_cliente'][0], $_SESSION['registro_nuevo_cliente'][1], $_SESSION['registro_nuevo_cliente'][2], $_SESSION['registro_nuevo_cliente'][3], $_SESSION['registro_nuevo_cliente'][4], $_SESSION['registro_nuevo_cliente'][5], $_SESSION['registro_nuevo_cliente'][6], $_SESSION['registro_nuevo_cliente'][7], $_SESSION['registro_nuevo_cliente'][8]);
            //luego destruye las variables de session
           session_destroy();

            //lo manda ala pagina de login 
            $this->login();



        } else {
            echo "Correo y/o código equivocado";
        }
    }
}
