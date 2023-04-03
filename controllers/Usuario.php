<?php
class UsuarioController{


    public function __construct(){
        require_once "models/UsuarioModel.php";
    }
    
    public function index(){
        require_once "views/Usuario/login.php";	
    }

    public function pagina(){
        require_once "views/Menu/buyit.php";
    }

    public function sesion(){ 
        $Correo = $_POST['email'];
        $Contrasenia=$_POST['password'];
        $usuarios=new Usuario_model();
            if(  $usuarios->sesion($Correo,$Contrasenia) > 0){
                
                     // session_start();
                      //$_SESSION['Usuario']=$Contrasenia;
                    $this->pagina();
              

            }
  
                else{
  
                
                  echo "Usuario y/o Contraseña incorrectos";
                 
                }

            }
               



}