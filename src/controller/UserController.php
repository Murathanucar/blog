<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 09.08.2017
 * Time: 13:00
 */

namespace src\controller;

use phpDocumentor\Reflection\Location;
use src\entity\User;
use src\adapter\UserAdapter;


class UserController
{

    public function __construct()
    {
        session_start();

    }

    public function select()
    {

        $users = [];
        // $blogs = ...
        $userAdapter = new \src\adapter\UserAdapter();
        $userAdapter->select("User");
        $userAdapter->execute();
        while ($row = $userAdapter->getResult()->fetch_assoc()) {
            $users[] = $row;
        }
        return [
            "users" => $users
        ];
    }


    public function insert()
    {

        $user = new \src\entity\User();
        $userAdapter = new \src\adapter\UserAdapter();
        $user->setId(5);
        $userAdapter->insert($user);
        $userAdapter->execute();
        return [
            "insert" => "true"
        ];

    }

    public function delete()
    {

        $user = new \src\entity\User();
        $userAdapter = new \src\adapter\UserAdapter();
        $user->setId(3);
        $userAdapter->delete($user);
        $userAdapter->execute();
        return [
            "delete" => "true"
        ];
    }

    public function update()
    {

        $user = new \src\entity\User();
        $userAdapter = new \src\adapter\UserAdapter();
        $user->setId(555);
        $userAdapter->update($user, ["id" => "1"]);
        $userAdapter->execute();
        return [
            "update" => "true"
        ];

    }

    public function adminSelect()
    {
        return [];
    }

    public function loginAction(){
        $name = $_POST["name"];
        $password = $_POST["password"];
        $criteria["where"] = array(
            "and" => array(
                "name" => $name,
                "password" => $password
            )
        );

        $userAdapter = new UserAdapter();
        $userAdapter->select("User", $criteria);
        $userAdapter->execute();
        $user = $userAdapter->getResult()->fetch_assoc();
        if(isset($user["id"]) && $user["id"] > 0){
           $_SESSION["UserId"] = $user["id"];
            header("Location: /admin");
        }else{
            $_SESSION["Error"] = "Kullanıcı bulunamadı";
            header("Location: /login");
        }
        return [];
    }






}

