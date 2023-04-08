<?php
class UsuarioController{


    public function __construct(){
        require_once "models/UsuarioModel.php";
    }
    
    public function index(){
        require_once "views/Usuario/login.php";	
    }

    public function recuperacion(){
        require_once "views/Usuario/recuperacioncontraseña.php";	
    }

    public function cambio(){
        require_once "views/Usuario/cambiodecontraseña.php";	
    }


    







   




}