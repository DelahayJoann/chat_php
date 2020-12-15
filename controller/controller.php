<?php
namespace App\controller;
require ".\model\user.php";
require ".\model\message.php";
require ".\model\chat.php";
use App\model as M;

// TEST
    M\User::addUser('aaabbbcom','abcdefghij8');
    $user = new M\User('aaabbbcom','abcdefghij8');
    $user->authentification();

    $chats = M\Chat::getChats();

    $msg = new M\Message(null,"blablabfghfghgfla", date('Y-m-d h:i:s'),$user->getId(),$chats[0]->getId());


    M\Chat::addMessage($user,$msg);

    $chat = $chats[0];
    $tenLast = $chat->get10LastMessages();

    foreach($tenLast as $msg){
        print_r($msg);
    }

    $user->disconnect();
?>