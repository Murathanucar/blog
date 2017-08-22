<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 08.08.2017
 * Time: 17:16
 */

namespace src\test;

use src\adapter\CategoryAdapter;
use src\entity\Category;

class CategoryAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testInsert()
    {

        $categoryAdapter = new CategoryAdapter();
        $category = new Category();
        $category->setId(5);
        $categoryAdapter->insert($category);
        $actualSql = $categoryAdapter->getSql();
        $expectedSql = "INSERT INTO Category(id) VALUES('5');";
        $this->assertEquals($expectedSql, $actualSql);


    }

    public function testUpdate()
    {

        $categoryAdapter = new CategoryAdapter();
        $category = new Category();
        $expectedSql = "UPDATE Category SET name='mehmet',id='25' WHERE id='9'";
        $category->setId(9);
        $categoryAdapter->update($category, ["name" => 'mehmet', "id" => '25']);
        $actualSql = $categoryAdapter->getSql();
        $this->assertEquals($expectedSql, $actualSql);


    }

    public function testDelete()
    {
        $categoryAdapter = new CategoryAdapter();
        $category = new Category();
        $expectedSql = "DELETE FROM Category WHERE id='1'";
        $category->setId(1);
        $categoryAdapter->delete($category);
        $actualSql = $categoryAdapter->getSql();
        $this->assertEquals($expectedSql, $actualSql);

    }

    public function testSelect()
    {

        $categoryAdapter = new CategoryAdapter();
        $category = new Category();
        $category->getName();
        $categoryAdapter->select("Category", ["where" => ["name" => 'murat']]);
        $actualSql = $categoryAdapter->getSql();
        $expectedSql = "SELECT * FROM Category WHERE name='murat'";
        $this->assertEquals($expectedSql, $actualSql);

        $categoryAdapter = new CategoryAdapter();
        $category = new Category();
        $category->getName();
        $category->getId();
        $categoryAdapter->select("Category", ["where" => ["and" => ["name" => 'murat', "id" => '5']]]);
        $actualSql = $categoryAdapter->getSql();
        $expectedSql = "SELECT * FROM Category WHERE name='murat' AND id='5'";
        $this->assertEquals($expectedSql, $actualSql);

        $categoryAdapter = new CategoryAdapter();
        $category = new Category();
        $category->getName();
        $category->getId();
        $categoryAdapter->select("Category", ["where" => ["or" => ["name" => 'murat', "id" => '5']]]);
        $actualSql = $categoryAdapter->getSql();
        $expectedSql = "SELECT * FROM Category WHERE name='murat' OR id='5'";
        $this->assertEquals($expectedSql, $actualSql);


    }
}
