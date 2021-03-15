<?php 
session_start(); 

$action = $_POST["action"];

switch ($action) {
        case 'connexion':
            $_SESSION['isConnect']=true;
            echo "okkk";
            break;
        case 'deconnexion':
            session_destroy();
            echo "okkk";
            break;
}
?>