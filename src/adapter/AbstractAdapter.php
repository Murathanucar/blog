<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 07.08.2017
 * Time: 16:02
 */

namespace src\adapter;

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '3535');
define('DB_NAME', 'blog');

abstract class AbstractAdapter implements AdapterInterface
{
    /**
     * @var \mysqli
     */
    protected $conn;

    protected $sql;

    /**
     * @var \mysqli_result
     */
    protected $result;


    public function __construct()
    {
        $this->conn = new \mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        // bağlantı kontrolünü sağladık
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        mysqli_query($this->getConn(), "SET NAMES utf8");
    }


    public function insert($entity)
    {
        $entityMethods = get_class_methods($entity);
        $className = str_replace("src\\entity\\", "", get_class($entity));
        foreach ($entityMethods as $entityMethod) {
            if (substr($entityMethod, 0, 3) == "get") {
                $value = $entity->{$entityMethod}();
                if ($value != null) {
                    $key = $this->uncamelize(str_replace("get", "", $entityMethod));
                    $keyList[] = $key;
                    $valueList[] = $value;
                }
            }
        }
        $keyQuery = implode(",", $keyList);
        $valueList = array_map([$this, "addQuotes"], $valueList);
        $valueQuery = implode(",", $valueList);
        $sqlParts = [
            "INSERT INTO " . $className . "(",
            $keyQuery . ") ",
            "VALUES(",
            $valueQuery . ");"
        ];
        $this->sql = implode("", $sqlParts);
    }


    public function select($tableName, $params = null, $alias = null)
    {
        $whereQuery = "";

        if (isset($params["where"])) {
            $whereParams = $params["where"];
            $whereValueQuery = "";
            if (isset($whereParams["and"])) {
                $andParams = $whereParams["and"];
                $andQueryParams = [];
                foreach ($andParams as $key => $andParam) {
                    $andQueryParams[] = $key . "=" . $this->addQuotes($andParam);
                }
                $whereValueQuery = implode(" AND ", $andQueryParams);
            }elseif (isset($whereParams["or"])) {
                $orParams = $whereParams["or"];
                $orQueryParams = [];
                foreach ($orParams as $key => $orParam) {
                    $orQueryParams[] = $key . "=" . $this->addQuotes($orParam);
                }
                $whereValueQuery = implode(" OR ", $orQueryParams);
            } elseif (isset($whereParams["like"])) {
                $likeQuery = $whereParams["like"];
                $likeKey = key($likeQuery);
                $likeValue = $likeQuery[$likeKey];
                $whereValueQuery = $likeKey . " LIKE '%" . $likeValue . "%'";
            } else{

                $defaultQueryParams = [];
                foreach ($whereParams as $key => $orParam) {
                    $defaultQueryParams[] = $key . "=" . $this->addQuotes($orParam);
                }
                $whereValueQuery = implode("", $defaultQueryParams);
            }

            $whereQuery = "WHERE " . $whereValueQuery;
        }
        $joinQuery = "";
        if(isset($params["joins"])){
            $joins = $params["joins"];
            $joinQueries = [];
            foreach ($joins as $join){
                $joinQueryParam = "";
                $joinType = $join["type"];
                $joinTableName = $join["table_name"];
                $joinAlias = $join["alias"];
                $joinCondition = $join["condition"];
                // LEFT JOIN category AS C ON (article.category_id=c.id)
                if($joinType == "left"){
                    $joinQueryParam .= "LEFT JOIN ";
                }elseif($joinType == "inner"){
                    $joinQueryParam .= "INNER JOIN ";
                }
                $joinQueryParam = $joinQueryParam . $joinTableName . " AS " . $joinAlias ." ";
                $joinConditionKey = key($joinCondition);
                $joinConditionValue = $joinCondition[$joinConditionKey];
                $joinQueryParam = $joinQueryParam . "ON (" . $joinConditionKey . "=" . $joinConditionValue .") ";
                $joinQueries[] = $joinQueryParam;
            }
            $joinQuery = implode(" ", $joinQueries);
        }
        if(isset($params["columns"])){
            $selectValues = implode("," , $params["columns"]);
            $selectQuery = "SELECT ".$selectValues." FROM " . $tableName;
        }else{
            $selectQuery = "SELECT * FROM " . $tableName;
        }

        if($alias != null){
            $selectQuery .= " AS " . $alias;;
        }

        if ($params == null) {
            $this->sql = $selectQuery;
            return;
        }
        $this->sql = $selectQuery . " " . $joinQuery . $whereQuery;
    }

    public function update($entity, $params)
    {
        $entityMethods = get_class_methods($entity);
        $className = str_replace("src\\entity\\", "", get_class($entity));
        if (in_array("getId", $entityMethods)) {
            $entityId = $entity->getId();
            foreach ($params as $key => $value) {
                $setQueryParams[] = $key . "='" . $value . "'";
            }
            $setQuery = implode(",", $setQueryParams);
            if ($setQuery != "") {
                $setQuery = "SET " . $setQuery;
            }
            $whereQuery = " WHERE id='" . $entityId . "'";
            $entityQuery = "UPDATE " . $className . " ";
            $updateQuery = $entityQuery . $setQuery . $whereQuery;
            $this->sql = $updateQuery;
            return true;
        }
        return false;
    }


    public function delete($entity)
    {
        $entityMethods = get_class_methods($entity);
        $className = str_replace("src\\entity\\", "", get_class($entity));
        if (in_array("getId", $entityMethods)) {
            $entityId = $entity->getId();
            $whereQuery = " WHERE id='" . $entityId . "'";
            $entityQuery = "DELETE FROM " . $className;
            $deleteQuery = $entityQuery . $whereQuery;
            $this->sql = $deleteQuery;
            return true;
        }
        return false;
    }

    public function execute()
    {

        $this->result = $this->getConn()->query($this->sql);
    }

    /**
     * @return \mysqli
     */
    public function getConn()
    {
        return $this->conn;
    }

    public function getSql()
    {
        return $this->sql;
    }

    /**
     * @return \mysqli_result
     */
    public function getResult()
    {
        return $this->result;
    }


    protected function addQuotes($str)
    {
        return "'$str'";
    }

    private function uncamelize($str)
    {
        $str = lcfirst($str);
        $lc = strtolower($str);
        $result = '';
        $length = strlen($str);
        for ($i = 0; $i < $length; $i++) {
            $result .= ($str[$i] == $lc[$i] ? '' : '_') . $lc[$i];
        }
        return $result;
    }



}

