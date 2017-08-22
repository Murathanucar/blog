<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 08.08.2017
 * Time: 15:28
 */

namespace src\test;


use src\adapter\MemberAdapter;
use src\entity\Member;

class MemberAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testInsert()
    {

        $memberAdapter = new MemberAdapter();
        $member = new Member();
        $member->setId(5);
        $memberAdapter->insert($member);
        $actualSql = $memberAdapter->getSql();
        $expectedSql = "INSERT INTO Member(id) VALUES('5');";
        $this->assertEquals($expectedSql, $actualSql);


    }

    public function testUpdate()
    {

        $memberAdapter = new MemberAdapter();
        $member = new Member();
        $expectedSql = "UPDATE Member SET name='mehmet',id='25' WHERE id='9'";
        $member->setId(9);
        $memberAdapter->update($member, ["name" => 'mehmet', "id" => '25']);
        $actualSql = $memberAdapter->getSql();
        $this->assertEquals($expectedSql, $actualSql);


    }

    public function testDelete()
    {
        $memberAdapter = new MemberAdapter();
        $member = new Member();
        $expectedSql = "DELETE FROM Member WHERE id='1'";
        $member->setId(1);
        $memberAdapter->delete($member);
        $actualSql = $memberAdapter->getSql();
        $this->assertEquals($expectedSql, $actualSql);

    }

    public function testSelect()
    {

        $memberAdapter = new MemberAdapter();
        $member = new Member();
        $member->getName();
        $memberAdapter->select("User", ["where" => ["name" => 'murat']]);
        $actualSql = $memberAdapter->getSql();
        $expectedSql = "SELECT * FROM User WHERE name='murat'";
        $this->assertEquals($expectedSql, $actualSql);

        $memberAdapter = new MemberAdapter();
        $member = new Member();
        $member->getName();
        $member->getId();
        $memberAdapter->select("User", ["where" => ["and" => ["name" => 'murat', "id" => '5']]]);
        $actualSql = $memberAdapter->getSql();
        $expectedSql = "SELECT * FROM User WHERE name='murat' AND id='5'";
        $this->assertEquals($expectedSql, $actualSql);

        $memberAdapter = new MemberAdapter();
        $member = new Member();
        $member->getName();
        $member->getId();
        $memberAdapter->select("User", ["where" => ["or" => ["name" => 'murat', "id" => '5']]]);
        $actualSql = $memberAdapter->getSql();
        $expectedSql = "SELECT * FROM User WHERE name='murat' OR id='5'";
        $this->assertEquals($expectedSql, $actualSql);


    }
}
