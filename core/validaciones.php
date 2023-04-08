<?php
function validar_correo($email) {
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        return $email;

    }
    else {
        echo "{$email}: Ingrese un correo valido"."<br>";
    }
}


/*Valida campo vacio*/
function VACIO($var){
    return empty(trim($var));
}

function texto($var){    
    return preg_match('/^[a-zA-Z ]+$/',$var);
}

function validar_dui($var){
    return preg_match('/^[0-9]{9}$/',$var);
    
}

function validar_tel($var){
    return preg_match('/^[76][0-9]{7}$/',$var);
} 



?>


