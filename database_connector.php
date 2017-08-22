<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 04.08.2017
 * Time: 14:45
 */
class database_connector
{

    public $servername = "localhost";
    public $username = "root";
    public $password = "3535";
    public $dbname = "blog";

    public function connect()
    {
        // Create connection
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);

        }


    }


}




