<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 09.08.2017
 * Time: 12:59
 */

namespace src\controller;

use src\adapter\CommentAdapter;
use src\entity\Comment;

class CommentController
{
    public function select(){

        $comments = [];
        // $blogs = ...
        $commentAdapter = new \src\adapter\CommentAdapter();
        $commentAdapter->select("Comment");
        $commentAdapter->execute();
        while ($row = $commentAdapter->getResult()->fetch_assoc()){
            $comments[] = $row;
        }
        return [
            "blogs" => $comments
        ];
    }


    public function insert(){

        $comment = new \src\entity\Comment();
        $commentAdapter = new \src\adapter\CommentAdapter();
        $comment->setId(5);
        $commentAdapter->insert($comment);
        $commentAdapter->execute();
        return [
            "insert" => "true"
        ];

    }

    public function delete(){

        $comment = new \src\entity\Comment();
        $commentAdapter = new \src\adapter\CommentAdapter();
        $comment->setId(3);
        $commentAdapter->delete($comment);
        $commentAdapter->execute();
        return [
            "delete" => "true"
        ];
    }

    public function update(){

        $comment =new \src\entity\Comment();
        $commentAdapter = new \src\adapter\CommentAdapter();
        $comment->setId(555);
        $commentAdapter->update($comment, ["id" => "1"]);
        $commentAdapter->execute();
        return [
            "update" => "true"
        ];

    }

}