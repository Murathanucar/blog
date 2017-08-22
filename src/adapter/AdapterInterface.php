<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 08.08.2017
 * Time: 09:25
 */

namespace src\adapter;


interface AdapterInterface
{
    public function insert($entity);
    public function select($tableName,$params);
    public function update($entity,$params);
    public function delete($entity);

}