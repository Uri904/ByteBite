<?php

class UserSession{
    public function __construct(){
        session_start();
    }

    public function setCurrentUser($user){
        $_SESSION['id_mesa'] = $id_mesa;
    }

    public function getCurrentUser(){
        return $_SESSION['id_mesa'] = $id_mesa;
    }

    public function clasesSession(){
        session_unsdet();
        session_destroy();
    }
}