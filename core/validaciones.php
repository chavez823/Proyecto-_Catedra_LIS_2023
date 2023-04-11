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

/*Verifica Si es texto*/
function texto($var){    
    return preg_match('/^[a-zA-Z ]+$/',$var);
}

/*Valida el dui*/
function validar_dui($var){
    return preg_match('/^[0-9]{9}$/',$var);
    
}

/*Valida el numero de telefono*/
function validar_tel($var){
    return preg_match('/^[76][0-9]{7}$/',$var);
} 

/*Valida el numero de tarjeta*/
function validar_t_num($var){
    return preg_match('/^\d{16}$/',$var);
}

/*Valida Fecha de vencimiento*/
function validar_date($var){
    return preg_match('/^\d{4}$/',$var);
}

/*Valida el codigo cvv*/
function valida_cvv($var){
    return preg_match('/^\d{3,4}$/',$var);
}


?>


