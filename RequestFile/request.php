<?php 
session_start(); 

$action = $_POST["action"];
$role = $_POST["role"];

switch ($action) {
        case 'connexion':
            $_SESSION['isConnect']=true;
            if($role=="ADMIN") {
                $_SESSION['isAdmin']=true;
            }else{
                $_SESSION['isAdmin']=false;
            }
            break;
        case 'deconnexion':
            session_destroy();
            break;
}
?>