<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 16.08.2017
 * Time: 16:32
 */

namespace src\controller;



class AdminController
{
    public function __construct()
    {
        session_start();
        if(!isset($_SESSION["UserId"])){
            header("Location: /login");
            exit;
        }
    }


    public function admin()
    {

        if(!isset($_SESSION["UserId"])){
            header("Location: /login");
            exit;
        }
        return [];
    }

}


