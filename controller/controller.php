<?php
namespace App\controller;
require ".\model\user.php";
require ".\model\message.php";
require ".\model\chat.php";
use App\model as M;

    M\User::addUser('aaabbbcom','abcdefghij8');
    $user = new M\User('aaabbbcom','abcdefghij8');
    $user->authentification();

    $chats = M\Chat::getChats();

    $msg = new M\Message("blablabfghfghgfla",$user->getId(),$chats[0]->getId());


    M\Chat::addMessage($user,$msg);

    $user->disconnect();
?>