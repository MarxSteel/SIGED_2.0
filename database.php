<?php
/**
 * iTech Empires Tutorial Script : PHP Login Registration system with PDO Connection
 *
 * File: Database Configuration
 */

define('HOST', 'localhost:8889'); 
define('USER', 'root'); 
define('PASSWORD', 'root'); 
define('DATABASE', 'siged');

/*
define('HOST', 'mysql.hostinger.com.br'); // Database host name ex. localhost
define('USER', 'u220304474_sist'); // Database user. ex. root ( if your on local server)
define('PASSWORD', 'kromw8tISH34'); // Database user password  (if password is not set for user then keep it empty )
define('DATABASE', 'u220304474_sist'); // Database Database name

*/




date_default_timezone_set('America/Sao_Paulo');

function DB()
{
    try {
        $db = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);
        return $db;
    } catch (PDOException $e) {
        return "Error!: " . $e->getMessage();
        die();
    }
}

function db_connect()
{
    $PDO = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8', USER, PASSWORD);
  
    return $PDO;
}

/**
 * Converte datas entre os padrões ISO e brasileiro
 * Fonte: http://rberaldo.com.br/php-conversao-de-datas-formato-brasileiro-e-formato-iso/
 */


function TiraCaractere($string) {

    // matriz de entrada
    $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );

    // matriz de saída
    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_' );

    // devolver a string
    return str_replace($what, $by, $string);
}

?>