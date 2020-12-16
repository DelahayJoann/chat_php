<?php
require 'vendor\autoload.php';
use App\controller\Controller;

//test
/* use App\model\User;
User::addUser('aaabbbcom','abcdefghij8');
$user = new User('aaabbbcom','abcdefghij8');
$user->authentification(); */
//---


if(isset($_SESSION['username'],$_SESSION['password'])){
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'sendMessage') {
            //sendMessage();
        }
        else {
            Controller::registered();            
        }
    }
    else {
        Controller::registered();
    }
}
else{
    Controller::unregistered();
}
       // TEST
       //$user->disconnect();
    /*  */