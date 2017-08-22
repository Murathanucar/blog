<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 09.08.2017
 * Time: 12:58
 */

namespace src\controller;

use src\adapter\CategoryAdapter;
use src\entity\Category;

class CategoryController
{
    public function select(){

        $categories = [];
        // $blogs = ...
        $categoryAdapter = new \src\adapter\CategoryAdapter();
        $categoryAdapter->select("Category");
        $categoryAdapter->execute();
        while ($row = $categoryAdapter->getResult()->fetch_assoc()){
            $categories[] = $row;
        }
        return [
            "categories" => $categories
        ];

    }


    public function insert(){

        $category = new \src\entity\Category();
        $categoryAdapter = new \src\adapter\CategoryAdapter();
        $category->setId(5);
        $categoryAdapter->insert($category);
        $categoryAdapter->execute();
        return [
            "insert" => "true"
        ];

    }

    public function delete(){

        $category = new \src\entity\Category();
        $categoryAdapter = new \src\adapter\CategoryAdapter();
        $category->setId(3);
        $categoryAdapter->delete($category);
        $categoryAdapter->execute();
        return [
            "delete" => "true"
        ];
    }

    public function update(){

        $category =new \src\entity\Category();
        $categoryAdapter = new \src\adapter\CategoryAdapter();
        $category->setId(555);
        $categoryAdapter->update($category, ["id" => "2"]);
        $categoryAdapter->execute();
        return [
            "update" => "true"
        ];

    }

}