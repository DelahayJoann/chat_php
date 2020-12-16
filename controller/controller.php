<?php
namespace App\Controller;

use App\model\User;
use App\model\Message;
use App\model\Chat;
//session_start();

Class Controller{
    static function unregistered(){ 
        $chats = Chat::getChats();
        $chat = $chats[0]; //temporaire -- multi chat plus tard
        $lastMessage = $chat->get10LastMessages();
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

        require 'view\template.php';
        
    }
    static function registered(){
        $chats = Chat::getChats();
        $chat = $chats[0]; //temporaire -- multi chat plus tard
        
        $lastMessage = $chat->get10LastMessages();
        $msgs = '';
        $username = $_SESSION['username'];
        ob_start();
        require 'view\top.php';
        $top = ob_get_clean();

        ob_start();

        foreach($lastMessage as $msg){
            $content = $msg->getContent();
            $username = User::getUserById($msg->getAuthorId())['username'];
            $creationdate = $msg->getCreationDate();
    
            if(User::getUserById($msg->getAuthorId())['username'] == $_SESSION['username']){
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
    }
}



//echo "ID: ".$msg->getId()." | Content: ".$msg->getContent()." | Date: ".$msg->getCreationDate()." 
//| Dans le Chat: ".$chats[$msg->getIdChat()]->getName()." | Utilisateur: ".User::getUserById($msg->getAuthorId())['username']."<br />";


// TEST
/*     User::addUser('aaabbbcom','abcdefghij8');
    $user = new User('aaabbbcom','abcdefghij8');
    $user->authentification();

    $chats = Chat::getChats();

    $msg = new Message(null,"blablabfghfghgfla", date('Y-m-d h:i:s'),$user->getId(),$chats[0]->getId());
    Chat::addMessage($user,$msg);
    $msg = new Message(null,"dfgfdgfdhfdgfla", date('Y-m-d h:i:s'),$user->getId(),$chats[0]->getId());
    Chat::addMessage($user,$msg);
    $msg = new Message(null,"fhdgfhddrfhrg", date('Y-m-d h:i:s'),$user->getId(),$chats[1]->getId());
    Chat::addMessage($user,$msg);
    $msg = new Message(null,"jehjsgfjs", date('Y-m-d h:i:s'),$user->getId(),$chats[0]->getId());
    Chat::addMessage($user,$msg);
    $msg = new Message(null,"trtrhjtrhhtrfstrjh", date('Y-m-d h:i:s'),$user->getId(),$chats[1]->getId());
    Chat::addMessage($user,$msg);
    $msg = new Message(null,"khjjfghgfdgdfrgfd", date('Y-m-d h:i:s'),$user->getId(),$chats[0]->getId());
    Chat::addMessage($user,$msg);
    $msg = new Message(null,"fghjfgjhftghjftghfg", date('Y-m-d h:i:s'),$user->getId(),$chats[1]->getId());
    Chat::addMessage($user,$msg);
    $msg = new Message(null,"fgjfghjfthtbtbtbtbtbttbt", date('Y-m-d h:i:s'),$user->getId(),$chats[0]->getId());
    Chat::addMessage($user,$msg);
    $msg = new Message(null,"fgdddddddddddddddddd", date('Y-m-d h:i:s'),$user->getId(),$chats[0]->getId());
    Chat::addMessage($user,$msg);
    $msg = new Message(null,"fgdhhhhhhhhhhtttttttttttrrrrrrrr", date('Y-m-d h:i:s'),$user->getId(),$chats[0]->getId());
    Chat::addMessage($user,$msg);

    $chat = $chats[0]; //défini le chat en cours

    $tenLast = $chat->get10LastMessages(); //10 derniers message sur ce chat


    foreach($tenLast as $msg){
        echo '<br />';
        echo "ID: ".$msg->getId()." | Content: ".$msg->getContent()." | Date: ".$msg->getCreationDate()." | Dans le Chat: ".$chats[$msg->getIdChat()]->getName()." | Utilisateur: ".User::getUserById($msg->getAuthorId())['username']."<br />";
    }

    $user->disconnect(); */
?>