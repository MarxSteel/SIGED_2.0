<?php
/**
 * Tutorial: PHP Login Registration system
 *
 * Page : Profile
 */




//senha mail rv1FkdpqcUsM
// Start Session
session_start();

// check user login
if(empty($_SESSION['user_id']))
{
    header("Location: index.php");
}

// Database connection
require __DIR__ . '/database.php';
$db = DB();

// Application library ( with DemoLib class )
require __DIR__ . '/lib/library.php';
$app = new DemoLib();

$user = $app->UserDetails($_SESSION['user_id']); // get user details

$loginUser = $user->username;
$privs = $app->PrivilegioSocio($loginUser);

//$server = 'http://192.168.1.101:8888/interact/interact/';	//CASA WIFI
$server = 'http://localhost:8888/interact/SIGED_2.0/';		//JUPTER
$s = $server . '/assets/';
$Titulo = "SIGED - Sistema de Gestão Distrital | MDIO Interact Brasil";
$Distrito = "1234";
$NomeUL = "Marquistei Medeiros";

$Versao = "2.2.2";


/*
 *FUNÇÃO PARA CALCULAR IDADE
*/
function calcIdade($birthdate)
{
    $now = new DateTime();
    $diff = $now->diff(new DateTime($birthdate));
     
    return $diff->y;
}

function dateConvert($date)
{
    if ( ! strstr( $date, '/' ) )
    {
        // $date está no formato ISO (yyyy-mm-dd) e deve ser convertida
        // para dd/mm/yyyy
        sscanf($date, '%d-%d-%d', $y, $m, $d);
        return sprintf('%02d/%02d/%04d', $d, $m, $y);
    }
    else
    {
        // $date está no formato brasileiro e deve ser convertida para ISO
        sscanf($date, '%d/%d/%d', $d, $m, $y);
        return sprintf('%04d-%02d-%02d', $y, $m, $d);
    }
 
    return false;
}

?>