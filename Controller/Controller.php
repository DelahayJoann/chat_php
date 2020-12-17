<?php
namespace App\Controller;

use App\model\User;
use App\model\Message;
use App\model\Chat;

Class Controller{
    static function addUser(){
        USER::addUser($_POST['email'],$_POST['password']);
        $user = new User($_POST['email'],$_POST['password']);
        $user->authentification();
        $_POST = array();
        self::registered();
    }

    static function login(){
        $user = new User($_POST['email'],$_POST['password']);
        $user->authentification();
        $_POST = array();
        self::registered();
    }
    static function logout(){
        User::disconnect();
        $_POST = array();
        self::unregistered();
    }

    static function send(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['idUser'])){
            $chats = Chat::getChats();
            $msg = new Message(null, $_POST['message'], date('Y-m-d h:i:s'), $_SESSION['idUser'], $chats[0]->getId() );
            Chat::addMessage($msg);
            self::registered();
        }
    }

    static function unregistered(){ 
        $chats = Chat::getChats();
        $chat = $chats[0]; //temporaire -- multi chat plus tard
        $lastMessage = $chat->getLastMessages();
        $msgs = '';
        
        ob_start();
        require 'view\top_offline.php';
        $top = ob_get_clean();

        ob_start();

        foreach($lastMessage as $msg){
            $content = $msg->getContent();
            $username = User::getUserById($msg->getAuthorId())['username'];
            $creationdate = $msg->getCreationDate();
    
            require 'view\message_other.php';
        }
        
        $msgs = ob_get_clean();
        
        ob_start();
        require 'view\box.php';
        $box = ob_get_clean();

        ob_start();
        require 'view\down_offline.php';
        $bottom = ob_get_clean();
        
        ob_start();
        require 'view\sign_in.php';
        require 'view\register.php';
        $modals = ob_get_clean();

        require 'view\template.php';
        ob_end_flush();
        
    }
    static function registered(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $chats = Chat::getChats();
        $chat = $chats[0]; //temporaire -- multi chat plus tard
        
        $lastMessage = $chat->getLastMessages();
        $msgs = '';
        $user = User::getUserById($_SESSION['idUser'])['username'];
        ob_start();
        require 'view\top.php';
        $top = ob_get_clean();

        ob_start();

        foreach($lastMessage as $msg){
            $content = $msg->getContent();
            $username = User::getUserById($msg->getAuthorId())['username'];
            $creationdate = $msg->getCreationDate();
    
            if($msg->getAuthorId() == $_SESSION['idUser']){
                require 'view\message.php';
            }
            else{
                require 'view\message_other.php';
            }
        }
        $msgs = ob_get_clean();
        
        ob_start();
        require 'view\box.php';
        $box = ob_get_clean();

        ob_start();
        require 'view\down.php';
        $bottom = ob_get_clean();

        require 'view\template.php';
        ob_end_flush();
    }
}
?>