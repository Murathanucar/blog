<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 08.08.2017
 * Time: 12:13
 */

namespace src\test;

use src\adapter\ArticleAdapter;
use src\adapter\UserAdapter;
use src\entity\User;

class UserAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testInsert()
    {
        $userAdapter = new UserAdapter();
        $user = new User();
        $user->setEmail("murathan@mail.com");
        $userAdapter->insert($user);
        $actualSql = $userAdapter->getSql();
        $expectedSql = "INSERT INTO User(email) VALUES('murathan@mail.com');";
        $this->assertEquals($expectedSql, $actualSql);

        $user->setName("murathan");
        $userAdapter->insert($user);
        $actualSql = $userAdapter->getSql();
        $expectedSql = "INSERT INTO User(email,name) VALUES('murathan@mail.com','murathan');";
        $this->assertEquals($expectedSql, $actualSql);
    }

    public function testSelect(){

        $userAdapter = new UserAdapter();
        $user = new User();
        $user->getName();
        $userAdapter->select("User", ["where" => ["name" => 'murat']]);
        $actualSql = $userAdapter->getSql();
        $expectedSql = "SELECT * FROM User WHERE name='murat'";
        $this->assertEquals($expectedSql, $actualSql);

        $userAdapter = new UserAdapter();
        $user = new User();
        $user->getName();
        $user->getId();
        $userAdapter->select("User", ["where" => ["and" => ["name" =>  'murat' , "id" => '5' ] ] ]);
        $actualSql = $userAdapter->getSql();
        $expectedSql = "SELECT * FROM User WHERE name='murat' AND id='5'";
        $this->assertEquals($expectedSql, $actualSql);

        $userAdapter = new UserAdapter();
        $user = new User();
        $user->getName();
        $user->getId();
        $userAdapter->select("User", ["where" => ["or" => ["name" =>  'murat' , "id" => '5' ] ] ]);
        $actualSql = $userAdapter->getSql();
        $expectedSql = "SELECT * FROM User WHERE name='murat' OR id='5'";
        $this->assertEquals($expectedSql, $actualSql);

    }
    public function testUpdate(){

        $userAdapter = new UserAdapter();
        $user = new User();
        $user->setId('1');
        $userAdapter->update($user , ["name" => 'murat',"id" => '8' ]);
        $actualSql = $userAdapter->getSql();
        $expectedSql = "UPDATE User SET name='murat',id='8' WHERE id='1'";
        $this->assertEquals($expectedSql , $actualSql);
}

    public function testDelete(){

        $userAdapter = new UserAdapter();
        $user = new User();
        $expectedSql = "DELETE FROM User WHERE id='1'";
        $user->setId(1);
        $userAdapter->delete($user);
        $actualSql = $userAdapter->getSql();
        $this->assertEquals($expectedSql , $actualSql);





    }

}