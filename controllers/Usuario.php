<?php
class UsuarioController{


    public function __construct(){
        require_once "models/UsuarioModel.php";
    }
    //abre la pagina login 
    public function index(){
        require_once "views/Usuario/login.php";	
    }
     ///abre la pagina luego de logearse 
    public function pagina(){
        require_once "views/Menu/principal.php";
    }

    public function sesion(){ 
        $Correo = $_POST['email'];
        $Contrasenia=$_POST['password'];
        $usuarios=new Usuario_model();
           //si es mayor que cero quiere decir qiue si existe ese usuario 
            if(  $usuarios->sesion($Correo,$Contrasenia) > 0){
                
                session_start();
               $_SESSION['session']=array();
                $_SESSION['session']["nombre"]=   $usuarios->sesion($Correo,$Contrasenia)['Nombres'];
                $_SESSION['session']["apellido"]=   $usuarios->sesion($Correo,$Contrasenia)['Nombres'];
                $_SESSION['session']["tipo_usuario"]=   $usuarios->sesion($Correo,$Contrasenia)['Tipo'];
             
             
                    $this->pagina();
              

            }
  
                else{
  
                
                  echo "Usuario y/o Contraseña incorrectos";
                 
                }

            }
               



}