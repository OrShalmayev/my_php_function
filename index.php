<?php
function checkInputsAndSanitize($inputName = ''){
    if($inputName==='phone'){//clean phone for crm
        $_POST[$inputName] = preg_replace("/[^0-9]/", "", $_POST[$inputName]);
    }
    // if the input is email and the email is not valid email return null
    if($inputName==='email' && !filter_var($_POST[$inputName], FILTER_VALIDATE_EMAIL)){
        return null;
    }
    return ( isset_not_empty($_POST[$inputName]) ) ? sanitizeInput($_POST[$inputName]) : null;
}

function validateInput($data) {
    // $data = trim();
    // $data = preg_replace("/[^a-z]/", "", $data);
    return $data;
}
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
/*
* Description: Checks if variable is set and not empty
*/
function isset_not_empty($v):bool{
    return isset($v) && !empty($v);
}
/*
* For Debuging
*/
function dd($v){
    echo "<pre>";
    die(var_dump($v));
}

/*
* Description check if all input fields was filled and posted
*/
function isInputsValidChecker(){
    global $input_fields;
    // dd($input_fields);
    $inputsValid = true;
    foreach ($_POST as $key => $value) {// looping through every input was posted in the form
        if( array_key_exists($key, $input_fields) ){// only if the key is exists in the inputs we chose
            $input_fields[$key] = checkInputsAndSanitize($key); // if $key = fullname then $fullname is set to the checkInputsAndValidate output
            if(!$input_fields[$key]){// if the variable is null then break the loop and make change the variable to false
                // dd($key);
                $inputsValid = false;
                break;
            }
        }
    }//END foreach
    return $inputsValid;
}