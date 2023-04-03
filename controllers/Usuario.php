<?php
class UsuarioController{


    public function __construct(){
        require_once "models/UsuarioModel.php";
    }
    
    public function index(){
        require_once "views/Usuario/login.php";	
    }

    public function pagina(){
        require_once "views/Menu/principal.php";
    }

    public function sesion(){ 
        $Correo = $_POST['email'];
        $Contrasenia=$_POST['password'];
        $usuarios=new Usuario_model();
            if(  $usuarios->sesionempleado($Correo,$Contrasenia) > 0 || $usuarios->sesioncliente($Correo, $Contrasenia)>0){
                if(  $usuarios->sesioncliente($Correo,$Contrasenia) > 0){
                     // session_start();
                      //$_SESSION['Usuario']=$Contrasenia;
                    $this->pagina();
                }

                else{





                }

            }
  
                else{
  
                
                  echo "Usuario y/o Contraseña incorrectos";
                 
                }

            }
               



}