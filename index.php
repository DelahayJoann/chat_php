<?php
require 'vendor/autoload.php';
use App\Controller\Controller;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['idUser'])){
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'send') {
            Controller::send();
        }
        elseif($_GET['action'] == 'logout'){
            Controller::logout();
        }
        elseif($_GET['action'] == 'home'){
            Controller::registered();
        }
        elseif($_GET['action'] == 'refresh'){
            Controller::refresh();
        }
        else {
            Controller::registered();            
        }
    }
    else {
        Controller::registered();
    }
}
elseif (isset($_GET['action'])) {
    if ($_GET['action'] == 'register'){
        Controller::addUser();
    }
    elseif ($_GET['action'] == 'login'){
        Controller::login();
    }
    elseif($_GET['action'] == 'home'){
        Controller::unregistered();
    }
    elseif($_GET['action'] == 'refresh'){
        Controller::refresh();
    }
    else{
        Controller::unregistered();
    }
}
else{
    Controller::unregistered();
}
       // TEST
       //$user->disconnect();
    /*  */