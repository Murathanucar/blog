<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 09.08.2017
 * Time: 13:00
 */

namespace src\controller;

use src\adapter\MemberAdapter;
use src\entity\Member;

class MemberController
{
    public function select(){

        $members = [];
        // $blogs = ...
        $memberAdapter = new \src\adapter\MemberAdapter();
        $memberAdapter->select("Member");
        $memberAdapter->execute();
        while ($row = $memberAdapter->getResult()->fetch_assoc()){
            $members[] = $row;
        }
        return [
            "blogs" => $members ,

        ];
    }


    public function insert(){

        $member = new \src\entity\Member();
        $memberAdapter = new \src\adapter\MemberAdapter();
        $member->setId(5);
        $memberAdapter->insert($member);
        $memberAdapter->execute();
        return [
            "insert" => "true"
        ];

    }

    public function delete(){

        $member = new \src\entity\Member();
        $memberAdapter = new \src\adapter\MemberAdapter();
        $member->setId(3);
        $memberAdapter->delete($member);
        $memberAdapter->execute();
        return [
            "delete" => "true"
        ];
    }

    public function update(){

        $member =new \src\entity\Member();
        $memberAdapter = new \src\adapter\MemberAdapter();
        $member->setId(555);
        $memberAdapter->update($member, ["id" => "1"]);
        $memberAdapter->execute();
        return [
            "update" => "true"
        ];

    }
}