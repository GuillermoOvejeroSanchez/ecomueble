<?php
//URL Pedida
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$relativePath = getenv('PHP_SERVER_RELATIVE_PATH');
$fullPath = $_SERVER["DOCUMENT_ROOT"] . $relativePath . $path;
$status_code = http_response_code(); //Codigo de estado (200, 404, etc)
$form = "";

//IP Attempts count array
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if(isset($_SESSION['ipc'])) {
    $ip_counts = $_SESSION['ipc'];
}else {
    $ip_counts = array(); 
    $ip_counts[getUserIpAddr()] = 0;
}

//Intento de login
if($path == '/login' && isset($_SESSION['login_failed'])){
    $ip_counts = countLoginAttempts($ip_counts);
    $form .= " - ATTEMPTS: " . $ip_counts[getUserIpAddr()];
    $form .= " to user: " . $_SESSION['failed_user'];
    unset($_SESSION['login_failed']);
    
}
//Loggeado
else if (isset($_SESSION['username'])) {
    $form .= " LOGGED : " . $_SESSION['username'];
    unset($_SESSION['ipc']);
  
}else {
    $form .= " NOT LOGGED" ;
}
$form .= " - IP: " . getUserIpAddr();


if ($status_code == 200) {
    file_put_contents("log/log.txt", sprintf("[%s] %s", date("D M j H:i:s Y"), "[$status_code] $path - $form\n"), FILE_APPEND);
}
else {
    file_put_contents("log/logErr.txt", sprintf("[%s] %s", date("D M j H:i:s Y"), "[$status_code] $path - $form\n"), FILE_APPEND);
}


function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function countLoginAttempts($ip_counts)
{  
    $ip = getUserIpAddr();
    if(array_key_exists(getUserIpAddr(),$ip_counts)){
        $ip_counts[$ip] = $ip_counts[$ip] + 1;
    }else{
        $ip_counts[$ip] = 1;
    }

    $_SESSION['ipc'] = $ip_counts;
    return $ip_counts;
}
?>