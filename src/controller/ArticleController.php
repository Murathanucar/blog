<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 09.08.2017
 * Time: 15:53
 */

namespace src\controller;


use src\adapter\ArticleAdapter;
use src\adapter\CategoryAdapter;
use src\entity\Article;

class ArticleController
{

    public function select(){


        $articles = [];

        // $blogs = ...
        $articleAdapter = new ArticleAdapter();
        $articleAdapter->select("Article");
        $articleAdapter->execute();
        while ($rowArticle = $articleAdapter->getResult()->fetch_assoc()){
            $articles[] = $rowArticle;
        }
        //category ve article select komutunu aynı sayfada kullanmak için yapılan geçici kısım
        $categories = [];
        $categoryAdapter = new \src\adapter\CategoryAdapter();
        $categoryAdapter->select("Category");
        $categoryAdapter->execute();
        while ($row = $categoryAdapter->getResult()->fetch_assoc()){
            $categories[] = $row;
        }

        return [
            "articles" => $articles,
            "categories" => $categories

        ];
    }


    public function insert($postData){

        $article = new Article();
        $article->setDescription($postData["description"])
                ->setContent($postData["content"])
                ->setCategoryId($postData["categoryId"]);

        var_dump($article->getCategoryId());exit;
        $articleAdapter->insert($article);

        $articleAdapter->execute();
        return [
            "insert" => "true"
        ];

    }

    public function delete(){

        $article = new Article();
        $articleAdapter = new ArticleAdapter();
        $article->setId(3);
        $articleAdapter->delete($article);
        $articleAdapter->execute();
         return [
             "delete" => "true"
         ];
    }

    public function update(){

        $article =new Article();
        $articleAdapter = new ArticleAdapter();
        $article->setId(555);
        $articleAdapter->update($article, ["id" => "1"]);
        $articleAdapter->execute();
        return [
            "update" => "true"
        ];

    }

    public function getCategory()
    {
        $categoryId = $_GET["category_id"];

        $criteria = array(
            "joins" => array(
                array(
                    "type" => "left",
                    "table_name" => "Category",
                    "alias" => "c",
                    "condition" => array("c.id" => "a.category_id")
                )
            ),
            "columns" => array(
                "a.*",
                "c.*",
            )
        );
        if($categoryId > 0){
            $criteria["where"] = array(
                "c.id" => $categoryId
            );
        }

        $articles = [];
        $articleAdapter = new ArticleAdapter();
        $articleAdapter->select("Article", $criteria, "a");
        $articleAdapter->execute();

        while ($row = $articleAdapter->getResult()->fetch_assoc()){
            $articles[] = $row;
        }
        return [
            "articles" => $articles
        ];

    }

    public function getSearch(){
        $description = $_GET["description"];

        $criteria["where"] = array(
            "like" => array(
                "a.content" => $description
            )
        );

        $articles = [];
        $articleAdapter = new ArticleAdapter();
        $articleAdapter->select("Article", $criteria, "a");
        $articleAdapter->execute();

        while ($row = $articleAdapter->getResult()->fetch_assoc()){
            $articles[] = $row;
        }
        return [
            "articles" => $articles
        ];
    }



}
