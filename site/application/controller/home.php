<?php


class Home
{

    public function index()
    {
        session_start();
        if(!$_SESSION['logged']){
            header("Location: " . URL . "login");
        }else{
            header("Location: " . URL . "dashboard");
        }
    }
}
