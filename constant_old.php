<?php
define("HOSTNAME", "https://".$_SERVER['HTTP_HOST']."/");
define("PAYURL", "https://www.sandbox.paypal.com/cgi-bin/webscr");
define("PAYEMAIL", "singh.durgesh08@gmail.com");
define("MAXUPLOAD", 4000000);
define("ACCEPTIMAGE", ".png, .jpg, .jpeg");
define("ENCRYPTION-KEY", "leo-tbe");
define("IV", "1");

function encrypt($pure_string) {
    $dirty = array("+", "/", "=");
    $clean = array("_PLUS_", "_SLASH_", "_EQUALS_");
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $_SESSION['iv'] = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, ENCRYPTION-KEY, utf8_encode($pure_string), MCRYPT_MODE_ECB, IV);
    $encrypted_string = base64_encode($encrypted_string);
    return str_replace($dirty, $clean, $encrypted_string);
}

function decrypt($encrypted_string) { 
    $dirty = array("+", "/", "=");
    $clean = array("_PLUS_", "_SLASH_", "_EQUALS_");

    $string = base64_decode(str_replace($clean, $dirty, $encrypted_string));

    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, ENCRYPTION-KEY,$string, MCRYPT_MODE_ECB, IV);
    return $decrypted_string;
}
function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = 'muni';
    $secret_iv = 'muni123';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}


?>
