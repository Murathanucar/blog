<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 16.08.2017
 * Time: 16:32
 */

namespace src\controller;


use src\adapter\CategoryAdapter;
use src\entity\Article;

use src\adapter\ArticleAdapter;

class AdminArticleController extends AdminController
{
    /**
     * @return array
     */
    public function insertArticle()
    {
        if(isset($_POST["category"])){
            $article = new Article();
            $articleAdapter = new ArticleAdapter();
            $article->setDescription($_POST["description"]);
            $article->setContent($_POST["content"]);
            $article->setCategoryId($_POST["category"]);
            $article->setUserId($_SESSION["UserId"]);
            $articleAdapter->insert($article);
            $articleAdapter->execute();
            header("Location: /select");
            return [];
        }

        /* category drop-down */
        $categories = [];
        $categoryAdapter = new \src\adapter\CategoryAdapter();
        $categoryAdapter->select("Category");
        $categoryAdapter->execute();
        while ($row = $categoryAdapter->getResult()->fetch_assoc()) {
            $categories[] = $row;
        }


        return [
            "categories" => $categories
        ];
    }

    public function deleteArticle($articleId)
    {
        $articleDelete = new Article();
        $articleAdapter = new \src\adapter\ArticleAdapter();

        $criteria["where"] = array(

            "id" => $articleId
        );

        $articleAdapter->select("Article", $criteria);
        $articleAdapter->execute();
        $article = $articleAdapter->getResult()->fetch_assoc();
        if (isset($article["id"]) && $article["id"] > 0) {
            $articleDelete->setId($articleId);
            $articleAdapter->delete($articleDelete);
            $articleAdapter->execute();
            return [
                "delete" => [
                    "message" => "$articleId" . " " . "nolu makale silindi.!",
                    "success" => true
                ]
            ];
        } else {
            return [
                "delete" => [
                    "message" => "$articleId" . " " . "nolu makale yok.!",
                    "success" => false
                ]
            ];
        }
    }

    public function updateArticle($articleId)
    {
        $articleAdapter = new \src\adapter\ArticleAdapter();

        if ($_POST["article_id"]) {
            $article = new Article();
            $article->setId(intval($_POST["article_id"]));
            $params = [
                "content" => $_POST["content"],
                "description" => $_POST["description"],
                "category_id" => $_POST["category"],
            ];
            $articleAdapter->update($article, $params);
            $articleAdapter->execute();
            header("Location: /select");
        }

        $criteria["where"] = array(

            "id" => $articleId
        );

        $articleAdapter->select("Article", $criteria);
        $articleAdapter->execute();
        $article = $articleAdapter->getResult()->fetch_assoc();

        $categoryAdapter = new CategoryAdapter();
        $categoryAdapter->select("Category");
        $categories = [];
        $categoryAdapter->execute();

        while ($row = $categoryAdapter->getResult()->fetch_assoc()) {
            $categories[] = $row;

        }
        return [
            "article" => $article,
            "categories" => $categories
        ];


    }
}

