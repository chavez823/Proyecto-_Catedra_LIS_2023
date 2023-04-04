<?php
	
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
				if(  $usuarios->sesion($Correo,$Contrasenia) > 0){
					
					session_start();
				   $_SESSION['session']=array();
					$_SESSION['session']["nombre"]=   $usuarios->sesion($Correo,$Contrasenia)['Nombres'];
					$_SESSION['session']["apellido"]=   $usuarios->sesion($Correo,$Contrasenia)['Nombres'];
					$_SESSION['session']["tipo_usuario"]=   $usuarios->sesion($Correo,$Contrasenia)['Tipo'];
				 
				 
					$inicio = new Inicio_model();
					$data["titulo"] = "Inicio";
					$data["Ofertas"] = $inicio->get_inicio();
		
					
					
					require_once "views/Menu/buyit.php";	
				  
	
				}
	  
					else{
	  
					
					  echo "Usuario y/o Contraseña incorrectos";
					 
					}
	
				}
		
	}
?>