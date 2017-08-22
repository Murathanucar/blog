<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 08.08.2017
 * Time: 17:05
 */

namespace src\test;

use src\adapter\CommentAdapter;
use src\entity\Comment;

class CommentAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testInsert()
    {

        $commentAdapter = new CommentAdapter();
        $comment = new Comment();
        $comment->setId(5);
        $commentAdapter->insert($comment);
        $actualSql = $commentAdapter->getSql();
        $expectedSql = "INSERT INTO Comment(id) VALUES('5');";
        $this->assertEquals($expectedSql, $actualSql);


    }

    public function testUpdate()
    {

        $commentAdapter = new CommentAdapter();
        $comment = new Comment();
        $expectedSql = "UPDATE Comment SET name='mehmet',id='25' WHERE id='9'";
        $comment->setId(9);
        $commentAdapter->update($comment, ["name" => 'mehmet', "id" => '25']);
        $actualSql = $commentAdapter->getSql();
        $this->assertEquals($expectedSql, $actualSql);


    }

    public function testDelete()
    {
        $commentAdapter = new CommentAdapter();
        $comment = new Comment();
        $expectedSql = "DELETE FROM Comment WHERE id='1'";
        $comment->setId(1);
        $commentAdapter->delete($comment);
        $actualSql = $commentAdapter->getSql();
        $this->assertEquals($expectedSql, $actualSql);

    }

    public function testSelect()
    {

        $commentAdapter = new CommentAdapter();
        $comment = new Comment();
        $comment->getText();
        $commentAdapter->select("Comment", ["where" => ["text" => 'murat']]);
        $actualSql = $commentAdapter->getSql();
        $expectedSql = "SELECT * FROM Comment WHERE text='murat'";
        $this->assertEquals($expectedSql, $actualSql);

        $commentAdapter = new CommentAdapter();
        $comment = new Comment();
        $comment->getText();
        $comment->getId();
        $commentAdapter->select("Comment", ["where" => ["and" => ["text" => 'murat', "id" => '5']]]);
        $actualSql = $commentAdapter->getSql();
        $expectedSql = "SELECT * FROM Comment WHERE text='murat' AND id='5'";
        $this->assertEquals($expectedSql, $actualSql);

        $commentAdapter = new CommentAdapter();
        $comment = new Comment();
        $comment->getText();
        $comment->getId();
        $commentAdapter->select("Comment", ["where" => ["or" => ["text" => 'murat', "id" => '5']]]);
        $actualSql = $commentAdapter->getSql();
        $expectedSql = "SELECT * FROM Comment WHERE text='murat' OR id='5'";
        $this->assertEquals($expectedSql, $actualSql);


    }

}
