<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 08.08.2017
 * Time: 17:27
 */

namespace src\test;

use src\adapter\ArticleAdapter;
use src\entity\Article;

class ArticleAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testInsert()
    {

        $articleAdapter = new ArticleAdapter();
        $article = new Article();
        $article->setId(5);
        $articleAdapter->insert($article);
        $actualSql = $articleAdapter->getSql();
        $expectedSql = "INSERT INTO Article(id) VALUES('5');";
        $this->assertEquals($expectedSql, $actualSql);
    }

    /**
     *
     */
    public function testUpdate()
    {

        $articleAdapter = new ArticleAdapter();
        $article = new Article();
        $expectedSql = "UPDATE Article SET content='mehmet',id='25' WHERE id='9'";
        $article->setId(9);
        $articleAdapter->update($article, ["content" => 'mehmet', "id" => '25']);
        $actualSql = $articleAdapter->getSql();
        $this->assertEquals($expectedSql, $actualSql);

    }

    /**
     *
     */

    public function testDelete()
    {
        $articleAdapter = new ArticleAdapter();
        $article = new Article();
        $expectedSql = "DELETE FROM Article WHERE id='1'";
        $article->setId(1);
        $articleAdapter->delete($article);
        $actualSql = $articleAdapter->getSql();
        $this->assertEquals($expectedSql, $actualSql);

    }

    /**
     *
     */

    public function testSelect()
    {

        $articleAdapter = new ArticleAdapter();
        $article = new Article();
        $article->getContent();
        $articleAdapter->select("Article", ["where" => ["content" => 'murat']]);
        $actualSql = $articleAdapter->getSql();
        $expectedSql = "SELECT * FROM Article WHERE content='murat'";
        $this->assertEquals($expectedSql, $actualSql);

        $articleAdapter = new ArticleAdapter();
        $article = new Article();
        $article->getContent();
        $article->getId();
        $articleAdapter->select("Article", ["where" => ["and" => ["content" => 'murat', "id" => '5']]]);
        $actualSql = $articleAdapter->getSql();
        $expectedSql = "SELECT * FROM Article WHERE content='murat' AND id='5'";
        $this->assertEquals($expectedSql, $actualSql);

        $articleAdapter = new ArticleAdapter();
        $article = new Article();
        $article->getContent();
        $article->getId();
        $articleAdapter->select("Article", ["where" => ["or" => ["content" => 'murat', "id" => '5']]]);
        $actualSql = $articleAdapter->getSql();
        $expectedSql = "SELECT * FROM Article WHERE content='murat' OR id='5'";
        $this->assertEquals($expectedSql, $actualSql);


        $criteria = array(
            "joins" => array(
                array(
                    "type" => "left",
                    "table_name" => "category",
                    "alias" => "c",
                    "condition" => array("c.id" => "a.category_id")
                )
            ),
            "columns" => array(
                "a.*",
                "c.*",
            ),
            "where" => array(
                "c.id" => array(
                    "a.content" => "aaa"
                )
            )
        );

        $articleAdapter = new ArticleAdapter();
        $articleAdapter->select("Article", $criteria, "a");
        $actualSql = $articleAdapter->getSql();

    }

}
